<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Template;
use App\Models\Content;
use App\Services\TemplateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ArticlesController extends Controller implements HasMiddleware
{
    protected $templateService;

    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:articles.index', only: ['index']),
            new Middleware('permission:articles.create', only: ['form']),
            new Middleware('permission:articles.edit', only: ['form']),
            new Middleware('permission:articles.view', only: ['view']),
            new Middleware('permission:articles.delete', only: ['delete']),
            new Middleware('permission:articles.alias', only: ['alias']),
            new Middleware('permission:articles.publish', only: ['publish']),
            new Middleware('permission:articles.store', only: ['save']),
            new Middleware('permission:articles.update', only: ['save']),
            new Middleware('permission:articles.updateOrder', only: ['updateOrder']),
        ];
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $rows = (int) $request->input('rows', 10);

        $activeCount = Article::where('status', 1)->count();
        $inactiveCount = Article::where('status', -1)->count();

        $items = Article::activeStatus()
            ->search($search)
            ->ordered()
            ->paginate($rows);

        if ($request->ajax()) {
            // $pagination_html = view('vendor.pagination.bootstrap-5', ['paginator' => $items])->render();
            $item_html = view('backend.articles.table', compact('items'))->render();
            return response()->json([
                // 'pagination_html' => $pagination_html,
                'item_html' => $item_html,
            ]);
        }

        return view('backend.articles.index', compact('items', 'activeCount', 'inactiveCount'));

    }

    //this function handles both the edit and create part involving the page navigation
    public function form($id = null)
    {
        // Check permission based on action type
        if ($id) {
            // This is an update action
            if (!Auth::user()->can('articles.edit')) {
                abort(403, 'Unauthorized update action.');
            }
        } else {
            // This is a create action
            if (!Auth::user()->can('articles.create')) {
                abort(403, 'Unauthorized create action.');
            }
        }
        $items = Article::where('status', '<>', 0)
            ->where('parent', null)
            ->where('articles_id', '<>', $id ?? null)
            ->orderBy('title', 'asc')
            ->pluck('title', 'articles_id')->toArray();

        // If $id is provided, fetch the item for editing
        $item = $id ? Article::find($id) : null;

        $location = $item
            ? $this->templateService->getTemplateLocation('Article', $item->articles_id)
            : $this->templateService->getDefaultLocation('home', 'home.about');

        if ($id && !$item) {
            return redirect()->route('error');
        }

        return view('backend.articles.create', compact('items', 'item', 'location'));
    }

    public function save(Request $request, $id = null)
    {

        // dd($request->all());
        if ($id) {
            if (!Auth::user()->can('articles.update')) {
                abort(403, 'Unauthorized update action.');
            }
        } else {
            if (!Auth::user()->can('articles.store')) {
                abort(403, 'Unauthorized create action.');
            }
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', $validator->errors()->first()) // Get the first error message
                ->withErrors($validator)
                ->withInput();
        }

        // Extract data from request
        $data = $request->only([
            'title',
            'subtitle',
            'alias',
            'parent',
            'cover',
            'thumb',
            'description',
            'entries',
            'remarks',
            'seo_title',
            'seo_keyword',
            'seo_description',
            'publish',
        ]);

        $templateId = $request->input('template_id');
        $childId = $request->input('child_id');

        // Convert 'publish' to 'status'
        $data['status'] = isset($data['publish']) && $data['publish'] === 'true' ? 1 : -1;
        unset($data['publish']);

        if ($id) {
            // Update item
            $item = Article::findOrFail($id);
            $item->update($data);
            $message = 'Article updated successfully!';
        } else {
            // Create new item
            $data['alias'] = Str::slug($data['title']);
            $item = Article::create($data);
            $message = 'Article created successfully!';
        }

        // Call function to update template entries
        $this->templateService->updateTemplateEntries('Article', $templateId, $childId, $item->articles_id, $item->status);

        if (session('fromTemplate')) {
            session()->forget('fromTemplate');
            return redirect()->route('templates.index')->with('success', $message);
        }
        // Redirect based on user role/permission
        if (Auth::user()->hasRole('superadmin') || Auth::user()->hasPermissionTo('articles.index')) {
            return redirect()->route('articles.index')->with('success', $message);
        }
        return redirect()->back()->with('success', $message);
    }

    /**
     * Update template entries when an item is moved between templates.
     */

    public function view($id)
    {
        $item = Article::findOrFail($id);
        return view('backend.articles.view', compact('item'));
    }

    public function delete($id)
    {
        try {
            $item = Article::findOrFail($id);
            $item->status = 0;
            $item->save();
            return redirect()->back()->with('success', 'Item deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to delete item');
        }
    }


    /**
     * Publish or unpublish the specified resource.
     */
    public function publish($id, $publish)
    {
        try {
            $page = Article::findOrFail($id);

            $page->status = $publish;
            $page->save();

            $message = $publish == 1
                ? 'Article published successfully'
                : 'Article unpublished successfully';

            // If AJAX request, return JSON response
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            // Prepare an error message
            $errorMessage = $publish == 1
                ? 'Unable to publish the Article'
                : 'Unable to unpublish the Article';

            // For AJAX request, return JSON error response
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ]);
            }

            // Otherwise, redirect back with error message
            return redirect()->back()->with('error', $errorMessage);
        }
    }


    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->input('order') as $item) {
                Article::where('articles_id', $item['id'])
                    ->update(['display_order' => $item['order']]);
            }
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    public function alias(Request $request, $id)
    {
        try {
            $item = Article::findOrFail($id);
            $validated = $request->validate([
                'alias' => 'required|string|max:255',
            ]);
            $slugifiedAlias = Str::slug($validated['alias'], '-');
            $item->alias = $slugifiedAlias;
            $item->save();
            return response()->json([
                'success' => true,
                'message' => 'Alias updated successfully!',
                'alias' => $slugifiedAlias,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to update alias.',
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Services\TemplateService;
use App\Models\Template;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TestimonialsController extends Controller implements HasMiddleware
{

    protected $templateService;

    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:testimonials.index', only: ['index']),
            new Middleware('permission:testimonials.create', only: ['form']),
            new Middleware('permission:testimonials.edit', only: ['form']),
            new Middleware('permission:testimonials.view', only: ['view']),
            new Middleware('permission:testimonials.delete', only: ['delete']),
            new Middleware('permission:testimonials.alias', only: ['alias']),
            new Middleware('permission:testimonials.publish', only: ['publish']),
            new Middleware('permission:testimonials.store', only: ['save']),
            new Middleware('permission:testimonials.update', only: ['save']),
            new Middleware('permission:testimonials.updateOrder', only: ['updateOrder']),
        ];
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $rows = (int) $request->input('rows', 10);

        $activeCount = Testimonial::where('status', 1)->count();
        $inactiveCount = Testimonial::where('status', -1)->count();

        try {
            $items = Testimonial::activeStatus()
                ->search($search)
                ->ordered()
                ->paginate($rows);

            if ($request->ajax()) {
                $pagination_html = view('vendor.pagination.bootstrap-5', ['paginator' => $items])->render();
                $item_html = view('backend.testimonials.table', compact('items'))->render();
                return response()->json([
                    'pagination_html' => $pagination_html,
                    'item_html' => $item_html,
                ]);
            }

            return view('backend.testimonials.index', compact('items', 'activeCount', 'inactiveCount'));
        } catch (\Exception $e) {
            logger()->error('Error fetching items: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    //this function handles both the edit and create part involving the page navigation
    public function form($id = null)
    {
        // Check permission based on action type
        if ($id) {
            // This is an update action
            if (!Auth::user()->can('testimonials.edit')) {
                abort(403, 'Unauthorized update action.');
            }
        } else {
            // This is a create action
            if (!Auth::user()->can('testimonials.create')) {
                abort(403, 'Unauthorized create action.');
            }
        }
        $items = Testimonial::where('status', '<>', 0)
            //->where('parent', null)
            ->where('testimonials_id', '<>', $id ?? null)
            ->orderBy('name', 'asc')
            ->pluck('name', 'testimonials_id')->toArray();

        // If $id is provided, fetch the item for editing
        $item = $id ? Testimonial::findOrFail($id) : null;

        // If $item is null, we are in create mode and we need to set the default template location
        // specify the template default location by template title and child title

        $location = $item
            ? $this->templateService->getTemplateLocation('Testimonial', $item->testimonials_id)
            : $this->templateService->getDefaultLocation('home', 'home.testimonials');

        return view('backend.testimonials.create', compact('items', 'item', 'location'));
    }

    public function save(Request $request, $id = null)
    {
        if ($id) {
            if (!Auth::user()->can('testimonials.update')) {
                abort(403, 'Unauthorized update action.');
            }
        } else {
            if (!Auth::user()->can('testimonials.store')) {
                abort(403, 'Unauthorized create action.');
            }
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
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
            'name',
            'alias',
            'position',
            'thumb',
            'description',
            'publish',
        ]);

        $templateId = $request->input('template_id');
        $childId = $request->input('child_id');

        // Convert 'publish' to 'status'
        $data['status'] = isset($data['publish']) && $data['publish'] === 'true' ? 1 : -1;
        unset($data['publish']);

        if ($id) {
            // Update item
            $item = Testimonial::findOrFail($id);
            $item->update($data);
            $message = 'Testimonial updated successfully!';
        } else {
            // Create new item
            $data['alias'] = Str::slug($data['name']);
            $item = Testimonial::create($data);
            $message = 'Testimonial created successfully!';
        }

        // Call function to update template entries
        $this->templateService->updateTemplateEntries('Testimonial', $templateId, $childId, $item->testimonials_id, $item->status);

        // Redirect based on user role/permission
        if (Auth::user()->hasRole('superadmin') || Auth::user()->hasPermissionTo('testimonials.index')) {
            return redirect()->route('testimonials.index')->with('success', $message);
        }
        return redirect()->back()->with('success', $message);
    }


    public function view($id)
    {
        $item = Testimonial::findOrFail($id);
        return view('backend.testimonials.view', compact('item'));
    }

    public function delete($id)
    {
        try {
            $item = Testimonial::findOrFail($id);
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
            $page = Testimonial::findOrFail($id);

            $page->status = $publish;
            $page->save();

            $message = $publish == 1
                ? 'Testimonial published successfully'
                : 'Testimonial unpublished successfully';

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
                ? 'Unable to publish the Testimonial'
                : 'Unable to unpublish the Testimonial';

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
                Testimonial::where('testimonials_id', $item['id'])
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
            $item = Testimonial::findOrFail($id);
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

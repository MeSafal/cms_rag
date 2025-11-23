<?php

namespace App\Http\Controllers;

use App\Models\Country;
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

class CountriesController extends Controller implements HasMiddleware
{

    protected $templateService;

    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:countries.index', only: ['index']),
            new Middleware('permission:countries.create', only: ['form']),
            new Middleware('permission:countries.edit', only: ['form']),
            new Middleware('permission:countries.view', only: ['view']),
            new Middleware('permission:countries.delete', only: ['delete']),
            new Middleware('permission:countries.alias', only: ['alias']),
            new Middleware('permission:countries.publish', only: ['publish']),
            new Middleware('permission:countries.store', only: ['save']),
            new Middleware('permission:countries.update', only: ['save']),
            new Middleware('permission:countries.updateOrder', only: ['updateOrder']),
        ];
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $rows = (int) $request->input('rows', 10);

        $activeCount = Country::where('status', 1)->count();
        $inactiveCount = Country::where('status', -1)->count();

        try {
            $items = Country::activeStatus()
                ->search($search)
                ->ordered()
                ->paginate($rows);

            if ($request->ajax()) {
                $pagination_html = view('vendor.pagination.bootstrap-5', ['paginator' => $items])->render();
                $item_html = view('backend.countries.table', compact('items'))->render();
                return response()->json([
                    'pagination_html' => $pagination_html,
                    'item_html' => $item_html,
                ]);
            }

            return view('backend.countries.index', compact('items', 'activeCount', 'inactiveCount'));
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
            if (!Auth::user()->can('countries.edit')) {
                abort(403, 'Unauthorized update action.');
            }
        } else {
            // This is a create action
            if (!Auth::user()->can('countries.create')) {
                abort(403, 'Unauthorized create action.');
            }
        }
        $items = Country::where('status', '<>', 0)
            // ->where('parent', null)
            ->where('countries_id', '<>', $id ?? null)
            ->orderBy('title', 'asc')
            ->pluck('title', 'countries_id')->toArray();

        // If $id is provided, fetch the item for editing
        $item = $id ? Country::findOrFail($id) : null;

        // If $item is null, we are in create mode and we need to set the default template location
        // specify the template default location by template title and child title

        $location = $item
            ? $this->templateService->getTemplateLocation('Country', $item->countries_id)
            : $this->templateService->getDefaultLocation('home', 'home.country');

        return view('backend.countries.create', compact('items', 'item', 'location'));
    }

    public function save(Request $request, $id = null)
    {
        if ($id) {
            if (!Auth::user()->can('countries.update')) {
                abort(403, 'Unauthorized update action.');
            }
        } else {
            if (!Auth::user()->can('countries.store')) {
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
            'country_id',
            'title',
            'alias',
            'cover',
            'thumb',
            'description',
            'entries',
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
            $item = Country::findOrFail($id);
            $item->update($data);
            $message = 'Country updated successfully!';
        } else {
            // Create new item
            $data['alias'] = Str::slug($data['title']);
            $item = Country::create($data);
            $message = 'Country created successfully!';
        }

        // Call function to update template entries
        $this->templateService->updateTemplateEntries('Country', $templateId, $childId, $item->countries_id, $item->status);

        // Redirect based on user role/permission
        if (Auth::user()->hasRole('superadmin') || Auth::user()->hasPermissionTo('countries.index')) {
            return redirect()->route('countries.index')->with('success', $message);
        }
        return redirect()->back()->with('success', $message);
    }


    public function view($id)
    {
        $item = Country::findOrFail($id);
        return view('backend.countries.view', compact('item'));
    }

    public function delete($id)
    {
        try {
            $item = Country::findOrFail($id);
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
            $page = Country::findOrFail($id);

            $page->status = $publish;
            $page->save();

            $message = $publish == 1
                ? 'Country published successfully'
                : 'Country unpublished successfully';

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
                ? 'Unable to publish the Country'
                : 'Unable to unpublish the Country';

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
                Country::where('countries_id', $item['id'])
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
            $item = Country::findOrFail($id);
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

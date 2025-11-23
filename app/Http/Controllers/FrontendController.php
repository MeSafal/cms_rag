<?php

namespace App\Http\Controllers;
use App\Helpers\CMS_FMS;
use App\Models\Mapper;
use App\Models\Page;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FrontendController extends Controller
{
    protected $cms;

    public function __construct()
    {
        $this->cms = new CMS_FMS();
    }

    // protected $frontendPath;
    // protected $cms;

    // public function __construct()
    // {
    //     $this->cms = new CMS_FMS();
    //     $this->frontendPath = env('FRONTEND_PAHT', 'resturant');
    // }

    public function home()
    {
        $page = Template::published()->parentOne()->ordered()->first();
        if (!$page) {
            if (!env('APP_ENV') == 'local') {
                return view(frontendPath() . '.404');
            }
        }
        $children = $this->cms->getTemplateChildren($page->children);
        $data = $this->cms->getTemplateData($page->templates_id, $children->pluck('id'));


        return view(frontendPath() . '.home', compact('page', 'children', 'data'));
    }

    public function loadPages($path)
    {
        $segments = explode('/', $path);
        $segmentCount = count($segments);

        if ($segmentCount < 1 || $segmentCount > 3) {
            return view(frontendPath() . '.404');
        }

        $pageAlias = $segments[0] ?? null;

        if (!$pageAlias) {
            return view(frontendPath() . '.404');
        }

        $page = Template::where('status', 1)
            ->where('alias', $pageAlias)
            ->first();

        if (!$page) {
            return view(frontendPath() . '.404');
        }

        $children = $this->cms->getTemplateChildren($page->children);
        $data = $this->cms->getTemplateData($page->templates_id, $children->pluck('id'));

        if ($segmentCount === 1) {
            return view(frontendPath() . '.home', compact('page', 'children', 'data'));
        }

        if ($segmentCount === 2) {
            return view(frontendPath() . '.404');
        }

        $mapperAlias = $segments[1] ?? null;
        $contentAlias = $segments[2] ?? null;

        if (!$mapperAlias || !$contentAlias) {
            return view(frontendPath() . '.404');
        }

        $table = Mapper::where('status', 1)
            ->where('alias', $mapperAlias)
            ->value('title');

        if (!$table) {
            return view(frontendPath() . '.404');
        }

        $modelClass = "App\\Models\\{$table}";
        if (!class_exists($modelClass)) {
            return view(frontendPath() . '.404');
        }

        $content = $modelClass::where('status', 1)
            ->where('alias', $contentAlias)
            ->first();

        if (!$content) {
            return view(frontendPath() . '.404');
        }

        return view(frontendPath() . '.home', compact('page', 'children', 'data', 'content'));
    }


    public function about()
    {
        return view(frontendPath() . '.our-chef');
    }

    public function contact()
    {
        return view(frontendPath() . '.contact');
    }

    public function tableSingle($table, $alias)
    {
        $modelClass = "App\\Models\\{$table}";
        if (!class_exists($modelClass)) {
            return view(frontendPath() . '.404');
        }
        $content = $modelClass::where('status', 1)
            ->where('alias', $alias)
            ->first();
        if (!$content) {
            if (!env('APP_ENV') == 'local') {
                // If not in local environment, return custom 404 page
                return view(frontendPath() . '.404');
            }
        }


        // $page = Template::where('status', 1)
        //     ->where('alias', $alias)
        //     ->first();
        // if (!$page) {
        //     if (!env('APP_ENV') == 'local') {
        //         return view(frontendPath() . '.404');
        //     }
        // }
        // $children = $this->cms->getTemplateChildren($page->children);

        return view(frontendPath() . '.single', compact('content'));
    }

}

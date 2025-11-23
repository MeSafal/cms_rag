<?php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Template;
class Templates extends Component
{
    public $templateOptions;
    public $location;

    public function __construct($location = null, $templateOptions = [])
    {
        $this->location = $location;
        $this->templateOptions = $templateOptions;
    }

    public function render()
    {
        return view('components.templates');
    }
}

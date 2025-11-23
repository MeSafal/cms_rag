<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class extraButtonCard extends Component
{
    /**
     * Create a new component instance.
     */
     public $initial;

    public function __construct($initial = null)
    {
        $this->initial = $initial;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.extra-button-card');
    }
}

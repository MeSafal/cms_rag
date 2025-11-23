<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class extraContentCard extends Component
{
    public $itemEdit;

    public function __construct($itemEdit = null) // <- null, not 'null'
    {
        $this->itemEdit = $itemEdit;
    }

    public function render(): View|Closure|string
    {
        return view('components.extra-content-card');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DefaulGuestAdminLayout extends Component
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = $title;
    }

    public function render(): View
    {
        return view('components.defaul-guest-admin-layout');
    }
}

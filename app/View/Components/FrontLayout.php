<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class FrontLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // dd($this->notifications());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layout.front-layout');
    }

    public function notifications()
    {
        if (Auth::check()) {
            if(Auth::user()->unreadNotifications){
                return count(Auth::user()->unreadNotifications);
            }
        }
    }
}

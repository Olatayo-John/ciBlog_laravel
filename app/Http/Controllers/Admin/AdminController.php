<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if(!$this->authorize('authorization')){
            abort('403');
        }
        
        return view('admin.dashboard');
    }
}

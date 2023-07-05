<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function dashboard()
    {

        if (Auth::user()->role->pluck('name')->contains('Admin')) {
            return to_route('admin.dashboard');
        }
        if (Auth::user()->role->pluck('name')->contains('Staff')) {
            return to_route('admin.dashboard');
        }
        if (Auth::user()->role->pluck('name')->contains('User')) {
            return to_route('home');
        }
    }

    public function index()
    {
        return view('pages.index');
    }

    public function support()
    {
        return view('pages.support');
    }
}

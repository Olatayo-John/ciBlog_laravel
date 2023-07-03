<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $data['title'] = 'home';

        return view('pages.index',$data);
    }

    public function support()
    {
        $data['title'] = 'support';

        return view('pages.support')->with($data);
    }
}

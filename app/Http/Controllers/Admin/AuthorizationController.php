<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorizationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if(!$this->authorize('authorization')){
            abort('403');
        }
    
        $data['roles']= Role::all();

        return view('admin.authorization')->with($data);
    }
}

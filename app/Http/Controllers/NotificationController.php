<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $data['notifications'] = Auth::user()->unreadNotifications;

        return view('notification.index')->with($data);
    }

    public function markAsRead(Request $request)
    {
        if ($request->input('notID')) {
            Auth::user()->unreadNotifications->find($request->notID)->markAsRead();

            $data['status'] = true;
        }

        return $data;
    }
}

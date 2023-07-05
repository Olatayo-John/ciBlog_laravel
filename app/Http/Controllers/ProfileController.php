<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\UserSettingTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyUserPasswordChange;
use Illuminate\Support\Facades\Storage;
use App\Jobs\NotifyUserPasswordChangeJob;
use App\Mail\NotifyUserPasswordChangeMail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserPasswordChangeNotification;


class ProfileController extends Controller
{
    use UserSettingTrait;
    use UserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!$this->authorize('profile')) {
            abort(403);
        }

        $data['settingImage'] = $this->userSettingValue($meta_key = 'default_profile_image', auth()->user());
        $data['userrole'] = Auth::user()->role->first()->name;
        $data['userPermissions'] = Auth::user()->permissions->pluck('name')->toArray();

        return view('profile.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!$this->authorize('profile_edit')) {
            abort(403);
        }

        return view('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!$this->authorize('profile_update')) {
            abort(403);
        }

        $this->isOwner($id);

        if (Auth::check()) {
            $updateFields = $request->validate([
                'name' => ['required', 'string'],
                'username' => ['nullable', 'string'],
                'email' => ['required', 'email'],
                'dob' => ['date', 'nullable'],
                'gender' => ['string', 'nullable'],
                'profileImage' => ['image', 'mimes:jpeg,jpe,png', 'max:1024', 'nullable'],
                'password_change_notify' => ['nullable', 'boolean']
            ]);

            if ($request->hasFile('profileImage')) {
                if (auth()->user()->profileImage) {
                    Storage::disk('public')->delete(auth()->user()->profileImage);
                }
                $updateFields['profileImage'] = $request->file('profileImage')->store('user_profile', 'public');
            }

            if ($request->filled('password')) {
                $updateFields['password']= Hash::make($request->input('password'));

                if ($request->input('password_change_notify') === "1") {
                    $user = auth()->user();

                    // Mail::to($request->email)->send(new NotifyUserPasswordChangeMail($user));
                    // Mail::to($request->email)->queue(new NotifyUserPasswordChangeMail($user));
                    NotifyUserPasswordChangeJob::dispatch($user); //dispatch job

                    // Notification::send($user, new UserPasswordChangeNotification()); //push notification
                }
            }

            unset($updateFields['password_change_notify']);
            DB::transaction(function () use ($id, $updateFields) {
                User::where('id', '=', $id)->update($updateFields);
            });

            return to_route('profile.index')->with('message', 'Profile Updated');
        }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->authorize('profile_delete')) {
            abort(403);
        }

        $this->isOwner($id);

        DB::transaction(function () use ($id) {
            User::destroy($id);
        });

        Auth::guard('web')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        $data['status'] = true;
        $data['msg'] = 'Profile deleted';
        $data['redirect'] = to_route('login');
    }
}

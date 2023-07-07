<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Traits\UserTrait;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Traits\UserSettingTrait;
use Illuminate\Support\Facades\DB;
use App\Jobs\UserPasswordChangeJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\admin\AddUserRequest;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\admin\UpdateUserRequest;
use App\Notifications\UserPasswordChangeNotification;
use Illuminate\Notifications\Events\NotificationFailed;

class UserController extends Controller
{
    use UserSettingTrait;
    use UserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!$this->authorize('users')) {
            abort('403');
        }

        $data['users'] = User::where([
            ['id', '!=', auth()->user()->id], //logged in staff/admin
            ['id', '!=', '1'], //admin
        ])
            ->latest()->get();

        return view('user.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!$this->authorize('user_create')) {
            abort('403');
        }

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserRequest $request)
    {
        if (!$this->authorize('user_create')) {
            abort('403');
        }

        $userFields = $request->validated();

        if ($request->hasFile('profileImage')) {
            $userFields['profileImage'] = $request->file('profileImage')->store('user_profile', 'public');
        }
        $userFields['password'] = Hash::make($request->input('password'));

        DB::transaction(function () use ($userFields) {
            $user = User::create($userFields);

            $user->role()->sync(Role::where('name', $userFields['role'])->pluck('id')->toArray());
            $this->UserInitialPermissions($user);
            $this->UserInitialSettings($user);

            event(new Registered($user));
        });

        return to_route('admin.user.index')->with('message', 'User created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (!$this->authorize('user_view')) {
            abort('403');
        }

        $data['user'] = $user;
        $data['settingImage'] = $this->userSettingValue($meta_key = 'default_profile_image', $user);
        $data['userrole'] = $user->role->first()->name;
        $data['userPermissions'] = $user->permissions->pluck('name')->toArray();

        return view('user.view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (!$this->authorize('user_edit')) {
            abort('403');
        }

        $data['user'] = $user;
        $data['userrole'] = $user->role->first()->name;
        $data['userPermissions'] = $user->permissions->pluck('name')->toArray();

        return view('user.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (!$this->authorize('user_update')) {
            abort('403');
        }

        $updateFields = $request->validated();

        if ($request->hasFile('profileImage')) {
            if ($user->profileImage) {
                Storage::disk('public')->delete($user->profileImage);
            }
            $updateFields['profileImage'] = $request->file('profileImage')->store('user_profile', 'public');
        }

        if ($request->filled('password')) {
            $updateFields['password'] = Hash::make($request->input('password'));

            if ($request->input('password_change_notify') === "1") {
                $userNotifyable= $user;
                $userNotifyable['userVia'] = $this->userSettingValue($meta_key = 'notify_me_by', $user);

                // UserPasswordChangeJob::dispatch($user); //dispatch job
                Notification::send($userNotifyable, new UserPasswordChangeNotification($userNotifyable));

            }

            unset($updateFields['password_change_notify']);
            unset($user['userVia']);
        }

        DB::transaction(function () use ($user, $updateFields) {
            $user->update($updateFields);
        });

        return back()->with('message', 'User profile updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$this->authorize('user_delete')) {
            abort('403');
        }
        DB::transaction(function () use ($user) {
            $user->delete();
        });

        return back()->with('message', 'User deleted');
    }

    public function userRole(Request $request, User $user)
    {
        if (!$this->authorize('user_role_update')) {
            abort('403');
        }

        $DBpermissionIDArr = array();
        foreach ($request->input('permissions') as $key => $permission) {
            $DBpermissionID = Permission::where('name', $key)->pluck('id')->first();
            array_push($DBpermissionIDArr, $DBpermissionID);
        }

        $user->permissions()->sync($DBpermissionIDArr);
        
        return back()->with('message', 'Permission updated');
    }
}

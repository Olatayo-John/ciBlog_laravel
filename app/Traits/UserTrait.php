<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    public function UserInitialPermissions($user)
    {
        $userRole = $user->load('role.permissions');
        $userRolePer = $userRole->role->pluck('permissions')->collapse()->pluck('id')->unique();
        $user->permissions()->sync($userRolePer->toArray());

        return true;
    }

    public function isOwner($id)
    {
        if ($id === Auth::user()->id) {
            return true;
        } else {
            abort(403, 'Unauthorized Action');
        }
    }
}

<?php

namespace App\Traits;

use App\Models\UserSetting;
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

    public function UserInitialSettings($user)
    {
        foreach (config('site.userSettings') as $settings) {
            UserSetting::create([
                'user_id' => $user->id,
                'title' => $settings['title'],
                'meta_key' => $settings['meta_key'],
                // 'meta_value'=> null,
                'meta_value' => $settings['meta_value_default'],
                'is_array' => $settings['is_array'],
            ]);
        }

        return true;
    }

    public function isOwner($id)
    {
        if (intval($id) === Auth::user()->id) {
            return true;
        } else {
            abort(403, 'Unauthorized Action');
        }
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $arr = [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'profileImage' => $this->profileImage,
        ];

        if ($this->relationLoaded('permissions')) {
            $arr['permissions'] = PermissionResource::collection($this->permissions);
        }
        if ($this->relationLoaded('role')) {
            $arr['role'] = RoleResource::collection($this->role);
        }
        $arr['posts'] = PostResource::collection($this->posts);
        
        if ($this->relationLoaded('usersetting')) {
            $arr['usersetting'] = UserSettingResource::collection($this->usersetting);
        }

        return $arr;
    }
}

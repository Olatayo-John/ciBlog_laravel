<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use UserTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # create admin of id(1)
        $adminuser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'info@codeflies.com',
        ]);
        $adminuser->role()->sync(Role::where('name', 'Admin')->pluck('id')->toArray());
        $this->UserInitialPermissions($adminuser);

        #users id(2-11)
        User::factory(10)->create()->each(function ($user) {
            $role = Role::where('name', 'User')->pluck('id')->toArray();
            $user->role()->sync($role);

            $this->UserInitialPermissions($user);
        });

        #staff
        User::factory(2)->create()->each(function ($user) {
            $role = Role::where('name', 'Staff')->pluck('id')->toArray();
            $user->role()->sync($role);

            $this->UserInitialPermissions($user);
        });

        #create my-account
        // $userme = User::factory()->create([
        //     'name' => 'JVweed',
        //     'email' => 'olatayo@codeflies.com',
        // ]);
        // $userme->role()->sync(Role::where('name', 'User')->pluck('id')->toArray());
        // $this->UserInitialPermissions($userme);
    }
}

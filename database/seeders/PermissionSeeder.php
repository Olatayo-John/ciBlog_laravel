<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(config('site.permissions') as $permission){
            $permissionDB= Permission::create([
                'title' => $permission['title'],
                'name' => $permission['name']
            ]);

            $roles= Role::whereIn('name', $permission['roles'])->get();
            foreach($roles as $role){
                $role->permissions()->attach([$permissionDB->id]);
            }

        }
    }
}

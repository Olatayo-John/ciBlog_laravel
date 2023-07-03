<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserSetting;

class UserSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSetting::truncate();

        $user= User::all()->each(function($user) {
            foreach(config('site.userSettings') as $settings){
                UserSetting::create([
                    'user_id'=>$user->id,
                    'title'=>$settings['title'],
                    'meta_key'=>$settings['meta_key'],
                    // 'meta_value'=> null,
                    'meta_value'=> $settings['meta_value_default'],
                    'is_array'=>$settings['is_array'],
                ]);
            }
        });
    }
}

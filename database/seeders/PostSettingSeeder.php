<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostSetting;

class PostSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts= Post::all()->each(function($post) {
            foreach(config('site.postSettings') as $postsetting){
                PostSetting::create([
                    'post_id'=> $post->id,
                    'title'=>$postsetting['title'],
                    'meta_key'=>$postsetting['meta_key'],
                    'meta_value'=> $postsetting['meta_value_default'],
                    // 'is_array'=>$postsetting['is_array'],
                ]);
            }
        });
    }
}

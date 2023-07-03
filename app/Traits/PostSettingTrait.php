<?php

namespace App\Traits;

trait PostSettingTrait
{
    public function allPostSettings($post)
    {
        $postSettingArr = array();

        foreach (config('site.postSettings') as $ps) {
            $postSettingArr[$ps['meta_key']] = $post->postsetting->where('meta_key', $ps['meta_key'])->first();
        }

        return $postSettingArr;
    }

}

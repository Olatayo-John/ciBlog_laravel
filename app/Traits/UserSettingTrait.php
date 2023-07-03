<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UserSettingTrait
{
    public function userSettingValue(string $meta_key, bool $transform)
    {
        if ($meta_key ?? false) {
            $meta_key_setting = auth()->user()->usersetting->filter(function ($settings) use ($meta_key) {
                return $settings['meta_key'] === $meta_key;
            })->first()->toArray();
            $meta_value_db = $meta_key_setting['meta_value'];
            $meta_value = Str::of($meta_value_db)->lower()->replace([' ', '-',], '_');

            return $meta_value;
        }
    }
}

<?php

use App\Modules\Settings\Models\Configuration;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        // Cache settings for 24 hours to keep the site fast
        return Cache::remember('setting_' . $key, 86400, function() use ($key, $default) {
            $setting = Configuration::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }
}

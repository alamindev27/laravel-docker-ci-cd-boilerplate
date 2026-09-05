<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    /**
     * Get the specified setting value from permanent cache.
     *
     * @param  mixed  $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        $settings = Cache::rememberForever('app_settings', function () {
            return Setting::pluck('value', 'key')->all();
        });

        return $settings[$key] ?? $default;
    }
}

if (! function_exists('app_version')) {
    function app_version()
    {
        $path = base_path('version.txt');

        if (file_exists($path)) {
            return trim(file_get_contents($path));
        }

        return 'v1.0.0';
    }
}

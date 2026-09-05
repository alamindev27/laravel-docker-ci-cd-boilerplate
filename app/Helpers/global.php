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
        $versionFile = base_path('version.txt');

        // ১. যদি version.txt ফাইল থাকে (যেমন প্রোডাকশন বা ম্যানুয়ালি ক্রিয়েট করা)
        if (file_exists($versionFile)) {
            $appVersion = trim(file_get_contents($versionFile));
            if (! empty($appVersion)) {
                return $appVersion;
            }
        }

        // ২. লোকালের জন্য সেফ গিট কমান্ড (যাতে safe.directory বা কোনো এরর টেক্সট ফুটারে না আসে)
        $localVersion = trim(@exec('git -c safe.directory="*" describe --tags --abbrev=0 2>/dev/null'));

        if (! empty($localVersion) && ! str_contains($localVersion, 'fatal') && ! str_contains($localVersion, 'error')) {
            return $localVersion;
        }

        // ৩. কোনোভাবেই না পেলে ফলব্যাক ভার্সন
        return 'v1.0.0';
    }
}

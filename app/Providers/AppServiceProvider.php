<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // setup dynamic timezone from db setting
        try {
            if (Schema::hasTable('settings')) {
                $timezone = function_exists('setting') ? setting('app_timezone') : null;

                if ($timezone) {
                    date_default_timezone_set($timezone);
                    Config::set('app.timezone', $timezone);
                }
            }
        } catch (\Exception $e) {
            // কোনো এক্সেপশন বা ডাটাবেজ কানেকশন ইস্যু হলে বাইপাস করবে
        }

    }
}

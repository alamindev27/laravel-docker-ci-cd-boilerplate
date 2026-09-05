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

            // ২. SMTP dynamic setting
            $mailMailer = function_exists('setting') ? setting('mail_mailer') : null;
            if ($mailMailer) {
                Config::set('mail.default', $mailMailer);
                Config::set('mail.mailers.smtp.host', setting('mail_host'));
                Config::set('mail.mailers.smtp.port', setting('mail_port'));
                Config::set('mail.mailers.smtp.encryption', setting('mail_encryption'));
                Config::set('mail.mailers.smtp.username', setting('mail_username'));
                Config::set('mail.mailers.smtp.password', setting('mail_password'));
                Config::set('mail.from.address', setting('mail_from_address'));
                Config::set('mail.from.name', setting('mail_from_name'));
            }
        } catch (\Exception $e) {
            // কোনো এক্সেপশন বা ডাটাবেজ কানেকশন ইস্যু হলে বাইপাস করবে
        }

    }
}

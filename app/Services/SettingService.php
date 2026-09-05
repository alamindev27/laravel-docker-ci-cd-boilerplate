<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class SettingService
{
    /**
     * অ্যাপ্লিকেশনে ডায়নামিক কনফিগ বুট করা (টাইমজোন ও SMTP)
     */
    public function bootConfigurations()
    {
        // টেবিল চেক করা, যাতে মাইগ্রেশনের সময় বা ফ্রেশ ইন্সটলেশনে ক্র্যাশ না করে
        try {
            if (! Schema::hasTable('settings')) {
                return;
            }
        } catch (\Exception $e) {
            return;
        }

        // ১. টাইমজোন সেট করা (হেল্পার থেকে ডেটা নেবে, যা অলরেডি ক্যাশড)
        $timezone = setting('app_timezone');
        if ($timezone) {
            date_default_timezone_set($timezone);
            Config::set('app.timezone', $timezone);
        }

        // ২. SMTP সেট করা
        $mailMailer = setting('mail_mailer');
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
    }
}

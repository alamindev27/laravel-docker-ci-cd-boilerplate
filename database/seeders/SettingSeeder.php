<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // --- General Settings ---
            [
                'key' => 'site_name',
                'value' => 'Laravel Docker Boilerplate',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Production-ready starter template with RBAC & Docker',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_email',
                'value' => 'support@alamindev27.com',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_phone',
                'value' => '+880 1234 567890',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_address',
                'value' => 'Dhaka, Bangladesh',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_logo',
                'value' => 'uploads/default/settings/logo.png',
                'type' => 'file',
                'group' => 'general',
            ],
            [
                'key' => 'site_favicon',
                'value' => 'uploads/default/settings/favicon.ico',
                'type' => 'file',
                'group' => 'general',
            ],
            [
                'key' => 'author_name',
                'value' => 'MD Al-Amin',
                'type' => 'text',
                'group' => 'general',
            ],

            // --- Social Links ---
            ['key' => 'facebook_url', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'github_url', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => '', 'type' => 'text', 'group' => 'social'],

            // --- SMTP & Mail Settings ---
            ['key' => 'mail_mailer', 'value' => 'smtp', 'type' => 'text', 'group' => 'smtp'],
            ['key' => 'mail_host', 'value' => '', 'type' => 'text', 'group' => 'smtp'],
            ['key' => 'mail_port', 'value' => '', 'type' => 'text', 'group' => 'smtp'],
            ['key' => 'mail_username', 'value' => '', 'type' => 'text', 'group' => 'smtp'],
            ['key' => 'mail_password', 'value' => '', 'type' => 'text', 'group' => 'smtp'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'type' => 'text', 'group' => 'smtp'],
            ['key' => 'mail_from_address', 'value' => '', 'type' => 'text', 'group' => 'smtp'],
            ['key' => 'mail_from_name', 'value' => '', 'type' => 'text', 'group' => 'smtp'],

            // --- System & Mode Settings ---
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'system',
            ],
            [
                'key' => 'app_timezone',
                'value' => 'Asia/Dhaka',
                'type' => 'select',
                'group' => 'system',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                ]
            );
        }
    }
}

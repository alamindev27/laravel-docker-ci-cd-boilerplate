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
            [
                'key' => 'site_name',
                'value' => 'Laravel Docker Boilerplate',
                'type' => 'text',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Production-ready starter template with RBAC & Docker',
                'type' => 'text',
            ],
            [
                'key' => 'site_email',
                'value' => 'support@alamindev27.com',
                'type' => 'text',
            ],
            [
                'key' => 'site_phone',
                'value' => '+880 1234 567890',
                'type' => 'text',
            ],
            [
                'key' => 'site_address',
                'value' => 'Dhaka, Bangladesh',
                'type' => 'text',
            ],
            [
                'key' => 'site_logo',
                'value' => 'uploads/default/settings/logo.png',
                'type' => 'file', // eta user caile change korte parbe text o dite parbe
            ],
            [
                'key' => 'site_favicon',
                'value' => 'uploads/default/settings/favicon.ico',
                'type' => 'file',
            ],
            [
                'key' => 'author_name',
                'value' => 'MD Al-Amin',
                'type' => 'text',
            ],
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'boolean',
            ],
            ['key' => 'facebook_url', 'value' => '', 'type' => 'text'],
            ['key' => 'instagram_url', 'value' => '', 'type' => 'text'],
            ['key' => 'twitter_url', 'value' => '', 'type' => 'text'],
            ['key' => 'linkedin_url', 'value' => '', 'type' => 'text'],
            ['key' => 'github_url', 'value' => '', 'type' => 'text'],
            ['key' => 'youtube_url', 'value' => '', 'type' => 'text'],

            ['key' => 'mail_mailer', 'value' => 'smtp', 'type' => 'text'],
            ['key' => 'mail_host', 'value' => '', 'type' => 'text'],
            ['key' => 'mail_port', 'value' => '', 'type' => 'text'],
            ['key' => 'mail_username', 'value' => '', 'type' => 'text'],
            ['key' => 'mail_password', 'value' => '', 'type' => 'text'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'type' => 'text'],
            ['key' => 'mail_from_address', 'value' => '', 'type' => 'text'],
            ['key' => 'mail_from_name', 'value' => '', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                ]
            );
        }
    }
}

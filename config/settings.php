<?php

return [
    'tabs' => [
        'general' => [
            'name' => 'General',
            'fields' => [
                ['key' => 'site_name', 'label' => 'Site Name', 'type' => 'text', 'required' => true],
                ['key' => 'site_tagline', 'label' => 'Site Tagline', 'type' => 'text'],
                ['key' => 'site_email', 'label' => 'Site Email', 'type' => 'email'],
                ['key' => 'site_phone', 'label' => 'Site Phone', 'type' => 'text'],
                ['key' => 'site_address', 'label' => 'Site Address', 'type' => 'text'],
                ['key' => 'author_name', 'label' => 'Author Name', 'type' => 'text'],
                ['key' => 'site_logo', 'label' => 'Site Logo', 'type' => 'file'],
                ['key' => 'site_favicon', 'label' => 'Site Favicon', 'type' => 'file'],
            ],
        ],
        'smtp' => [
            'name' => 'SMTP & Mail',
            'fields' => [
                ['key' => 'mail_mailer', 'label' => 'Mail Mailer', 'type' => 'text', 'required' => true],
                ['key' => 'mail_host', 'label' => 'Mail Host', 'type' => 'text', 'required' => true],
                ['key' => 'mail_port', 'label' => 'Mail Port', 'type' => 'text', 'required' => true],
                ['key' => 'mail_username', 'label' => 'Mail Username', 'type' => 'text', 'required' => true],
                ['key' => 'mail_password', 'label' => 'Mail Password', 'type' => 'password', 'required' => true],
                ['key' => 'mail_encryption', 'label' => 'Mail Encryption', 'type' => 'text', 'required' => true],
                ['key' => 'mail_from_address', 'label' => 'Sender Email', 'type' => 'email', 'required' => true],
                ['key' => 'mail_from_name', 'label' => 'Sender Name', 'type' => 'text', 'required' => true],
            ],
        ],
        'social' => [
            'name' => 'Social Links',
            'fields' => [
                ['key' => 'facebook_url', 'label' => 'Facebook URL', 'type' => 'url'],
                ['key' => 'instagram_url', 'label' => 'Instagram URL', 'type' => 'url'],
                ['key' => 'twitter_url', 'label' => 'Twitter / X URL', 'type' => 'url'],
                ['key' => 'linkedin_url', 'label' => 'LinkedIn URL', 'type' => 'url'],
                ['key' => 'github_url', 'label' => 'GitHub URL', 'type' => 'url'],
                ['key' => 'youtube_url', 'label' => 'YouTube URL', 'type' => 'url'],
            ],
        ],
        'system' => [
            'name' => 'System & Mode',
            'fields' => [
                [
                    'key' => 'maintenance_mode',
                    'label' => 'Maintenance Mode Status',
                    'type' => 'select',
                    'options' => [
                        0 => 'Inactive (Site Live)',
                        1 => 'Active (Show Maintenance Page)',
                    ],
                    'required' => true,
                ],
                [
                    'key' => 'app_timezone',
                    'label' => 'System Timezone',
                    'type' => 'select',
                    'options' => [
                        'Asia/Dhaka' => 'Asia/Dhaka (BST)',
                        'UTC' => 'UTC',
                        'Asia/Kolkata' => 'Asia/Kolkata (IST)',
                        'America/New_York' => 'America/New_York (EST)',
                        'Europe/London' => 'Europe/London (GMT)',
                    ],
                    'required' => true,
                ],
            ],
        ],
    ],
];

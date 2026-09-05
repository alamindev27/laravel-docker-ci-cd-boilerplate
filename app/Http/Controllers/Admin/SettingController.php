<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $currentTab = $request->get('tab', 'general');
        $tabs = config('settings.tabs');
        if (! array_key_exists($currentTab, $tabs)) {
            $currentTab = 'general';
        }
        $settings = Setting::where('group', $currentTab)->get()->keyBy('key');

        return view('admin.settings.index', compact('settings', 'currentTab', 'tabs'));
    }

    public function update(Request $request)
    {
        $activeTab = $request->input('active_tab', 'general');

        // প্রতিটি ট্যাবের জন্য আলাদা ভ্যালিডেশন রুলস অ্যারে
        $rules = [
            'general' => [
                'site_name' => 'nullable|string|max:255',
                'site_tagline' => 'nullable|string|max:255',
                'site_email' => 'nullable|email|max:255',
                'site_phone' => 'nullable|string|max:50',
                'site_address' => 'nullable|string|max:500',
                'author_name' => 'nullable|string|max:255',
                'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
                'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,webp,ico|max:1024',
            ],
            'smtp' => [
                'mail_mailer' => 'required|string|max:50',
                'mail_host' => 'required|string|max:255',
                'mail_port' => 'required|string|max:20',
                'mail_username' => 'required|string|max:255',
                'mail_password' => 'nullable|string|max:255', // পাসওয়ার্ড খালি থাকতে পারে (যদি পরিবর্তন না করতে চায়)
                'mail_encryption' => 'required|string|max:50',
                'mail_from_address' => 'required|email|max:255',
                'mail_from_name' => 'required|string|max:255',
            ],
            'social' => [
                'facebook_url' => 'nullable|url|max:255',
                'instagram_url' => 'nullable|url|max:255',
                'twitter_url' => 'nullable|url|max:255',
                'linkedin_url' => 'nullable|url|max:255',
                'github_url' => 'nullable|url|max:255',
                'youtube_url' => 'nullable|url|max:255',
            ],
            'system' => [
                'maintenance_mode' => 'required|in:0,1',
                'app_timezone' => 'required|string|max:100',
            ],
        ];

        // বর্তমান ট্যাবের রুলস দিয়ে ভ্যালিডেশন রান করা
        $request->validate($rules[$activeTab] ?? []);

        // ডাটা আপডেট লজিক
        foreach ($request->except(['_token', '_method', 'active_tab']) as $key => $value) {

            // ১. SMTP পাসওয়ার্ড ফিল্ড খালি থাকলে ডাটাবেজের পুরনো পাসওয়ার্ড ওভাররাইট হওয়া থেকে বাঁচাবে
            if ($key === 'mail_password' && empty($value)) {
                continue;
            }

            if ($request->hasFile($key)) {
                // ফাইল আপলোড হ্যান্ডেলিং
                $file = $request->file($key);
                $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                $value = 'uploads/settings/'.$filename;
            }

            // ২. গ্রুপ বা ট্যাব নাম সহ সেটিংস সেভ করা
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'group' => $activeTab,
                ]
            );
        }

        return redirect()->route('admin.settings.index', ['tab' => $activeTab])
            ->with('success', ucfirst($activeTab).' settings updated successfully!');
    }
}

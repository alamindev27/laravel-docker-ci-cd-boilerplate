@extends('admin.layouts.admin')

@section('content')
    @php
        $currentTab = request('tab', 'general');
        $tabs = [
            'general' => [
                'name' => 'General',
                'fields' => [
                    ['key' => 'site_name', 'label' => 'Site Name', 'type' => 'text', 'required' => true],
                    ['key' => 'site_tagline', 'label' => 'Site Tagline', 'type' => 'text'],
                    ['key' => 'site_email', 'label' => 'Site Email', 'type' => 'email'],
                    ['key' => 'site_phone', 'label' => 'Site Phone', 'type' => 'text'],
                    ['key' => 'site_address', 'label' => 'Site Address', 'type' => 'text'],
                    ['key' => 'author_name', 'label' => 'Author Name', 'type' => 'text'],
                ],
                'files' => ['site_logo', 'site_favicon'],
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
                'selects' => [
                    [
                        'key' => 'maintenance_mode',
                        'label' => 'Maintenance Mode Status',
                        'options' => [1 => 'Active (Show Maintenance Page)', 0 => 'Inactive (Site Live)'],
                        'required' => true,
                    ],
                ],
            ],
        ];
    @endphp

    <div class="py-2">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- সাকসেস মেসেজ --}}
            @if (session('success'))
                <div
                    class="bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- গ্লোবাল ভ্যালিডেশন এরর --}}
            @if ($errors->any())
                <div
                    class="bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 px-4 py-3 rounded-xl text-sm">
                    <p class="font-semibold mb-1">Please fix the validation errors below:</p>
                    <ul class="list-disc list-inside text-xs space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- হেডার এবং ট্যাব নেভিগেশন --}}
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-2xl shadow-sm">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white"><span class="capitalize">{{ $currentTab }}</span> Management</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Configure your app settings independently.</p>
                </div>

                <div class="flex flex-wrap gap-2 bg-slate-100 dark:bg-slate-800 p-1.5 rounded-xl">
                    @foreach ($tabs as $key => $tab)
                        <a href="{{ route('admin.settings.index', ['tab' => $key]) }}"
                            class="px-4 py-2 text-xs font-semibold rounded-lg transition {{ $currentTab === $key ? 'bg-white dark:bg-slate-900 text-indigo-600 dark:text-indigo-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                            {{ $tab['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- ডাইনামিক ফর্ম (মাত্র একটি ফর্ম দিয়ে সব হ্যান্ডেল হবে) --}}
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="active_tab" value="{{ $currentTab }}">

                <div
                    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden shadow-xl sm:rounded-2xl p-6 sm:p-8 space-y-5">
                    <h3
                        class="text-lg font-semibold text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
                        {{ $tabs[$currentTab]['name'] }} Configuration
                    </h3>

                    {{-- সাধারণ টেক্সট/ইমেইল/ইউআরএল ইনপুট ফিল্ড লুপ --}}
                    @if (isset($tabs[$currentTab]['fields']))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($tabs[$currentTab]['fields'] as $field)
                                @php $setting = $settings[$field['key']] ?? null; @endphp
                                <div
                                    class="{{ in_array($field['type'], ['text', 'url']) && count($tabs[$currentTab]['fields']) <= 3 ? 'col-span-2' : '' }}">
                                    <label
                                        class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                                        {{ $field['label'] }}
                                        @if (isset($field['required']))
                                            <span class="text-rose-500">*</span>
                                        @endif
                                    </label>
                                    <input type="{{ $field['type'] }}" name="{{ $field['key'] }}"
                                        value="{{ old($field['key'], $setting->value ?? '') }}"
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- সিলেক্ট ড্রপডাউন ফিল্ড লুপ (যেমন: Maintenance Mode) --}}
                    @if (isset($tabs[$currentTab]['selects']))
                        @foreach ($tabs[$currentTab]['selects'] as $select)
                            @php $setting = $settings[$select['key']] ?? null; @endphp
                            <div>
                                <label
                                    class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                                    {{ $select['label'] }}
                                    @if (isset($select['required']))
                                        <span class="text-rose-500">*</span>
                                    @endif
                                </label>
                                <select name="{{ $select['key'] }}"
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    @foreach ($select['options'] as $val => $label)
                                        <option value="{{ $val }}"
                                            {{ old($select['key'], $setting->value ?? '') == $val ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    @endif

                    {{-- লোগো বা ফাইলের ফিল্ড থাকলে --}}
                    @if (isset($tabs[$currentTab]['files']))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                            @foreach ($tabs[$currentTab]['files'] as $fileKey)
                                @php $setting = $settings[$fileKey] ?? null; @endphp
                                <div
                                    class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
                                    <label
                                        class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                                        {{ ucwords(str_replace('_', ' ', $fileKey)) }}
                                    </label>
                                    <div class="flex items-center gap-4">
                                        @if ($setting && $setting->value)
                                            <img src="{{ asset($setting->value) }}" alt="{{ $fileKey }}"
                                                class="w-10 h-10 object-contain bg-white dark:bg-slate-800 p-1 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm">
                                        @endif
                                        <input type="file" name="{{ $fileKey }}"
                                            class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-indigo-900/40 dark:file:text-indigo-300 cursor-pointer">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex justify-end pt-6 mt-8 border-t border-slate-100 dark:border-slate-800">
                        <button type="submit"
                            class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                            Save {{ $tabs[$currentTab]['name'] }} Changes
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

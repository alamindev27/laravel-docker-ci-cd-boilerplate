@extends('admin.layouts.admin')

@section('content')


    <div class="py-2">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">


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

            {{-- হেডার এবং ট্যাব নেভিগেশন (এক লাইনে ফিক্সড) --}}
            <div
                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-3 sm:p-5 rounded-2xl shadow-sm">
                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

                    {{-- টাইটেল এবং সাবটাইটেল সেকশন --}}
                    <div class="space-y-1">
                        <div class="flex items-center gap-3">
                            <div class="w-2.5 h-8 bg-indigo-600 rounded-full"></div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                                <span class="capitalize">{{ $currentTab }}</span> Management
                            </h2>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 pl-5">
                            Configure and manage your <span
                                class="font-medium text-slate-700 dark:text-slate-300 capitalize">{{ $currentTab }}</span>
                            settings securely and independently.
                        </p>
                    </div>

                    {{-- ট্যাব নেভিগেশন (flex-nowrap দিয়ে এক লাইনে ফিক্স করা হয়েছে) --}}
                    <div
                        class="flex flex-nowrap items-center gap-1 bg-slate-100 dark:bg-slate-800/80 p-1.5 rounded-xl border border-slate-200/60 dark:border-slate-700/60 overflow-x-auto xl:overflow-visible">
                        @foreach ($tabs as $key => $tab)
                            <a href="{{ route('admin.settings.index', ['tab' => $key]) }}"
                                class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg transition-all duration-200 whitespace-nowrap flex items-center justify-center {{ $currentTab === $key ? 'bg-white dark:bg-slate-900 text-indigo-600 dark:text-indigo-400 shadow-sm border border-slate-200/50 dark:border-slate-800' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-white/50 dark:hover:bg-slate-800' }}">
                                {{ is_array($tab) ? $tab['name'] : $tab }}
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>

            {{-- ডাইনামিক ফর্ম (মাত্র একটি ফর্ম দিয়ে সব হ্যান্ডেল হবে) --}}
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

                    {{-- সব ফিল্ড এক লুপে ডাইনামিক্যালি রেন্ডার হবে --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($tabs[$currentTab]['fields'] ?? [] as $field)
                            @php
                                $setting = $settings[$field['key']] ?? null;
                            @endphp

                            <div class="">
                                <label
                                    class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                                    {{ $field['label'] }}
                                    @if (isset($field['required']) && $field['required'])
                                        <span class="text-rose-500">*</span>
                                    @endif
                                </label>

                                {{-- ১. যদি ড্রপডাউন (select) হয় --}}
                                @if ($field['type'] === 'select')
                                    <select name="{{ $field['key'] }}"
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        @foreach ($field['options'] as $val => $label)
                                            <option value="{{ $val }}"
                                                {{ old($field['key'], $setting->value ?? '') == $val ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- ২. যদি ফাইল বা লোগো আপলোড হয় --}}
                                @elseif ($field['type'] === 'file')
                                    <div
                                        class="flex items-center gap-4 bg-slate-50 dark:bg-slate-800/50 p-3 rounded-xl border border-slate-100 dark:border-slate-800 col-span-2">
                                        @if ($setting && $setting->value)
                                            <img src="{{ asset($setting->value) }}" alt="{{ $field['label'] }}"
                                                class="w-10 h-10 object-contain bg-white dark:bg-slate-800 p-1 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm">
                                        @endif
                                        <input type="file" name="{{ $field['key'] }}"
                                            class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-indigo-900/40 dark:file:text-indigo-300 cursor-pointer">
                                    </div>

                                    {{-- ৩. সাধারণ টেক্সট, পাসওয়ার্ড, ইমেইল বা ইউআরএল ইনপুট --}}
                                @else
                                    <input type="{{ $field['type'] }}" name="{{ $field['key'] }}"
                                        value="{{ old($field['key'], $setting->value ?? '') }}"
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                                        autocomplete="off">
                                @endif
                            </div>
                        @endforeach
                    </div>

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

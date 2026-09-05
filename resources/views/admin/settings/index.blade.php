@extends('admin.layouts.admin')

@section('content')
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- সাকসেস মেসেজ --}}
            @if (session('success'))
                <div class="mb-4 bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 px-4 py-3 rounded-xl relative shadow-sm"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div
                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden shadow-xl sm:rounded-2xl p-6 sm:p-8">
                <div class="border-b border-slate-100 dark:border-slate-800 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">System Settings</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage your website general configurations,
                        branding and contact info.</p>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    @foreach ($settings as $setting)
                        <div
                            class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
                            <label
                                class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                                {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                            </label>

                            {{-- ১. ফাইল টাইপ হলে (লোগো বা ফেভিকন) --}}
                            @if ($setting->type === 'file')
                                <div class="flex items-center gap-4">
                                    @if ($setting->value)
                                        <img src="{{ asset($setting->value) }}" alt="{{ $setting->key }}"
                                            class="w-12 h-12 object-contain bg-white dark:bg-slate-800 p-1 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm">
                                    @endif
                                    <input type="file" name="{{ $setting->key }}"
                                        class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-indigo-900/40 dark:file:text-indigo-300 hover:file:bg-indigo-100 transition cursor-pointer">
                                </div>

                                {{-- ২. বুলিয়ান টাইপ হলে (যেমন: মেইনটেনেন্স মোড) --}}
                            @elseif($setting->type === 'boolean')
                                <select name="{{ $setting->key }}"
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    <option value="1" {{ $setting->value == 1 ? 'selected' : '' }}>Active / Yes
                                    </option>
                                    <option value="0" {{ $setting->value == 0 ? 'selected' : '' }}>Inactive / No
                                    </option>
                                </select>

                                {{-- ৩. সাধারণ টেক্সট টাইপ হলে --}}
                            @else
                                <input type="text" name="{{ $setting->key }}"
                                    value="{{ old($setting->key, $setting->value) }}"
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            @endif
                        </div>
                    @endforeach

                    <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-800">
                        <button type="submit"
                            class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                            Save All Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

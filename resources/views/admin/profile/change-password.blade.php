@extends('admin.layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Change Password</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Update your
                    password.</p>
            </div>
            <a href="{{ route('admin.profile.index') }}"
                class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-lg transition">
                Cancel
            </a>
        </div>

        <!-- Error Alerts -->
        @if ($errors->any())
            <div
                class="p-4 bg-rose-50 dark:bg-rose-900/30 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 rounded-xl text-sm space-y-1">
                <p class="font-semibold">Please fix the following errors:</p>
                <ul class="list-disc list-inside text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif




        <!-- Update Password Form -->
        <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Update Password</h3>

            <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label
                        class="block text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-400 mb-2">Current
                        Password</label>
                    <input type="password" name="current_password" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 transition">
                </div>

                <div>
                    <label
                        class="block text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-400 mb-2">New
                        Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 transition">
                </div>

                <div>
                    <label
                        class="block text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-400 mb-2">Confirm
                        New Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 transition">
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="px-5 py-2.5 bg-slate-800 hover:bg-slate-900 dark:bg-slate-700 dark:hover:bg-slate-600 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection

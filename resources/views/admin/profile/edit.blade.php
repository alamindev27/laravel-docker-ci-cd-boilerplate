@extends('admin.layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Profile</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Update your account profile information, avatar and
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


        <!-- Update Profile Information & Avatar Form -->
        <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Profile Information & Avatar</h3>

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
                class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Avatar Upload Section -->
                <div
                    class="flex flex-col sm:flex-row items-start sm:items-center gap-5 pb-4 border-b border-slate-100 dark:border-slate-800">
                    <div class="relative">
                        @php
                            $user = auth()->user();
                            $hasCustomAvatar = $user->avatar && !str_contains($user->avatar, 'ui-avatars.com');
                            $avatarUrl = $hasCustomAvatar
                                ? asset($user->avatar)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random';
                        @endphp
                        <img src="{{ $avatarUrl }}" alt="{{ $user->name }}"
                            class="w-20 h-20 rounded-full object-cover border-2 border-slate-200 dark:border-slate-700 shadow-sm">
                    </div>

                    <div class="flex-1 space-y-2">
                        <label
                            class="block text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-400">Profile
                            Picture</label>
                        <div class="flex flex-wrap items-center gap-3">
                            <input type="file" name="avatar" accept="image/png, image/jpeg, image/jpg, image/webp"
                                class="text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 dark:file:bg-brand-900/40 dark:file:text-brand-300 hover:file:bg-brand-100 transition">
                        </div>
                        <p class="text-xs text-slate-400">PNG, JPG, WEBP up to 2MB.</p>

                        @if ($hasCustomAvatar)
                            <div class="flex items-center gap-2 pt-1">
                                <label
                                    class="flex items-center gap-2 text-xs text-rose-600 dark:text-rose-400 cursor-pointer font-medium">
                                    <input type="checkbox" name="remove_avatar" value="1"
                                        class="rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                                    Remove current avatar and reset to default
                                </label>
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <label
                        class="block text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-400 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 transition">
                </div>

                <div>
                    <label
                        class="block text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-400 mb-2">Email
                        Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 transition">
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>



    </div>
@endsection

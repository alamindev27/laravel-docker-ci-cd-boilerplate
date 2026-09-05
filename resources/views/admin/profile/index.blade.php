@extends('admin.layouts.admin')

@section('content')
<div class="py-2">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">


        {{-- মূল কার্ড --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden shadow-xl sm:rounded-2xl p-6 sm:p-8">
            <div class="flex justify-between items-center border-b border-slate-100 dark:border-slate-800 pb-4 mb-6">
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Admin Profile Details</h2>

                @if (Route::has('admin.profile.edit'))
                    <a href="{{ route('admin.profile.edit') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-xl shadow transition duration-200 text-sm">
                        Edit Profile
                    </a>
                @endif
            </div>

            @php
                $user = auth()->user();
                $avatar = $user->avatar;
                $avatarUrl = $avatar && Str::startsWith($avatar, 'http') ? $avatar : ($avatar ? asset($avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff');
            @endphp

            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <div class="flex flex-col items-center">
                    <img src="{{ $avatarUrl }}"
                         alt="Avatar"
                         class="w-36 h-36 rounded-full object-cover shadow-md border-4 border-indigo-500 dark:border-indigo-400">
                    <span class="text-xs text-slate-400 dark:text-slate-500 mt-2">Active Avatar</span>
                </div>

                <div class="flex-1 w-full space-y-4">
                    <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
                        <label class="block text-xs font-semibold text-slate-400 dark:text-slate-400 uppercase tracking-wider">Full Name</label>
                        <p class="text-lg font-medium text-slate-800 dark:text-white mt-1">{{ $user->name }}</p>
                    </div>

                    <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
                        <label class="block text-xs font-semibold text-slate-400 dark:text-slate-400 uppercase tracking-wider">Email Address</label>
                        <p class="text-lg font-medium text-slate-800 dark:text-white mt-1">{{ $user->email }}</p>
                    </div>

                    <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
                        <label class="block text-xs font-semibold text-slate-400 dark:text-slate-400 uppercase tracking-wider">Account Role / Type</label>
                        <p class="text-lg font-medium text-indigo-600 dark:text-indigo-400 mt-1">Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Top Header -->
<header
    class="sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 h-16 flex items-center justify-between px-4 sm:px-6 transition-colors duration-300">

    <!-- Left: Sidebar Toggle & Site Logo -->
    <div class="flex items-center gap-4">
        <!-- 3-Line Menu Toggle Button (Works for both mobile & desktop) -->
        <button
            @click="if (window.innerWidth >= 1024) { desktopSidebarOpen = !desktopSidebarOpen } else { sidebarOpen = !sidebarOpen }"
            class="text-slate-600 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 focus:outline-none p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Site Logo -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
            @php
                $siteLogo = setting('site_logo');
                // চেক করা হচ্ছে এটি কি ফুল ইউআরএল নাকি স্টোরেজ পাথ বা লোকাল ডিফল্ট ইমেজ
                $isImage =
                    !empty($siteLogo) &&
                    (filter_var($siteLogo, FILTER_VALIDATE_URL) ||
                        file_exists(public_path('storage/' . $siteLogo)) ||
                        file_exists(public_path($siteLogo)));
            @endphp

            @if ($isImage)
                <!-- Image Logo -->
                <img src="{{ filter_var($siteLogo, FILTER_VALIDATE_URL) ? $siteLogo : (file_exists(public_path($siteLogo)) ? asset($siteLogo) : asset('storage/' . $siteLogo)) }}"
                    alt="{{ setting('site_name', 'Admin Panel') }}" class="h-8 sm:h-9 w-auto object-contain">
            @else
                <!-- Text Logo with Gradient -->
                <span
                    class="text-lg sm:text-xl font-black bg-gradient-to-r from-brand-600 to-purple-600 bg-clip-text text-transparent">
                    {{ setting('site_name', 'Admin Panel') }}
                </span>
            @endif
        </a>
    </div>

    <!-- Right: Theme Switcher & Admin Dropdown Profile -->
    <div class="flex items-center gap-3">
        <!-- Theme Switcher Button -->
        <button @click="darkMode = !darkMode"
            class="p-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
            <!-- Sun Icon -->
            <svg x-show="darkMode" class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
            <!-- Moon Icon -->
            <svg x-show="!darkMode" class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                </path>
            </svg>
        </button>

        <!-- Admin Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false"
                class="flex items-center gap-3 focus:outline-none p-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=6366f1&color=fff"
                    alt="Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-brand-500/30">
                <span
                    class="hidden md:block text-sm font-semibold text-slate-700 dark:text-slate-200">{{ auth()->user()->name ?? 'Admin' }}</span>
                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': open }"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" x-cloak x-transition.origin.top.right
                class="absolute right-0 mt-2 w-64 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl py-2 z-50">
                <!-- Top Part: Avatar and Name -->
                <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=6366f1&color=fff"
                        alt="Avatar" class="w-10 h-10 rounded-full object-cover">
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate">
                            {{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                            {{ auth()->user()->email ?? 'admin@example.com' }}</p>
                    </div>
                </div>

                <!-- Links -->
                <div class="py-1">
                    <a href="{{ route('admin.profile.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </a>
                    <a href="{{ route('admin.change-password') }}"
                        class="flex items-center gap-3 px-4 py-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                        </svg>
                        Change Password
                    </a>
                </div>

                <!-- Logout Form -->
                <div class="border-t border-slate-100 dark:border-slate-800 pt-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-2.5 text-xs sm:text-sm text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition text-left">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

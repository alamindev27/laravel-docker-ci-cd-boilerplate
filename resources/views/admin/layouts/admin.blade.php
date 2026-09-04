<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - {{ setting('site_name', 'Boilerplate') }}</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca'
                        }
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    class="h-full bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-100 font-sans transition-colors duration-300"
    x-data="{
        sidebarOpen: false,
        desktopSidebarOpen: true,
        darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
    }" x-init="$watch('darkMode', val => {
        localStorage.setItem('theme', val ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', val)
    })" :class="{ 'dark': darkMode }">

    <div class="min-h-screen flex flex-col">

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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
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
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200"
                            :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                </svg>
                                Personal Settings
                            </a>
                        </div>

                        <!-- Logout Form -->
                        <div class="border-t border-slate-100 dark:border-slate-800 pt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-2.5 text-xs sm:text-sm text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition text-left">
                                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
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

        <!-- Main Body Wrapper -->
        <div class="flex-1 flex overflow-hidden">

            <!-- Mobile Sidebar Backdrop -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
                class="fixed inset-0 bg-slate-950/50 z-20 lg:hidden"></div>

            <!-- Sidebar -->
            <aside
                :class="{
                    'translate-x-0': sidebarOpen,
                    '-translate-x-full': !sidebarOpen,
                    'lg:translate-x-0 lg:w-64': desktopSidebarOpen,
                    'lg:-translate-x-full lg:w-0 lg:overflow-hidden': !desktopSidebarOpen
                }"
                class="fixed lg:static inset-y-0 left-0 z-30 w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col transition-all duration-300 ease-in-out -translate-x-full lg:translate-x-0">

                <!-- Sidebar Menu Navigation -->
                <div class="flex-1 overflow-y-auto px-4 py-6 space-y-2 whitespace-nowrap">

                    <!-- Dashboard Link -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium bg-brand-50 dark:bg-brand-600/10 text-brand-600 dark:text-brand-400 transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Dropdown Navigation Example -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                </svg>
                                <span>Management</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200"
                                :class="{ 'rotate-90': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <!-- Submenu -->
                        <div x-show="open" x-cloak class="pl-11 pr-2 py-1 space-y-1">
                            <a href="#"
                                class="block px-3 py-2 rounded-lg text-xs font-medium text-slate-500 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">Users
                                List</a>
                            <a href="#"
                                class="block px-3 py-2 rounded-lg text-xs font-medium text-slate-500 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">Roles
                                & Permissions</a>
                        </div>
                    </div>

                    <!-- Another Menu Example -->
                    <a href="#"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                            </path>
                        </svg>
                        <span>Settings</span>
                    </a>

                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-8 flex flex-col justify-between">
                <div>
                    @yield('content')
                </div>

                <!-- Footer -->
                <footer
                    class="mt-12 pt-6 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 dark:text-slate-400 gap-2">
                    <div>&copy; {{ date('Y') }} {{ setting('site_name', 'Boilerplate') }}. All rights reserved.
                    </div>
                    <div class="flex items-center gap-3">
                        <span>v1.0.0</span>
                        <span>&bull;</span>
                        <span>Crafted by <a href="https://github.com/alamindev27" target="_blank"
                                class="text-brand-600 dark:text-brand-400 font-semibold underline">MD
                                Al-Amin</a></span>
                    </div>
                </footer>
            </main>

        </div>

    </div>
</body>

</html>

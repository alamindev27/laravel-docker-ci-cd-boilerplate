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
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 dark:bg-indigo-600/10 text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Dropdown Navigation Example -->
        @php
            $isManagementActive = request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*');
        @endphp
        <div x-data="{ open: {{ $isManagementActive ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ $isManagementActive ? 'text-indigo-600 dark:text-indigo-400 bg-slate-50 dark:bg-slate-800/40' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 {{ $isManagementActive ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                    </svg>
                    <span>Management</span>
                </div>
                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{ 'rotate-90': open }"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <!-- Submenu -->
            <div x-show="open" x-cloak class="pl-11 pr-2 py-1 space-y-1">
                <a href="#"
                    class="block px-3 py-2 rounded-lg text-xs font-medium transition {{ request()->routeIs('admin.users.*') ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50/60 dark:bg-indigo-950/40 font-semibold' : 'text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                    Users List
                </a>
                <a href="#"
                    class="block px-3 py-2 rounded-lg text-xs font-medium transition {{ request()->routeIs('admin.roles.*') ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50/60 dark:bg-indigo-950/40 font-semibold' : 'text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                    Roles & Permissions
                </a>
            </div>
        </div>

        <!-- Settings Link (এখন তৈরি করা সেটিংস পেজের রাউট যুক্ত করা হলো) -->
        <a href="{{ route('admin.settings.index') }}"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-50 dark:bg-indigo-600/10 text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.settings.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                </path>
            </svg>
            <span>Settings</span>
        </a>


        <a href="{{ route('admin.backups.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.backups.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 7v10c0 2.21 3.58 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.58 4 8 4s8-1.79 8-4M4 7c0-2.21 3.58-4 8-4s8 1.79 8 4m0 5c0 2.21-3.58 4-8 4s-8-1.79-8-4">
                </path>
            </svg>
            <span class="font-medium">Backup Management</span>
        </a>

    </div>
</aside>

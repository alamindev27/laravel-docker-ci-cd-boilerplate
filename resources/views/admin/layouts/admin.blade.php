<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta Author -->
    <meta name="author" content="{{ setting('author_name', 'MD Al-Amin') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Dynamic Favicon -->
    @php
        $favicon = setting('site_favicon');
        $hasFavicon =
            !empty($favicon) &&
            (filter_var($favicon, FILTER_VALIDATE_URL) ||
                file_exists(public_path('storage/' . $favicon)) ||
                file_exists(public_path($favicon)));

        $faviconUrl = $hasFavicon
            ? (filter_var($favicon, FILTER_VALIDATE_URL)
                ? $favicon
                : (file_exists(public_path($favicon))
                    ? asset($favicon)
                    : asset('storage/' . $favicon)))
            : asset('images/defaults/favicon.ico'); // ফলব্যাক ডিফল্ট ফেভিকন
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">

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
    @yield('header')
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

        @include('admin.layouts.partials.header')

        <!-- Main Body Wrapper -->
        <div class="flex-1 flex overflow-hidden">
            @include('admin.layouts.partials.sidebar')



            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-8 flex flex-col justify-between">
                <div>
                    @yield('content')
                </div>

                <!-- Footer -->
                @include('admin.layouts.partials.footer')
            </main>

        </div>

    </div>

    @yield('footer')
</body>

</html>

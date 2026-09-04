<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Laravel Docker Boilerplate</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-15px) scale(1.02);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                opacity: 0.4;
                transform: scale(1);
                filter: blur(60px);
            }

            50% {
                opacity: 0.7;
                transform: scale(1.1);
                filter: blur(80px);
            }
        }

        @keyframes gradient-shift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .floating {
            animation: float 3.5s ease-in-out infinite;
        }

        .pulse-bg {
            animation: pulse-glow 4s ease-in-out infinite;
        }

        .animated-gradient {
            background-size: 200% 200%;
            animation: gradient-shift 5s ease infinite;
        }
    </style>
</head>

<body
    class="bg-slate-950 text-slate-100 min-h-screen flex flex-col justify-between selection:bg-indigo-500 selection:text-white relative overflow-x-hidden">

    <!-- Enhanced Vibrant Background Glow Blobs -->
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[450px] bg-gradient-to-r from-indigo-600/30 via-purple-600/30 to-pink-600/30 rounded-full blur-3xl pulse-bg pointer-events-none">
    </div>

    <!-- Header / Navbar -->
    <header class="w-full max-w-7xl mx-auto px-4 sm:px-6 py-4 sm:py-6 flex justify-between items-center z-10">
        <div class="flex items-center gap-3">
            <span
                class="text-xl sm:text-2xl font-black bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                🚀 Boilerplate
            </span>
        </div>

        <nav class="flex items-center gap-2 sm:gap-4">
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-xs sm:text-sm font-medium bg-slate-800/80 hover:bg-slate-700 text-slate-200 px-3 py-2 rounded-xl transition border border-slate-700 shadow-lg shadow-indigo-500/10">Admin
                        Panel</a>
                @else
                    <a href="{{ route('user.dashboard') }}"
                        class="text-xs sm:text-sm font-medium bg-slate-800/80 hover:bg-slate-700 text-slate-200 px-3 py-2 rounded-xl transition border border-slate-700 shadow-lg shadow-indigo-500/10">Dashboard</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-xs sm:text-sm font-medium bg-rose-600/20 hover:bg-rose-600 text-rose-300 hover:text-white px-3 py-2 rounded-xl transition border border-rose-500/30">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="text-xs sm:text-sm font-medium text-slate-300 hover:text-white px-3 py-2 transition">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="text-xs sm:text-sm font-medium bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-4 py-2.5 rounded-xl transition shadow-lg shadow-indigo-600/40">Get
                        Started</a>
                @endif
            @endauth
        </nav>
    </header>

    <!-- Main Hero Section -->
    <main
        class="w-full max-w-5xl mx-auto px-4 sm:px-6 py-10 sm:py-16 flex flex-col items-center text-center z-10 my-auto">

        <!-- Badge with glowing animation -->
        <div
            class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-500/15 border border-indigo-500/30 text-indigo-300 text-[11px] sm:text-xs font-semibold uppercase tracking-wider mb-6 sm:mb-8 shadow-inner shadow-indigo-500/20">
            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-ping"></span>
            Laravel 13 &bull; Docker &bull; RBAC Ready
        </div>

        <!-- Heading with Vibrant Gradient Animation -->
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-extrabold tracking-tight mb-4 sm:mb-6 leading-tight">
            Production-Ready <br class="hidden sm:inline">
            <span
                class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-500 bg-clip-text text-transparent animated-gradient">
                Docker Boilerplate
            </span>
        </h1>

        <!-- Subtitle -->
        <p class="text-base sm:text-lg md:text-xl text-slate-400 max-w-2xl mb-8 sm:mb-10 px-2">
            A robust starter template featuring role-based access control (Admin/User), containerized infrastructure,
            automated CI/CD code style checks, and custom animated error pages.
        </p>

        <!-- CTA Buttons with glowing hover -->
        <div class="flex flex-wrap justify-center gap-3 sm:gap-4 w-full">
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-medium px-8 py-3.5 rounded-xl transition shadow-xl shadow-indigo-600/30 text-center">Go
                        to Admin Panel</a>
                @else
                    <a href="{{ route('user.dashboard') }}"
                        class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-medium px-8 py-3.5 rounded-xl transition shadow-xl shadow-indigo-600/30 text-center">Go
                        to Dashboard</a>
                @endif
            @else
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-medium px-8 py-3.5 rounded-xl transition shadow-xl shadow-indigo-600/40 text-center">Create
                    Account</a>
                <a href="{{ route('login') }}"
                    class="w-full sm:w-auto bg-slate-900/90 hover:bg-slate-800 text-slate-200 font-medium px-8 py-3.5 rounded-xl transition border border-slate-700/80 text-center shadow-lg">Sign
                    In</a>
            @endauth
        </div>

        <!-- Floating Feature Cards Preview with Hover Glow -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 w-full mt-14 sm:mt-20 text-left">
            <div class="bg-slate-900/70 border border-slate-800 hover:border-indigo-500/50 p-5 sm:p-6 rounded-2xl backdrop-blur-md transition duration-300 shadow-lg hover:shadow-indigo-500/10 floating"
                style="animation-delay: 0s;">
                <div class="text-3xl mb-3">🛡️</div>
                <h3 class="font-semibold text-slate-200 mb-1">Role-Based Access</h3>
                <p class="text-xs sm:text-sm text-slate-400">Isolated user and admin routing, custom middlewares, and
                    secure access checks.</p>
            </div>
            <div class="bg-slate-900/70 border border-slate-800 hover:border-purple-500/50 p-5 sm:p-6 rounded-2xl backdrop-blur-md transition duration-300 shadow-lg hover:shadow-purple-500/10 floating"
                style="animation-delay: 0.5s;">
                <div class="text-3xl mb-3">🐳</div>
                <h3 class="font-semibold text-slate-200 mb-1">Dockerized Setup</h3>
                <p class="text-xs sm:text-sm text-slate-400">Pre-configured container architecture with automated script
                    permissions.</p>
            </div>
            <div class="bg-slate-900/70 border border-slate-800 hover:border-pink-500/50 p-5 sm:p-6 rounded-2xl backdrop-blur-md transition duration-300 shadow-lg hover:shadow-pink-500/10 floating"
                style="animation-delay: 1s;">
                <div class="text-3xl mb-3">⚡</div>
                <h3 class="font-semibold text-slate-200 mb-1">CI/CD & Pint Style</h3>
                <p class="text-xs sm:text-sm text-slate-400">Strict code style enforcement via pre-commit hooks and
                    GitHub Actions.</p>
            </div>
        </div>

    </main>

    <!-- Footer with Credit Link -->
    <footer
        class="w-full text-center py-6 text-xs text-slate-400 border-t border-slate-900/80 z-10 px-4 flex flex-col sm:flex-row justify-center items-center gap-2">
        <span>&copy; {{ date('Y') }} Laravel Docker Boilerplate. All rights reserved.</span>
        <span class="hidden sm:inline">&bull;</span>
        <span>Crafted with ❤️ by <a href="https://github.com/alamindev27" target="_blank"
                class="text-indigo-400 hover:text-indigo-300 font-semibold transition underline underline-offset-4">MD
                Al-Amin</a></span>
    </footer>

</body>

</html>

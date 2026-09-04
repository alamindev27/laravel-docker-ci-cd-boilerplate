<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Laravel Docker Boilerplate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes pulse-glow {

            0%,
            100% {
                opacity: 0.3;
                transform: scale(1);
                filter: blur(60px);
            }

            50% {
                opacity: 0.6;
                transform: scale(1.08);
                filter: blur(80px);
            }
        }

        .pulse-bg {
            animation: pulse-glow 4s ease-in-out infinite;
        }
    </style>
</head>

<body
    class="bg-slate-950 text-slate-100 min-h-screen flex flex-col justify-between selection:bg-indigo-500 selection:text-white relative overflow-x-hidden">

    <!-- Background Glow -->
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg h-96 bg-gradient-to-r from-indigo-600/20 to-purple-600/20 rounded-full blur-3xl pulse-bg pointer-events-none">
    </div>

    <!-- Header -->
    <header class="w-full max-w-7xl mx-auto px-4 sm:px-6 py-6 flex justify-between items-center z-10">
        <a href="{{ url('/') }}"
            class="text-xl font-black bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
            🚀 Boilerplate
        </a>
        <a href="{{ route('register') }}" class="text-xs sm:text-sm text-slate-400 hover:text-white transition">Don't
            have an account? <span class="text-indigo-400 font-semibold underline">Sign up</span></a>
    </header>

    <!-- Main Content -->
    <main class="w-full max-w-md mx-auto px-4 py-8 z-10 my-auto">
        <div
            class="bg-slate-900/80 border border-slate-800 p-8 rounded-3xl backdrop-blur-xl shadow-2xl shadow-indigo-500/10">
            <div class="text-center mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mb-2">Welcome Back</h1>
                <p class="text-xs sm:text-sm text-slate-400">Please enter your details to sign in.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Email
                        Address</label>
                    <input type="email5" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm"
                        placeholder="name@example.com">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label
                            class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs text-indigo-400 hover:text-indigo-300 transition">Forgot password?</a>
                        @endif
                    </div>
                    <input type="password" name="password" required
                        class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-indigo-600 focus:ring-indigo-500">
                    <label for="remember" class="ml-2 text-xs text-slate-400">Remember me on this device</label>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-medium py-3 rounded-xl transition shadow-lg shadow-indigo-600/30 text-sm">
                    Sign In
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
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

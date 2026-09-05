<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Laravel Docker Boilerplate</title>
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
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg h-96 bg-gradient-to-r from-purple-600/20 to-indigo-600/20 rounded-full blur-3xl pulse-bg pointer-events-none">
    </div>

    <!-- Header -->
    <header class="w-full max-w-7xl mx-auto px-4 sm:px-6 py-6 flex justify-between items-center z-10">
        <a href="{{ url('/') }}"
            class="text-xl font-black bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
            🚀 Boilerplate
        </a>
    </header>

    <!-- Main Content -->
    <main class="w-full max-w-md mx-auto px-4 py-8 z-10 my-auto">
        <div
            class="bg-slate-900/80 border border-slate-800 p-8 rounded-3xl backdrop-blur-xl shadow-2xl shadow-purple-500/10">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-extrabold tracking-tight mb-2">Reset Password</h1>
                <p class="text-xs sm:text-sm text-slate-400">Please enter your new password below.</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Email
                        Address</label>
                    <input type="email" name="email" value="{{ old('email', request('email')) }}" required autofocus
                        class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">New
                        Password</label>
                    <input type="password" name="password" required
                        class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-medium py-3 rounded-xl transition shadow-lg shadow-indigo-600/30 text-sm mt-2">
                    Reset Password
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

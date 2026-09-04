<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Laravel Docker Boilerplate</title>
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
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg h-96 bg-gradient-to-r from-indigo-600/20 to-pink-600/20 rounded-full blur-3xl pulse-bg pointer-events-none">
    </div>

    <!-- Header -->
    <header class="w-full max-w-7xl mx-auto px-4 sm:px-6 py-6 flex justify-between items-center z-10">
        <a href="{{ url('/') }}"
            class="text-xl font-black bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
            🚀 Boilerplate
        </a>
        <a href="{{ route('login') }}" class="text-xs sm:text-sm text-slate-400 hover:text-white transition">&larr; Back
            to login</a>
    </header>

    <!-- Main Content -->
    <main class="w-full max-w-md mx-auto px-4 py-8 z-10 my-auto">
        <div
            class="bg-slate-900/80 border border-slate-800 p-8 rounded-3xl backdrop-blur-xl shadow-2xl shadow-indigo-500/10">
            <div class="text-center mb-6">
                <div class="text-4xl mb-3">🔑</div>
                <h1 class="text-2xl font-extrabold tracking-tight mb-2">Forgot Password?</h1>
                <p class="text-xs sm:text-sm text-slate-400">No problem. Enter your email address and we will email you
                    a password reset link.</p>
            </div>

            @if (session('status'))
                <div
                    class="mb-4 text-xs font-medium text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 p-3 rounded-xl text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Email
                        Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm"
                        placeholder="name@example.com">
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-medium py-3 rounded-xl transition shadow-lg shadow-indigo-600/30 text-sm mt-2">
                    Email Password Reset Link
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

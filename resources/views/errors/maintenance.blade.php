<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Under Maintenance</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <!-- Background Glow Effects -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div
        class="max-w-md w-full bg-slate-900/80 backdrop-blur-xl border border-slate-800 p-8 sm:p-10 rounded-3xl shadow-2xl text-center relative z-10">

        <!-- Animated Icon Container -->
        <div class="relative w-20 h-20 mx-auto mb-8 animate-float">
            <div class="absolute inset-0 bg-indigo-500/20 rounded-2xl blur-xl animate-pulse"></div>
            <div
                class="relative w-20 h-20 bg-gradient-to-tr from-indigo-600 to-indigo-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                <svg class="w-10 h-10 animate-spin" style="animation-duration: 8s;" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Heading & Description -->
        <h1 class="text-2xl font-bold tracking-tight text-white mb-3">System Upgrade in Progress</h1>
        <p class="text-sm text-slate-400 leading-relaxed mb-8">
            We are currently performing scheduled system updates to improve your experience. We’ll be back online
            shortly!
        </p>

        <!-- Status Badge -->
        <div
            class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-indigo-950/60 text-indigo-400 text-xs font-semibold border border-indigo-800/50 shadow-inner">
            <span class="relative flex h-2 w-2">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
            </span>
            Maintenance Mode Active
        </div>

        <!-- Footer Note -->
        <div class="mt-8 pt-6 border-t border-slate-800/80 text-xs text-slate-500">
            &copy; {{ date('Y') }} {{ setting('site_name') }}. All rights reserved.
        </div>
    </div>

</body>

</html>

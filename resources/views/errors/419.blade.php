<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Page Expired</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes spin-slow {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .rotating-clock {
            animation: spin-slow 10s linear infinite;
            display: inline-block;
        }
    </style>
</head>

<body class="bg-neutral-900 text-white h-screen flex flex-col justify-center items-center px-4">
    <div class="text-center max-w-md">
        <div class="rotating-clock text-7xl mb-4">⏳</div>
        <h1 class="text-3xl font-bold mb-2 text-amber-400">Page Expired</h1>
        <p class="text-neutral-400 mb-6">Your session has expired due to inactivity. Please refresh the page and try
            submitting your request again.</p>
        <a href="{{ url()->current() }}"
            class="inline-block bg-amber-500 hover:bg-amber-600 text-neutral-950 font-semibold px-6 py-3 rounded-xl transition duration-300 shadow-lg shadow-amber-500/20">Refresh
            Page</a>
    </div>
</body>

</html>

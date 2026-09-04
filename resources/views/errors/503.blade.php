<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Under Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes rotate-gear {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .rotating-gear {
            animation: rotate-gear 6s linear infinite;
            display: inline-block;
        }
    </style>
</head>

<body class="bg-slate-950 text-white h-screen flex flex-col justify-center items-center px-4">
    <div class="text-center max-w-md">
        <div class="rotating-gear text-7xl mb-4">🛠️</div>
        <h1 class="text-3xl font-bold mb-2 text-emerald-400">Under Maintenance</h1>
        <p class="text-slate-400 mb-6">We are currently performing scheduled maintenance on our servers. We will be back
            online shortly!</p>
        <div
            class="inline-block border border-emerald-500/30 bg-emerald-500/10 text-emerald-300 px-4 py-2 rounded-lg text-sm font-medium">
            Please check back in a few minutes.
        </div>
    </div>
</body>

</html>

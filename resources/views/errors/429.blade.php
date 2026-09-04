<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>429 - Too Many Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes pulse-speed {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.15);
                opacity: 0.8;
            }
        }

        .speeding {
            animation: pulse-speed 1s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-zinc-950 text-white h-screen flex flex-col justify-center items-center px-4">
    <div class="text-center max-w-md">
        <div class="speeding text-7xl mb-4">⚡</div>
        <h1 class="text-3xl font-bold mb-2 text-yellow-500">Too Many Requests</h1>
        <p class="text-zinc-400 mb-6">You have sent too many requests to this server in a short amount of time. Please
            slow down.</p>
        <a href="{{ url('/') }}"
            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-zinc-950 font-semibold px-6 py-3 rounded-xl transition duration-300 shadow-lg shadow-yellow-500/20">Back
            to Home</a>
    </div>
</body>

</html>

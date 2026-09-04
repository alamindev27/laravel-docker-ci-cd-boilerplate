<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Unauthorized</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes pulse-lock {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .locking {
            animation: pulse-lock 2s infinite;
        }
    </style>
</head>

<body class="bg-zinc-900 text-white h-screen flex flex-col justify-center items-center px-4">
    <div class="text-center max-w-md">
        <div class="locking text-7xl mb-4">🔒</div>
        <h1 class="text-3xl font-bold mb-2 text-rose-500">Unauthorized Action</h1>
        <p class="text-zinc-400 mb-6">Sorry, you do not have the necessary permissions to access this resource or view
            this page.</p>
        <a href="{{ url('/') }}"
            class="inline-block bg-rose-600 hover:bg-rose-700 text-white font-medium px-6 py-3 rounded-xl transition duration-300 shadow-lg shadow-rose-500/30">Go
            Back Home</a>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>401 - Unauthorized Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes bounce-key {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .bouncing-key {
            animation: bounce-key 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-950 text-white h-screen flex flex-col justify-center items-center px-4">
    <div class="text-center max-w-md">
        <div class="bouncing-key text-7xl mb-4">🔑</div>
        <h1 class="text-3xl font-bold mb-2 text-cyan-400">Authentication Required</h1>
        <p class="text-gray-400 mb-6">You must be logged in with appropriate credentials to view this page.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}"
                class="bg-cyan-600 hover:bg-cyan-700 text-white font-medium px-6 py-3 rounded-xl transition duration-300 shadow-lg shadow-cyan-500/30">Log
                In</a>
            <a href="{{ url('/') }}"
                class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-6 py-3 rounded-xl transition duration-300">Home</a>
        </div>
    </div>
</body>

</html>

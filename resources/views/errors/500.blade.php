<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-6px);
            }

            40%,
            80% {
                transform: translateX(6px);
            }
        }

        .shaking {
            animation: shake 1.5s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-stone-900 text-white h-screen flex flex-col justify-center items-center px-4">
    <div class="text-center max-w-md">
        <div class="shaking text-7xl mb-4">⚙️</div>
        <h1 class="text-3xl font-bold mb-2 text-orange-500">Server Error</h1>
        <p class="text-stone-400 mb-6">Something went wrong on our servers. We are already working to fix the issue,
            please check back shortly.</p>
        <a href="{{ url('/') }}"
            class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-medium px-6 py-3 rounded-xl transition duration-300 shadow-lg shadow-orange-500/30">Back
            to Home</a>
    </div>
</body>

</html>

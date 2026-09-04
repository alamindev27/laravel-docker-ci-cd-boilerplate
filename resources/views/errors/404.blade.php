<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .floating {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-slate-900 text-white h-screen flex flex-col justify-center items-center px-4">
    <div class="text-center max-w-md">
        <div class="floating text-8xl font-black text-indigo-500 mb-4 tracking-widest">404</div>
        <h1 class="text-3xl font-bold mb-2">Oops! Page not found</h1>
        <p class="text-slate-400 mb-6">The page you are looking for might have been removed, had its name changed, or is
            temporarily unavailable.</p>
        <a href="{{ url('/') }}"
            class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-xl transition duration-300 shadow-lg shadow-indigo-500/30">Back
            to Home</a>
    </div>
</body>

</html>

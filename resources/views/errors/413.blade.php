<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>413 Request Entity Too Large - {{ config('app.name', 'Boilerplate') }}</title>
    <!-- Tailwind CSS CDN (অথবা আপনার প্রজেক্টের অ্যাসেট) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body
    class="h-full bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 flex items-center justify-center p-6 selection:bg-brand-500 selection:text-white">

    <div class="max-w-md w-full text-center space-y-6">

        <!-- Error Icon / Illustration -->
        <div
            class="relative w-24 h-24 mx-auto flex items-center justify-center rounded-3xl bg-rose-50 dark:bg-rose-950/40 border border-rose-100 dark:border-rose-900/50 text-rose-600 dark:text-rose-400 shadow-sm">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>
            <span
                class="absolute -top-2 -right-2 px-2.5 py-0.5 bg-rose-600 text-white font-bold text-xs rounded-full uppercase tracking-wider shadow">413</span>
        </div>

        <!-- Error Description -->
        <div class="space-y-2">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">File Size Too Large</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                The file or data you are trying to upload exceeds the server upload limit. Please choose a smaller file
                and try again.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-4">
            <button onclick="history.back()"
                class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-semibold text-sm hover:bg-slate-50 dark:hover:bg-slate-800/80 transition shadow-sm">
                &larr; Go Back
            </button>
            <a href="{{ url('/admin/profile/edit') }}"
                class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-sm shadow-sm transition">
                Return to Profile
            </a>
        </div>

        <!-- Footer Note / Tip -->
        <p class="text-xs text-slate-400 dark:text-slate-600 pt-6">
            Tip: Profile avatars should be under 2MB in size (JPG, PNG, WEBP).
        </p>

    </div>

</body>

</html>

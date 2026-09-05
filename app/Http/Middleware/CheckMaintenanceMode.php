<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ডাটাবেজ থেকে maintenance_mode সেটিংস চেক করা
        $maintenanceMode = setting('maintenance_mode');

        if ($maintenanceMode == '1' || $maintenanceMode === 1) {
            // অ্যাডমিনরা বা নির্দিষ্ট রুটগুলো মেইনটেনেন্স মোডের বাইরে রাখতে চাইলে:
            // যেমন: অ্যাডমিন লগইন বা অ্যাডমিন প্যানেল যেন ব্লক না হয়
            if (auth()->check() && auth()->user()->role === 'admin') { // আপনার রোল কন্ডিশন অনুযায়ী পরিবর্তন করে নিতে পারেন
                return $next($request);
            }

            // যদি রুটটি অ্যাডমিন প্যানেলের হয় তবে বাইপাস করতে পারেন
            if ($request->is('admin*')) {
                return $next($request);
            }

            // মেইনটেনেন্স ভিউ রিটার্ন করবে
            return response()->view('errors.maintenance', [], 503);
        }

        return $next($request);
    }
}

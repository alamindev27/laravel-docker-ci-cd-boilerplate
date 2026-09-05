@extends('admin.layouts.admin')

@section('header')
    <title>Admin Dashboard</title>
@endsection

@section('content')
    <div class="space-y-6">

        <!-- Welcome Banner -->
        <div
            class="bg-gradient-to-r from-brand-600 to-purple-600 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-brand-500/10">
            <h1 class="text-2xl sm:text-3xl font-extrabold mb-2">Welcome Back, {{ auth()->user()->name ?? 'Admin' }}! 👋</h1>
            <p class="text-slate-100 text-sm max-w-xl">Here is what's happening with your application today. Everything is
                running smoothly and containers are active.</p>
        </div>

        <!-- Stats Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 rounded-2xl shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Users</span>
                    <span
                        class="p-2 bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 rounded-xl text-lg">👥</span>
                </div>
                <h3 class="text-2xl font-black text-slate-800 dark:text-slate-100">1,245</h3>
                <p class="text-xs text-emerald-500 font-semibold mt-1">+12% from last month</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 rounded-2xl shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Active Sessions</span>
                    <span
                        class="p-2 bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 rounded-xl text-lg">⚡</span>
                </div>
                <h3 class="text-2xl font-black text-slate-800 dark:text-slate-100">348</h3>
                <p class="text-xs text-emerald-500 font-semibold mt-1">+4% active now</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 rounded-2xl shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Server Load</span>
                    <span
                        class="p-2 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl text-lg">🐳</span>
                </div>
                <h3 class="text-2xl font-black text-slate-800 dark:text-slate-100">14.2%</h3>
                <p class="text-xs text-slate-400 mt-1">Docker container stable</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 rounded-2xl shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">System Status</span>
                    <span
                        class="p-2 bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 rounded-xl text-lg">🛡️</span>
                </div>
                <h3 class="text-2xl font-black text-emerald-500">Secure</h3>
                <p class="text-xs text-slate-400 mt-1">RBAC & Cache synced</p>
            </div>
        </div>

        <!-- Recent Activity Table Section -->
        <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 dark:text-slate-100 text-base">Recent Registrations</h3>
                <button class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">View All</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-400 text-xs uppercase tracking-wider">
                            <th class="px-6 py-3 font-semibold">Name</th>
                            <th class="px-6 py-3 font-semibold">Email</th>
                            <th class="px-6 py-3 font-semibold">Role</th>
                            <th class="px-6 py-3 font-semibold">Joined Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-700 dark:text-slate-200">MD Al-Amin</td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">alamindev27@gmail.com</td>
                            <td class="px-6 py-4"><span
                                    class="px-2.5 py-1 rounded-full text-xs font-semibold bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400">Admin</span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">Today, 02:31 AM</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-700 dark:text-slate-200">John Doe</td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">john@example.com</td>
                            <td class="px-6 py-4"><span
                                    class="px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">User</span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">Yesterday</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('footer')

@endsection

@extends('admin.layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-100">Backup Management</h1>
            <p class="text-sm text-slate-400">Manage and download your application and database backups securely.</p>
        </div>
        <a href="{{ route('admin.backups.create') }}"
           class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-xl transition shadow-lg shadow-indigo-600/30 text-sm font-medium">
            + Create New Backup
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500 text-emerald-400 p-4 rounded-xl mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-500/10 border border-rose-500 text-rose-400 p-4 rounded-xl mb-4 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-800 text-xs text-slate-400 uppercase bg-slate-950/50">
                    <th class="p-4">File Name</th>
                    <th class="p-4">Size</th>
                    <th class="p-4">Created At</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800 text-sm">
                @forelse($backups as $backup)
                    <tr class="hover:bg-slate-800/50 transition">
                        <td class="p-4 font-medium text-slate-200">{{ $backup['file_name'] }}</td>
                        <td class="p-4 text-slate-400">{{ number_format($backup['file_size'] / 1048576, 2) }} MB</td>
                        <td class="p-4 text-slate-400">{{ date('Y-m-d H:i:s', $backup['last_modified']) }}</td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.backups.download', $backup['file_name']) }}"
                               class="text-indigo-400 hover:text-indigo-300 font-semibold">Download</a>

                            <form action="{{ route('admin.backups.destroy', $backup['file_name']) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this backup?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-400 hover:text-rose-300 font-semibold ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-slate-500">No backups found yet. Click create new backup to start.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

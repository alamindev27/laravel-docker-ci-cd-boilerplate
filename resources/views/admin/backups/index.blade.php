@extends('admin.layouts.admin')

@section('content')
    <div class="py-2 max-w-5xl mx-auto sm:px-6 lg:px-8 px-4">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Backup Management</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Manage and download your application and database backups
                    securely.</p>
            </div>

            <!-- Create Backup Button -->
            <button onclick="return window.location.href='{{ route('admin.backups.create') }}'"
                class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow transition relative">

                <!-- Normal Text -->
                <span :class="{ 'opacity-0': loading }">+ Create New Backup</span>

                <!-- Loading Spinner Overlay inside button -->
                <div x-show="loading" style="display: none;"
                    class="absolute inset-0 flex items-center justify-center bg-indigo-600 rounded-lg">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span class="ml-2 text-xs">Processing...</span>
                </div>
            </button>
        </div>

        <!-- Full Screen Freeze & Loading Overlay -->
        <div x-show="loading" style="display: none;"
            class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm p-4">
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-2xl flex items-center space-x-4 border border-gray-200 dark:border-gray-700 max-w-sm w-full">
                <svg class="animate-spin h-8 w-8 text-indigo-600 dark:text-indigo-400 shrink-0"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Backup in Progress</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="message"></p>
                </div>
            </div>
        </div>

        <!-- Responsive Container (Desktop Table + Mobile Cards) -->
        <div
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm overflow-hidden">

            @php
                $hasBackups = count($backups ?? []) > 0;
            @endphp

            @if ($hasBackups)
                <!-- Desktop View (Table) -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                        <thead class="bg-gray-50 dark:bg-gray-800/50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    File Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Size</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-white dark:bg-gray-900">
                            @foreach ($backups as $backup)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                    <!-- File Name -->
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        {{ is_array($backup) ? $backup['file_name'] ?? ($backup['name'] ?? 'N/A') : $backup->getFilename() }}
                                    </td>

                                    <!-- File Size -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        @php
                                            $bytes = is_array($backup)
                                                ? $backup['file_size'] ?? ($backup['size'] ?? 0)
                                                : $backup->getSize();

                                            if ($bytes >= 1073741824) {
                                                $formattedSize = number_format($bytes / 1073741824, 2) . ' GB';
                                            } elseif ($bytes >= 1048576) {
                                                $formattedSize = number_format($bytes / 1048576, 2) . ' MB';
                                            } elseif ($bytes >= 1024) {
                                                $formattedSize = number_format($bytes / 1024, 2) . ' KB';
                                            } else {
                                                $bytes = $bytes ?: 0;
                                                $formattedSize = $bytes . ' Bytes';
                                            }
                                        @endphp
                                        {{ $formattedSize }}
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @php
                                            $fileName = is_array($backup)
                                                ? $backup['file_name'] ?? ($backup['name'] ?? '')
                                                : $backup->getFilename();
                                        @endphp
                                        <a href="{{ route('admin.backups.download', $fileName) }}"
                                            class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 mr-3">Download</a>
                                        <form action="{{ route('admin.backups.delete', $fileName) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this.form)"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile View (Card Layout - No Horizontal Scroll) -->
                <div class="block md:hidden divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach ($backups as $backup)
                        @php
                            $fileName = is_array($backup)
                                ? $backup['file_name'] ?? ($backup['name'] ?? '')
                                : $backup->getFilename();

                            $bytes = is_array($backup)
                                ? $backup['file_size'] ?? ($backup['size'] ?? 0)
                                : $backup->getSize();

                            if ($bytes >= 1073741824) {
                                $formattedSize = number_format($bytes / 1073741824, 2) . ' GB';
                            } elseif ($bytes >= 1048576) {
                                $formattedSize = number_format($bytes / 1048576, 2) . ' MB';
                            } elseif ($bytes >= 1024) {
                                $formattedSize = number_format($bytes / 1024, 2) . ' KB';
                            } else {
                                $bytes = $bytes ?: 0;
                                $formattedSize = $bytes . ' Bytes';
                            }
                        @endphp
                        <div class="p-4 space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">File Name</span>
                                <span
                                    class="text-sm font-medium text-gray-900 dark:text-gray-200 text-right break-all">{{ $fileName }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Size</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $formattedSize }}</span>
                            </div>
                            <div
                                class="flex items-center justify-between pt-2 border-t border-gray-100 dark:border-gray-800">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</span>
                                <div class="flex items-center space-x-3 text-sm font-medium">
                                    <a href="{{ route('admin.backups.download', $fileName) }}"
                                        class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Download</a>
                                    <form action="{{ route('admin.backups.delete', $fileName) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this.form)"
                                            class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">
                    No backups found.
                </div>
            @endif

        </div>

    </div>
@endsection

@section('footer')
@endsection

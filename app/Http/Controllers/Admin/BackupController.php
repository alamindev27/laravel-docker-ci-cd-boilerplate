<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk('backups');

        // সব ফাইল এবং সাবফোল্ডারের ফাইলগুলো রিকার্সিভভাবে রিড করা
        $files = $disk->allFiles();

        $backups = [];
        foreach ($files as $file) {
            // শুধু .zip ফাইলগুলো ফিল্টার করা
            if (substr($file, -4) == '.zip' && $disk->exists($file)) {
                $backups[] = [
                    'path' => $file,
                    'file_name' => basename($file),
                    'file_size' => $disk->size($file),
                    'last_modified' => $disk->lastModified($file),
                ];
            }
        }

        rsort($backups);

        return view('admin.backups.index', compact('backups'));
    }

    public function create()
    {
        try {
            Artisan::call('backup:run');

            return redirect()->back()->with('success', 'Backup created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Backup failed: '.$e->getMessage());
        }
    }

    public function download($file_name)
    {
        $appName = config('backup.backup.name', 'laravel-backup');

        $disk = Storage::disk('backups');

        $filePath = $disk->exists($file_name) ? $file_name : $appName.'/'.$file_name;

        if ($disk->exists($filePath)) {
            return $disk->download($filePath);
        }

        return redirect()->back()->with('error', 'Backup file not found at path: '.$filePath);
    }

    public function destroy($file_name)
    {
        $appName = config('backup.backup.name', 'laravel-backup');
        $disk = Storage::disk('backups');

        $filePath = $disk->exists($file_name) ? $file_name : $appName.'/'.$file_name;

        if ($disk->exists($filePath)) {
            $disk->delete($filePath);

            return redirect()->back()->with('success', 'Backup deleted successfully!');
        }

        return redirect()->back()->with('error', 'Backup file not found!');
    }
}

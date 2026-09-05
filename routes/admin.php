<?php

use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    // for app back file
    Route::controller(BackupController::class)->group(function () {
        Route::get('/backups', 'index')->name('backups.index');
        Route::get('/backups/create', 'create')->name('backups.create');
        Route::get('/backups/download/{file_name}', 'download')->name('backups.download');
        Route::delete('/backups/delete/{file_name}', 'destroy')->name('backups.delete');
    });

    // for profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::put('/profile/update', 'update')->name('profile.update');
        Route::get('/change-password', 'changePassowrd')->name('change-password');
        Route::put('/password-update', 'updatePassword')->name('password.update');
    });

    // for settings
    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings.index');
        Route::put('/settings', 'update')->name('settings.update');
    });
});

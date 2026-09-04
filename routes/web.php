<?php

use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/unauthorized-action', [HomeController::class, 'index'])->name('home');

Route::name('frontend.')->group(function () {
    Route::controller(FrontendHomeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
});

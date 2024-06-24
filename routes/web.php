<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::middleware(['guest'])->group(function() {
        Route::match(['get','post'], '/login', [LoginController::class, 'index'])->name('login');
    });

    Route::middleware(['auth','admin'])->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    });
});

Auth::routes();
Route::middleware(['user','auth'])->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
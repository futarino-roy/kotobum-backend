<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        // Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // Route::resource('/users', UserController::class);
    });
    Route::get('/login', [LoginController::class, 'login_form'])->name('admin.login_form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
});

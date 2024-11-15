<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PDFController;



Route::prefix('admin')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout'); // ログアウト / Logout
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/coverHTML/{userid}', [PDFController::class, 'coverHTML'])->name('admin.coverHTML'); 
        Route::get('/bodyHTML/{userid}', [PDFController::class, 'bodyHTML'])->name('admin.bodyHTML'); 
       /*  Route::post('/PDF', [PDFController::class, 'PDF'])->name('admin.PDF'); 
        Route::get('ユーザー情報（所属・ステ・関連アルバムID）取得', [::class, ''])->name('');
        Route::get('ユーザー情報（所属個別テーブル？）取得', [::class, ''])->name('');
        Route::get('コトバム編集状況取得', [::class, ''])->name(''); */


    });
    Route::get('/login', [LoginController::class, 'login_form'])->name('admin.login_form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');  // ログイン / Login
});
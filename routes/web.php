<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\PDFController;

Route::prefix('admin')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout'); // ログアウト / Logout
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


        Route::get('/group/dashbord', [GroupController::class, 'indexGroup'])->name('admin.group_dashbord'); 
        Route::get('/group/infomation/{groupid}', [GroupController::class, 'showGroup'])->name('admin.group_infomation'); 
        Route::get('/user/infomation{userid}', [GroupController::class, 'showUser'])->name('admin.user_infomation'); 

        Route::post('/create_group', [GroupController::class, 'createGroup'])->name('admin.create_group'); 
        Route::get('/delete_group/{groupid}', [GroupController::class, 'deleteGroup'])->name('admin.delete_group'); 
        Route::post('/create_User/{groupid}', [GroupController::class, 'createUser'])->name('admin.create_user'); 
        Route::get('/delete_User/{userid}', [GroupController::class, 'deleteUser'])->name('admin.delete_user'); 

        Route::post('/user/{id}/reset-password', [GroupController::class, 'resetPassword'])->name('admin.reset-password');
        Route::get('/admin_user_redirect/{userid}/{parts}', [LoginController::class, 'admin_user_redirect'])->name('admin_user_redirect');
        Route::post('/albums/{id}/reset-status/{type}', [GroupController::class, 'resetStatus'])->name('admin.reset-status');

    });
    Route::get('/login', [LoginController::class, 'login_form'])->name('admin.login_form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');  // ログイン / Login
});
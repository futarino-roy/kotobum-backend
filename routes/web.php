<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\PartnerController;



Route::prefix('admin')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout'); // ログアウト / Logout
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/coverHTML/{userid}', [PDFController::class, 'coverHTML'])->name('admin.coverHTML'); 
        Route::get('/bodyHTML/{userid}', [PDFController::class, 'bodyHTML'])->name('admin.bodyHTML'); 
        Route::post('/PDF', [PDFController::class, 'PDF'])->name('admin.PDF'); 

        Route::get('/group/dashbord', [GroupController::class, 'indexGroup'])->name('admin.group_dashbord'); 
        Route::get('/group/infomation/{groupid}', [GroupController::class, 'showGroup'])->name('admin.group_infomation'); 
        Route::get('/user/infomation{userid}', [GroupController::class, 'showUser'])->name('admin.user_infomation'); 

        Route::post('/create_group', [GroupController::class, 'createGroup'])->name('admin.create_group'); 
        Route::post('/delete_group/{groupid}', [GroupController::class, 'deleteGroup'])->name('admin.delete_group'); 
        Route::post('/create_User/{groupid}', [GroupController::class, 'createUser'])->name('admin.create_user'); 
        Route::post('/delete_User/{groupid}', [GroupController::class, 'deleteUser'])->name('admin.delete_user'); 

        Route::get('/admin_user_redirect/{userid}/{parts}', [LoginController::class, 'admin_user_redirect'])->name('admin_user_redirect');

    });
    Route::get('/login', [LoginController::class, 'login_form'])->name('admin.login_form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');  // ログイン / Login
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OriginalAdmin\LoginController;
use App\Http\Controllers\OriginalAdmin\KotobamuController;
use App\Http\Controllers\OriginalAdmin\ApplicationController;
use App\Http\Controllers\OriginalAdmin\MessageController;
use App\Http\Controllers\OriginalAdmin\AdminTorisetsuController;
use App\Http\Controllers\OriginalAdmin\UserAdminController;
use App\Models\Application;

Route::prefix('original_admin')->group(function () {
    Route::middleware('auth.original_admins:original_admins')->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('original_admin.logout');
        Route::resource('/kotobamu', KotobamuController::class)->only(['index', 'store', 'destroy', 'update']);
        Route::get('/kotobamu/{kotobamu}/link_from_followers', [KotobamuController::class, 'link_from_followers'])->name('kotobamu.link_from_followers');
        Route::get('/application/denials', [ApplicationController::class, 'denials'])->name('application.denials');
        Route::resource('/application', ApplicationController::class)->only(['update', 'destroy', 'store']);
        Route::resource('/{application}/message', MessageController::class)->only('create', 'store', 'update', 'edit', 'destroy');
        Route::get('/torisetsu_users', [AdminTorisetsuController::class, 'torisetsu_users'])->name('torisetsu_users');
        Route::get('/torisetsu_users/opt', [AdminTorisetsuController::class, 'torisetsu_opt'])->name('torisetsu_opt');
        Route::get('/user_admin/user_admin', [UserAdminController::class, 'index'])->name('user_admin');
        Route::post('/user_admin/user_admin', [UserAdminController::class, 'admin_store'])->name('admin_store');
        Route::patch('/user_admin/user_admin/{user}', [UserAdminController::class, 'remove_admin'])->name('remove_admin');
    });
    Route::get('/login', [LoginController::class, 'login_form'])->name('original_admin.login_form');
    Route::post('/login', [LoginController::class, 'login'])->name('original_admin.login');
});

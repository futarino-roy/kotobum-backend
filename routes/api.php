<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TemplateController;
use App\Http\Controllers\Api\AlbumController;



Route::post('/register', [RegisterController::class, 'register']); // ユーザー登録 / User registration
Route::post('/login', [LoginController::class, 'login']); // ログイン / Login

Route::middleware('auth:sanctum')->group(function () {
    // ユーザー情報の取得 / Obtaining user information
    Route::get('/user', [UserController::class, 'show'])->name('user.show');

     // テンプレート選択 / Template selection
    Route::post('/select-template', [TemplateController::class, 'selectTemplate']);
    
    // アルバム操作 / Album operation
    Route::post('/albums', [AlbumController::class, 'create']);
    Route::put('/albums/{album}', [AlbumController::class, 'update']);
    Route::post('/albums/{album}/send', [AlbumController::class, 'send']);
    Route::get('/albums/{album}', [AlbumController::class, 'show']);
    
    // 簡易ユーザー情報取得 / Simple user information acquisition
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
});


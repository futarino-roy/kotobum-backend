<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AlbumController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [RegisterController::class, 'register']); // ユーザー登録
Route::post('/login', [LoginController::class, 'login']); // ログイン

Route::middleware('auth:sanctum')->group(function () {
    // ユーザー情報の取得
    Route::get('/user', [UserController::class, 'show'])->name('user.show');
    
    // アルバム作成・編集・送信
    Route::post('/albums', [AlbumController::class, 'create'])->name('albums.create');
    Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
    Route::post('/albums/{album}/send', [AlbumController::class, 'send'])->name('albums.send');
    
    // 簡易ユーザー情報取得
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
});


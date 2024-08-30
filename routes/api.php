<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TemplateController;
use App\Http\Controllers\Api\CoverController;
use App\Http\Controllers\Api\BodyController;

Route::post('/register', [RegisterController::class, 'register']); // ユーザー登録
Route::post('/login', [LoginController::class, 'login']); // ログイン

Route::middleware('auth:sanctum')->group(function () {
    // ユーザー情報の取得
    Route::get('/user', [UserController::class, 'show'])->name('user.show');

    // テンプレート選択
    Route::post('/select-template', [TemplateController::class, 'selectTemplate']);
    
    // カバー操作
    Route::post('/albums/{album}/cover', [CoverController::class, 'createOrUpdateCover']); // カバーの追加または更新
    Route::put('/albums/{album}/cover', [CoverController::class, 'updateCover']); // カバーの更新
    Route::post('/albums/{album}/cover/send', [CoverController::class, 'sendCover']); // カバーの送信

    // ボディ操作
    Route::post('/albums/{album}/body', [BodyController::class, 'createOrUpdateBody']); // ボディの追加または更新
    Route::put('/albums/{album}/body', [BodyController::class, 'updateBody']); // ボディの更新
    Route::post('/albums/{album}/body/send', [BodyController::class, 'sendBody']); // ボディの送信
    
    // 簡易ユーザー情報取得
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
});

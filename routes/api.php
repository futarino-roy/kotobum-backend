<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TemplateController;
use App\Http\Controllers\Api\CoverController;
use App\Http\Controllers\Api\BodyController;
use App\Http\Controllers\Api\UserAlbumController;

Route::post('/register', [RegisterController::class, 'register']); // ユーザー登録
Route::post('/login', [LoginController::class, 'login']); // ログイン

Route::middleware('auth:sanctum')->group(function () {
    // ユーザー情報の取得
    Route::get('/user', [UserController::class, 'show'])->name('user.show');
    Route::post('/select-template', [TemplateController::class, 'selectTemplate']);
    Route::get('/user/album', [UserAlbumController::class, 'getOrCreateAlbum']);
    
    // カバー操作
    Route::get('/albums/{albumid}/cover', [CoverController::class, 'showCover']);
    Route::post('/albums/{albumid}/cover', [CoverController::class, 'createOrUpdateCover']);
    Route::put('/albums/{albumid}/cover', [CoverController::class, 'updateCover']);
    Route::post('/albums/{albumid}/cover/send', [CoverController::class, 'sendCover']);

    // ボディ操作
    Route::get('/albums/{albumid}/body/show', [BodyController::class, 'showBody']);
    Route::post('/albums/{albumid}/body', [BodyController::class, 'createOrUpdateBody']);
    Route::put('/albums/{albumid}/body', [BodyController::class, 'updateBody']);
    Route::post('/albums/{albumid}/body/send', [BodyController::class, 'sendBody']);
    
    // 簡易ユーザー情報取得
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
});
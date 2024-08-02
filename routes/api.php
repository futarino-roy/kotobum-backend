<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostSanctumTokenController;
use App\Http\Controllers\TorisetsuController;
use App\Http\Controllers\UserController;

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

Route::prefix('v1')->group(function () {

    // LINE messaging APIのwebhookでpostを受け取るエンドポイント
    Route::post('/webhook', [PostSanctumTokenController::class, 'webhook']);
    // user agentにLine, LIFFが含まれることを判定

    
    Route::middleware('line-browser')->group(function () {
        Route::get('/is_registed', [PostSanctumTokenController::class, 'is_registed']); //フタリノユーザ登録の判定（line_access_tokenの更新も）
        Route::get('/regist', [PostSanctumTokenController::class, 'regist']); //フタリノのユーザ登録

        /**
         * Bearer tokenでline_access_tokenが必要
         */
        Route::middleware('auth:api')->group(function () {
            Route::get('/user', [UserController::class, 'show'])->name('user.show');
            Route::post('/user', [UserController::class, 'update'])->name('user.update');
            Route::post('/torisetsu', [TorisetsuController::class, 'create'])->name('torisetsu.create');
            Route::get('/torisetsu/latest_url', [TorisetsuController::class, 'latest_url'])->name('torisetsu.latest_url');
        });
    });
});

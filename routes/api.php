<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TokenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\MaterialController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 認証ユーザーのみ
Route::middleware(['auth:sanctum'])->group(
    function () {
        // 管理者アカウントのみ
        Route::middleware([AdminAuth::class])->group(
            function () {
                // カテゴリー
                Route::post('category', [CategoryController::class, 'store']);
                Route::post('category/{id}', [CategoryController::class, 'update']);
                Route::delete('category/{id}', [CategoryController::class, 'destroy']);

                // 教材
                Route::post('material', [MaterialController::class, 'store']);
                Route::post('material/{id}', [MaterialController::class, 'update']);
                Route::delete('material/{id}', [MaterialController::class, 'destroy']);
            }
        );
        // ユーザー情報
        Route::get('/users/auth', AuthController::class);

        // カテゴリー
        Route::get('category', [CategoryController::class, 'index']);
        Route::get('category/{id}', [CategoryController::class, 'show']);

        // 教材
        Route::get('material/{category_id}', [MaterialController::class, 'index']);
    }
);

// Bearer Token 取得
Route::post('/sanctum/token', TokenController::class);

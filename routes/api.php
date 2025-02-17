<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\JWTMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::post('register', [JWTAuthController::class, 'register']);
    Route::post('login', [JWTAuthController::class, 'login']);
//    Route::post('refresh', [JWTAuthController::class, 'refresh']);
//    Route::post('me', [JWTAuthController::class, 'me']);
//    Route::post('logout', [JWTAuthController::class, 'logout']);

    Route::middleware(JWTMiddleware::class)->prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
        Route::get('/{id}', [PostController::class, 'show']);
        Route::put('/{id}', [PostController::class, 'update']);
        Route::delete('/{id}', [PostController::class, 'destroy']);
    });

    Route::middleware(JWTMiddleware::class)->prefix('comments')->group(function () {
        Route::post('/', [CommentController::class, 'store']);
        Route::delete('/{id}', [CommentController::class, 'destroy']);
    });

    Route::middleware(JWTMiddleware::class)->prefix('likes')->group(function () {
        Route::post('/', [LikeController::class, 'store']);
        Route::delete('/{id}', [LikeController::class, 'destroy']);
    });

    Route::middleware(JWTMiddleware::class)->prefix('messages')->group(function () {
        Route::post('/', [MessageController::class, 'store']);
        Route::get('/{id}', [MessageController::class, 'show']);
        Route::get('/get-messages/{receiver_id}', [MessageController::class, 'getMessages']);
        Route::delete('/{id}', [MessageController::class, 'destroy']);
    });
});



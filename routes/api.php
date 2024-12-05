<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostInteractionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

# Rutas públicas
Route::prefix('/external')->group(function () {
    # Auth
    Route::prefix('/auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/reset-password', [AuthController::class, 'reset']);
    });
});

# Rutas protegidas
Route::prefix('/internal')->middleware('auth:api')->group(function () {
    # Auths
    Route::prefix('/auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::put('/modify-password', [AuthController::class, 'modify']);
    });

    # Posts
    Route::prefix('/post')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
        Route::delete('/{id}', [PostController::class, 'delete']);
        Route::prefix('/{id}/interactions')->group(function () {
            Route::post('/', [PostInteractionController::class, 'storeInteract']);
        });
    });

    # Users
    Route::prefix('/user')->group(function () {
        Route::get('/profile/{id}', [UserController::class, 'getUserWithPosts']);
        Route::prefix('/role')->group(function () {
            Route::post('/', [RoleController::class, 'toggleRole']);
        });
    });
});

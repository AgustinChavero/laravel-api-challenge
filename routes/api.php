<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostInteractionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

# Rutas públicas
Route::prefix('/external')->group(function () {
    # Auth
    Route::prefix('/auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']); # Tested
        Route::post('/reset-password', [AuthController::class, 'reset']); # Tested
    });
});

# Rutas protegidas
Route::prefix('/internal')->middleware('auth:api')->group(function () {
    # Auths
    Route::prefix('/auth')->group(function () { ### All tested
        Route::post('/logout', [AuthController::class, 'logout']); # Tested
        Route::put('/modify-password', [AuthController::class, 'modify']); # Tested
    });

    # Posts
    Route::prefix('/post')->group(function () { ### All tested
        Route::get('/', [PostController::class, 'index']); # Tested
        Route::post('/', [PostController::class, 'store']); # Tested
        Route::delete('/{id}', [PostController::class, 'delete']); # Tested
        Route::prefix('/{id}/interactions')->group(function () {
            Route::post('/', [PostInteractionController::class, 'storeInteract']); # Tested
        });
    });

    # Users
    Route::prefix('/user')->group(function () {
        Route::get('/profile/{id}', [UserController::class, 'getUserWithPosts']); # Tested
        Route::prefix('/role')->group(function () {
            Route::post('/', [RoleController::class, 'toggleRole']); # Tested
        });
        Route::prefix('/payment')->group(function () {
            Route::post('/premium', [PaymentController::class, 'processPayment']);
            Route::post('/sucess', [PaymentController::class, 'completePayment']);
        });
    });
});

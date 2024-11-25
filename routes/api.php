<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

# Rutas públicas
Route::prefix('/external')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/reset-password', [AuthController::class, 'reset']);
        Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
    });
});

# Rutas protegidas
Route::prefix('/internal')->middleware('auth:api')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/modify-password', [AuthController::class, 'modifyPassword']);
    });
});

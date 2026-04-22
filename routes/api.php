<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ValidationController;
use App\Http\Controllers\Api\V1\InstalmentController;
use App\Http\Controllers\Api\V1\ApplicationController;

Route::prefix('v1/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::post('/validation', [ValidationController::class, 'store']);
    Route::get('/validations', [ValidationController::class, 'index']);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/instalment_cars', [InstalmentController::class, 'index']);
    Route::get('/instalment_cars/{id}', [InstalmentController::class, 'show']);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::post('/applications', [ApplicationController::class, 'store']);
    Route::get('/applications', [ApplicationController::class, 'index']);
});
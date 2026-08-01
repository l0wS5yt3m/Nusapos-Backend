<?php

use App\Http\Controllers\Product\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\MeController;


Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class);

});

Route::prefix('v1')->group(function () {

     Route::post('/login', LoginController::class);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', LogoutController::class);

        Route::get('/me', MeController::class);

    });

});
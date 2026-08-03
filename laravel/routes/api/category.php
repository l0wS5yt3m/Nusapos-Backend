<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Product\Controllers\CategoryController;

Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Category Permission
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/categories',
        [CategoryController::class, 'index']
    )->middleware('permission:category.view');

    Route::get(
        '/categories/{id}',
        [CategoryController::class, 'show']
    )->middleware('permission:category.view');

    Route::post(
        '/categories',
        [CategoryController::class, 'store']
    )->middleware('permission:category.create');

    Route::put(
        '/categories/{id}',
        [CategoryController::class, 'update']
    )->middleware('permission:category.update');

    Route::delete(
        '/categories/{id}',
        [CategoryController::class, 'destroy']
    )->middleware('permission:category.delete');

});
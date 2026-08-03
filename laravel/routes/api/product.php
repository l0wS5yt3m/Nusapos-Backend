<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Product\Controllers\ProductController;

Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Product Permission
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/products',
        [ProductController::class, 'index']
    )->middleware('permission:product.view');

    Route::get(
        '/products/{id}',
        [ProductController::class, 'show']
    )->middleware('permission:product.view');

    Route::post(
        '/products',
        [ProductController::class, 'store']
    )->middleware('permission:product.create');

    Route::put(
        '/products/{id}',
        [ProductController::class, 'update']
    )->middleware('permission:product.update');

    Route::delete(
        '/products/{id}',
        [ProductController::class, 'destroy']
    )->middleware('permission:product.delete');

});
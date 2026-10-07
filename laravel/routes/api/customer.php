<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Customer\Controllers\CustomerController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get(
        '/customers',
        [CustomerController::class, 'index']
    )->middleware('permission:customer.view');

    Route::get(
        '/customers/{id}',
        [CustomerController::class, 'show']
    )->middleware('permission:customer.view');

    Route::post(
        '/customers',
        [CustomerController::class, 'store']
    )->middleware('permission:customer.create');

    Route::put(
        '/customers/{id}',
        [CustomerController::class, 'update']
    )->middleware('permission:customer.update');

    Route::delete(
        '/customers/{id}',
        [CustomerController::class, 'destroy']
    )->middleware('permission:customer.delete');
});
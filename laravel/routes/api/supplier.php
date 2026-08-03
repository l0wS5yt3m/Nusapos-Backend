<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Supplier\Controllers\SupplierController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get(
        '/suppliers',
        [SupplierController::class, 'index']
    )->middleware('permission:supplier.view');

    Route::get(
        '/suppliers/{id}',
        [SupplierController::class, 'show']
    )->middleware('permission:supplier.view');

    Route::post(
        '/suppliers',
        [SupplierController::class, 'store']
    )->middleware('permission:supplier.create');

    Route::put(
        '/suppliers/{id}',
        [SupplierController::class, 'update']
    )->middleware('permission:supplier.update');

    Route::delete(
        '/suppliers/{id}',
        [SupplierController::class, 'destroy']
    )->middleware('permission:supplier.delete');

});
<?php

use App\Modules\Purchase\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get(
        'purchases',
        [PurchaseController::class, 'index']
    )->middleware('permission:purchase.view');

    Route::post(
        'purchases',
        [PurchaseController::class, 'store']
    )->middleware('permission:purchase.create');

    Route::get(
        'purchases/{id}',
        [PurchaseController::class, 'show']
    )->middleware('permission:purchase.view');
});

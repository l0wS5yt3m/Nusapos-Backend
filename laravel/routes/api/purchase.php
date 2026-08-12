<?php

use App\Modules\Purchase\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get(
        'purchases',
        [PurchaseController::class, 'index']
    );

    Route::post(
        'purchases',
        [PurchaseController::class, 'store']
    );

    Route::get(
        'purchases/{id}',
        [PurchaseController::class, 'show']
    );
});
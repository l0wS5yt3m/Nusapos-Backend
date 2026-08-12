<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Transaction\Controllers\TransactionController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get(
        '/transactions',
        [TransactionController::class, 'index']
    )->middleware('permission:transaction.view');

    Route::get(
        '/transactions/{id}',
        [TransactionController::class, 'show']
    )->middleware('permission:transaction.view');

    Route::post(
        '/transactions',
        [TransactionController::class, 'store']
    )->middleware('permission:transaction.create');

});
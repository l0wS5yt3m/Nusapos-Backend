<?php

namespace App\Services;

use App\Exceptions\InsufficientStockException;
use App\Models\Product;
use App\Models\StockMovement;

class StockService
{
    public function decrease(
        Product $product,
        int $qty,
        string $referenceType,
        int $referenceId,
        ?int $userId = null,
        ?string $notes = null,
    ): void {
        if ($product->stock < $qty) {
            throw new InsufficientStockException(
                $product->name
            );
        }

        $before = $product->stock;

        $product->stock -= $qty;
        $product->save();

        StockMovement::create([
            'product_id' => $product->id,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'type' => 'OUT',
            'qty' => $qty,
            'stock_before' => $before,
            'stock_after' => $product->stock,
            'notes' => $notes,
        ]);
    }

    public function increase(
        Product $product,
        int $qty,
        string $referenceType,
        int $referenceId,
        ?int $userId = null,
        ?string $notes = null,
    ): void {
        $before = $product->stock;

        $product->stock += $qty;
        $product->save();

        StockMovement::create([
            'product_id' => $product->id,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'type' => 'IN',
            'qty' => $qty,
            'stock_before' => $before,
            'stock_after' => $product->stock,
            'notes' => $notes,
        ]);
    }
}

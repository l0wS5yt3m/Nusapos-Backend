<?php

namespace App\Services;

use Illuminate\Support\Collection;

class TransactionCalculator
{
    public function calculate(
        array $items,
        Collection $products,
        float $discount,
        float $tax
    ): array {

        $subtotal = 0;

        foreach ($items as $item) {

            $product = $products->get(
                $item->product_id
            );

            $subtotal +=
                $product->selling_price
                * $item->qty;

        }

        $grandTotal =
            $subtotal
            - $discount
            + $tax;

        return [

            'subtotal' => $subtotal,

            'discount' => $discount,

            'tax' => $tax,

            'grand_total' => $grandTotal,

        ];
    }
}
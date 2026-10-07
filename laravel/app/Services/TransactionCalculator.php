<?php

namespace App\Services;

use App\Exceptions\TransactionException;
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

        if ($discount > $subtotal) {
            throw new TransactionException(
                'Discount tidak boleh lebih besar dari subtotal.'
            );
        }

        $grandTotal =
            $subtotal
            - $discount
            + $tax;

        if ($grandTotal < 0) {
            throw new TransactionException(
                'Grand total transaksi tidak boleh negatif.'
            );
        }

        return [

            'subtotal' => $subtotal,

            'discount' => $discount,

            'tax' => $tax,

            'grand_total' => $grandTotal,

        ];
    }
}

<?php

namespace App\Modules\Purchase\DTO;

class PurchaseItemDTO
{
    public function __construct(
        public readonly int $product_id,
        public readonly int $qty,
        public readonly float $price,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            product_id: (int) $data['product_id'],
            qty: (int) $data['qty'],
            price: (float) $data['price'],
        );
    }
}
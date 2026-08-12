<?php

namespace App\Modules\Transaction\DTO;

class TransactionItemDTO
{
    public function __construct(
        public readonly int $product_id,
        public readonly int $qty,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            product_id: (int) $data['product_id'],
            qty: (int) $data['qty'],
        );
    }
}
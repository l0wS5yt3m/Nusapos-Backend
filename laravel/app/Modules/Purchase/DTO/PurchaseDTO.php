<?php

namespace App\Modules\Purchase\DTO;

class PurchaseDTO
{
    /**
     * @param PurchaseItemDTO[] $items
     */
    public function __construct(
        public readonly int $supplier_id,
        public readonly string $payment_method,
        public readonly float $discount,
        public readonly float $tax,
        public readonly ?string $notes,
        public readonly array $items,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            supplier_id: (int) $data['supplier_id'],
            payment_method: $data['payment_method'],
            discount: (float) ($data['discount'] ?? 0),
            tax: (float) ($data['tax'] ?? 0),
            notes: $data['notes'] ?? null,
            items: array_map(
                fn ($item) => PurchaseItemDTO::fromArray($item),
                $data['items']
            ),
        );
    }
}
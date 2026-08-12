<?php

namespace App\Modules\Transaction\DTO;

class TransactionDTO
{
    /**
     * @param TransactionItemDTO[] $items
     */
    public function __construct(
        public readonly ?int $customer_id,
        public readonly int $user_id,
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
            customer_id: $data['customer_id'] ?? null,
            user_id: (int) $data['user_id'],
            payment_method: $data['payment_method'],
            discount: (float) ($data['discount'] ?? 0),
            tax: (float) ($data['tax'] ?? 0),
            notes: $data['notes'] ?? null,
            items: array_map(
                fn ($item) => TransactionItemDTO::fromArray($item),
                $data['items']
            ),
        );
    }
}
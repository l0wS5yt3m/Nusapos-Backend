<?php

namespace App\Modules\Purchase\Repositories;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Support\Collection;

class PurchaseRepository implements PurchaseRepositoryInterface
{
    public function all(): Collection
    {
        return Purchase::with([
            'supplier',
            'user',
            'items.product',
        ])
            ->latest()
            ->get();
    }

    public function find(int $id): Purchase
    {
        return Purchase::with([
            'supplier',
            'user',
            'items.product',
        ])->findOrFail($id);
    }

    public function create(array $data): Purchase
    {
        return Purchase::create($data);
    }

    public function createItem(array $data): void
    {
        PurchaseItem::create($data);
    }
}
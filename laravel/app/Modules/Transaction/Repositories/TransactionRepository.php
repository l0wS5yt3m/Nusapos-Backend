<?php

namespace App\Modules\Transaction\Repositories;

use App\Models\Transaction;
use App\Models\TransactionItem;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function all()
    {
        return Transaction::with([
            'customer',
            'user',
            'items.product',
        ])->latest()->get();
    }

    public function find(int $id): Transaction
    {
        return Transaction::with([
            'customer',
            'user',
            'items.product',
        ])->findOrFail($id);
    }

    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }

    public function createItem(array $data): TransactionItem
    {
        return TransactionItem::create($data);
    }
}
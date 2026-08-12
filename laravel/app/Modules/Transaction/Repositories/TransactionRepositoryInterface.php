<?php

namespace App\Modules\Transaction\Repositories;

use App\Models\Transaction;
use App\Models\TransactionItem;

interface TransactionRepositoryInterface
{
    public function all();

    public function find(int $id): Transaction;

    public function create(array $data): Transaction;

    public function createItem(array $data): TransactionItem;
}
<?php

namespace App\Modules\Purchase\Repositories;

use App\Models\Purchase;
use Illuminate\Support\Collection;

interface PurchaseRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): Purchase;

    public function create(array $data): Purchase;

    public function createItem(array $data): void;
}
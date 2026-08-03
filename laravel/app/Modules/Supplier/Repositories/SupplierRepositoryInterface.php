<?php

namespace App\Modules\Supplier\Repositories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

interface SupplierRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): Supplier;

    public function create(array $data): Supplier;

    public function update(int $id, array $data): Supplier;

    public function delete(int $id): bool;
}
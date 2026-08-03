<?php

namespace App\Modules\Supplier\Repositories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function all(): Collection
    {
        return Supplier::latest()->get();
    }

    public function find(int $id): Supplier
    {
        return Supplier::findOrFail($id);
    }

    public function create(array $data): Supplier
    {
        return Supplier::create($data);
    }

    public function update(int $id, array $data): Supplier
    {
        $supplier = $this->find($id);

        $supplier->update($data);

        return $supplier;
    }

    public function delete(int $id): bool
    {
        return $this->find($id)->delete();
    }
}
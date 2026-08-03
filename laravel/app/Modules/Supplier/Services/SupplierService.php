<?php

namespace App\Modules\Supplier\Services;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;
use App\Modules\Supplier\DTO\SupplierDTO;
use App\Modules\Supplier\Repositories\SupplierRepositoryInterface;

class SupplierService
{
    public function __construct(
        protected SupplierRepositoryInterface $repository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function find(int $id): Supplier
    {
        return $this->repository->find($id);
    }

    public function create(SupplierDTO $dto): Supplier
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, SupplierDTO $dto): Supplier
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
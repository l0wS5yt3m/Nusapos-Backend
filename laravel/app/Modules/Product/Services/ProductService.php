<?php

namespace App\Modules\Product\Services;

use App\Modules\Product\Repositories\ProductRepositoryInterface;
use App\Modules\Product\DTO\ProductDTO;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $repository
    ) {
    }
 
    public function getAll() : Collection
    {
        return $this->repository->all();
    }

    public function create(ProductDTO $dto)
    {
        return $this->repository
            ->create(
                $dto->toArray()
            );
    }

    public function update(
        int $id,
        ProductDTO $dto
    ) {
        return $this->repository
            ->update(
                $id,
                $dto->toArray()
            );
    }

    public function delete(int $id)
    {
        return $this->repository
            ->delete($id);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }
}
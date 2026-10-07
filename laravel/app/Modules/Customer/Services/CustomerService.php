<?php

namespace App\Modules\Customer\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use App\Modules\Customer\DTO\CustomerDTO;
use App\Modules\Customer\Repositories\CustomerRepositoryInterface;

class CustomerService
{
    public function __construct(
        protected CustomerRepositoryInterface $repository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function find(int $id): Customer
    {
        return $this->repository->find($id);
    }

    public function create(CustomerDTO $dto): Customer
    {
        return $this->repository->create(
            $dto->toArray()
        );
    }

    public function update(int $id, CustomerDTO $dto): Customer
    {
        return $this->repository->update(
            $id,
            $dto->toArray()
        );
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
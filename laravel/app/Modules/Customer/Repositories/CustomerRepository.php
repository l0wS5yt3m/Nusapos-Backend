<?php

namespace App\Modules\Customer\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all(): Collection
    {
        return Customer::latest()->get();
    }

    public function find(int $id): Customer
    {
        return Customer::findOrFail($id);
    }

    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function update(int $id, array $data): Customer
    {
        $customer = $this->find($id);

        $customer->update($data);

        return $customer;
    }

    public function delete(int $id): bool
    {
        return $this->find($id)->delete();
    }
}
<?php

namespace App\Modules\Customer\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): Customer;

    public function create(array $data): Customer;

    public function update(int $id, array $data): Customer;

    public function delete(int $id): bool;
}
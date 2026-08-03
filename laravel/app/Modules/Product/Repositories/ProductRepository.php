<?php

namespace App\Modules\Product\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
class ProductRepository implements ProductRepositoryInterface
{
    public function all() : Collection
    {
        return Product::with('category')
        -> latest()
        -> get();
    }

    public function find(int $id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(
        int $id,
        array $data
    ): Product {

        $product = $this->find($id);

        $product->update($data);

        return $product;
    }

    public function delete(int $id): bool
    {
        return $this
            ->find($id)
            ->delete();
    }
}
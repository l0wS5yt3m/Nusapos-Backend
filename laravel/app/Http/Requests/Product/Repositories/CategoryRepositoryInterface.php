<?php

namespace App\Modules\Product\Repositories;


use App\Models\Category;


interface CategoryRepositoryInterface
{


    public function all();


    public function find(int $id);


    public function create(array $data): Category;


    public function update(int $id,array $data): Category;


    public function delete(int $id): bool;


}
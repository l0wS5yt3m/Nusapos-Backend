<?php

namespace App\Modules\Product\Repositories;


use App\Models\Category;


class CategoryRepository implements CategoryRepositoryInterface
{


    public function all()
    {
        return Category::latest()->get();
    }



    public function find(int $id)
    {
        return Category::findOrFail($id);
    }



    public function create(array $data): Category
    {

        return Category::create($data);

    }



    public function update(
        int $id,
        array $data
    ): Category
    {

        $category=$this->find($id);


        $category->update($data);


        return $category;

    }




    public function delete(int $id): bool
    {

        return $this
            ->find($id)
            ->delete();

    }


}
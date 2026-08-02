<?php

namespace App\Modules\Product\Services;


use App\Modules\Product\Repositories\CategoryRepositoryInterface;
use App\Modules\Product\DTO\CategoryDTO;


class CategoryService
{


    public function __construct(
        protected CategoryRepositoryInterface $repository
    ){}



    public function getAll()
    {
        return $this->repository->all();
    }



    public function create(CategoryDTO $dto)
    {

        return $this->repository
            ->create(
                $dto->toArray()
            );

    }



    public function update(
        int $id,
        CategoryDTO $dto
    )
    {

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


}
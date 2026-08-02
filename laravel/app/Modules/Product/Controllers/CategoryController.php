<?php

namespace App\Modules\Product\Controllers;


use App\Http\Controllers\Controller;

use App\Modules\Product\Services\CategoryService;

use App\Modules\Product\Requests\CategoryRequest;

use App\Modules\Product\DTO\CategoryDTO;

use App\Modules\Product\Resources\CategoryResource;



class CategoryController extends Controller
{


    public function __construct(
        protected CategoryService $service
    )
    {

    }



    public function index()
    {

        return CategoryResource::collection(
            $this->service->getAll()
        );

    }



    public function store(CategoryRequest $request)
    {

        $category = $this->service->create(

            CategoryDTO::fromArray(
                $request->validated()
            )

        );


        return new CategoryResource($category);

    }



    public function update(
        CategoryRequest $request,
        int $id
    )
    {

        $category = $this->service->update(

            $id,

            CategoryDTO::fromArray(
                $request->validated()
            )

        );


        return new CategoryResource($category);

    }



    public function destroy(int $id)
    {

        $this->service->delete($id);


        return response()->json([

            'message'=>'Category deleted successfully'

        ]);

    }


}
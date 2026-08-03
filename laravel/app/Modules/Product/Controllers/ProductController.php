<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Services\ProductService;
use App\Modules\Product\Requests\ProductRequest;
use App\Modules\Product\DTO\ProductDTO;
use App\Modules\Product\Resources\ProductResource;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {
    }

    public function index()
    {
        return ProductResource::collection(
            $this->service->getAll()
        );
    }

    public function store(ProductRequest $request)
    {
        $product = $this->service->create(

            ProductDTO::fromArray(
                $request->validated()
            )

        );

        return new ProductResource($product);
    }

    public function update(
        ProductRequest $request,
        int $id
    ) {

        $product = $this->service->update(

            $id,

            ProductDTO::fromArray(
                $request->validated()
            )

        );

        return new ProductResource($product);

    }

    public function destroy(int $id)
    {

        $this->service->delete($id);

        return response()->json([

            'message' => 'Product deleted successfully'

        ]);

    }

    public function show (int $id){
        
        return new ProductResource(
        $this->service->find($id)
        );
        
    }
}
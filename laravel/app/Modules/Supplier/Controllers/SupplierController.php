<?php

namespace App\Modules\Supplier\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Supplier\DTO\SupplierDTO;
use App\Modules\Supplier\Requests\SupplierRequest;
use App\Modules\Supplier\Resources\SupplierResource;
use App\Modules\Supplier\Services\SupplierService;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierService $service
    ) {
    }

    public function index()
    {
        return SupplierResource::collection(
            $this->service->getAll()
        );
    }

    public function show(int $id)
    {
        return new SupplierResource(
            $this->service->find($id)
        );
    }

    public function store(SupplierRequest $request)
    {
        $supplier = $this->service->create(
            SupplierDTO::fromArray(
                $request->validated()
            )
        );

        return new SupplierResource($supplier);
    }

    public function update(
        SupplierRequest $request,
        int $id
    ) {
        $supplier = $this->service->update(
            $id,
            SupplierDTO::fromArray(
                $request->validated()
            )
        );

        return new SupplierResource($supplier);
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return response()->json([
            'message' => 'Supplier deleted successfully'
        ]);
    }
}
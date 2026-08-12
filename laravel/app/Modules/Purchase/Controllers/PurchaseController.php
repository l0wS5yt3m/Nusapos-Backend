<?php

namespace App\Modules\Purchase\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Purchase\DTO\PurchaseDTO;
use App\Modules\Purchase\Requests\PurchaseRequest;
use App\Modules\Purchase\Resources\PurchaseResource;
use App\Modules\Purchase\Services\PurchaseService;

class PurchaseController extends Controller
{
    public function __construct(
        protected PurchaseService $service
    ) {
    }

    public function index()
    {
        return PurchaseResource::collection(
            $this->service->getAll()
        );
    }

    public function show(int $id)
    {
        return new PurchaseResource(
            $this->service->find($id)
        );
    }

    public function store(PurchaseRequest $request)
    {
        $purchase = $this->service->create(
            PurchaseDTO::fromArray(
                $request->validated()
            )
        );

        return new PurchaseResource($purchase);
    }
}
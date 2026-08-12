<?php

namespace App\Modules\Transaction\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Transaction\DTO\TransactionDTO;
use App\Modules\Transaction\Requests\TransactionRequest;
use App\Modules\Transaction\Resources\TransactionResource;
use App\Modules\Transaction\Services\TransactionService;


class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $service
    ) {
    }

    public function index()
    {
        return TransactionResource::collection(
            $this->service->getAll()
        );
    }

    public function show(int $id)
    {
        return new TransactionResource(
            $this->service->find($id)
        );
    }

    public function store(TransactionRequest $request)
{
    $data = $request->validated();

    $data['user_id'] = auth()->id();

    $transaction = $this->service->create(
        TransactionDTO::fromArray($data)
    );

    return new TransactionResource($transaction);
}
}
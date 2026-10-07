<?php

namespace App\Modules\Customer\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customer\DTO\CustomerDTO;
use App\Modules\Customer\Requests\CustomerRequest;
use App\Modules\Customer\Resources\CustomerResource;
use App\Modules\Customer\Services\CustomerService;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $service
    ) {
    }

    public function index()
    {
        return CustomerResource::collection(
            $this->service->getAll()
        );
    }

    public function show(int $id)
    {
        return new CustomerResource(
            $this->service->find($id)
        );
    }

    public function store(CustomerRequest $request)
    {
        $customer = $this->service->create(
            CustomerDTO::fromArray(
                $request->validated()
            )
        );

        return new CustomerResource($customer);
    }

    public function update(CustomerRequest $request, int $id)
    {
        $customer = $this->service->update(
            $id,
            CustomerDTO::fromArray(
                $request->validated()
            )
        );

        return new CustomerResource($customer);
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return response()->json([
            'message' => 'Customer deleted successfully'
        ]);
    }
}
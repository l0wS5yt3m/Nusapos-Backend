<?php

namespace App\Modules\Transaction\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'customer_id' => [
                'nullable',
                'exists:customers,id',
            ],

            'payment_method' => [
                'required',
                'string',
                Rule::in([
                    'cash',
                    'transfer',
                    'qris',
                ]),
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tax' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:500',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.product_id' => [
                'required',
                'exists:products,id',
                'distinct',
            ],

            'items.*.qty' => [
                'required',
                'integer',
                'min:1',
            ],

        ];
    }
}

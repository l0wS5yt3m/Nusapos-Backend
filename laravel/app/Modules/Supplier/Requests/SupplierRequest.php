<?php

namespace App\Modules\Supplier\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [

            'code' => [
                'required',
                'max:30',
                'unique:suppliers,code,' . $id,
            ],

            'name' => [
                'required',
                'max:150',
            ],

            'phone' => [
                'nullable',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'unique:suppliers,email,' . $id,
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ];
    }
}
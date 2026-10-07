<?php

namespace App\Modules\Customer\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
                'unique:customers,code,' . $id,
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
                'unique:customers,email,' . $id,
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'point' => [
                'required',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ];
    }
}
<?php

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [

            'category_id' => [
                'required',
                'exists:categories,id'
            ],

            'sku' => [
                'required',
                'max:30',
                'unique:products,sku,' . $id
            ],

            'barcode' => [
                'nullable',
                'max:50',
                'unique:products,barcode,' . $id
            ],

            'name' => [
                'required',
                'max:150'
            ],

            'slug' => [
                'required',
                'max:170',
                'unique:products,slug,' . $id
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'cost_price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'selling_price' => [
                'required',
                'numeric',
                'gte:cost_price'
            ],

            'stock' => [
                'required',
                'integer',
                'min:0'
            ],

            'minimum_stock' => [
                'required',
                'integer',
                'min:0'
            ],

            'image' => [
                'nullable',
                'string',
                'max:255'
            ],

            'status' => [
                'required',
                'boolean'
            ],

        ];
    }
}
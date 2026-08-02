<?php

namespace App\Modules\Product\Requests;


use Illuminate\Foundation\Http\FormRequest;


class CategoryRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }



    public function rules(): array
    {

        return [

            'name'=>[
                'required',
                'string',
                'max:100'
            ],


            'description'=>[
                'nullable',
                'string'
            ],


            'status'=>[
                'nullable',
                'boolean'
            ]

        ];

    }


}
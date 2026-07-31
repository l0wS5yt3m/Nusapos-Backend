<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories')->ignore($this->route('category')),
            ],
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ];
    }
}

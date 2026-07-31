<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function getAll()
    {
        return Category::latest()->paginate(10);
    }

    public function store(array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return $category;
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }
}

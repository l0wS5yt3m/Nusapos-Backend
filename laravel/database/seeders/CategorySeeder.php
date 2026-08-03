<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        if (Category::count() > 0) {
            return;
        }

        Category::create([
            'name' => 'Makanan',
            'description' => 'Kategori makanan',
            'status' => true,
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Makanan',
                'slug' => 'makanan',
                'description' => 'Menu makanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'description' => 'Menu minuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Snack',
                'slug' => 'snack',
                'description' => 'Menu snack',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

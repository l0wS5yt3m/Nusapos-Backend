<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makanan = Category::where('name', 'Makanan')->first();

        if (! $makanan) {
            return;
        }

        $products = [

            [
                'category_id' => $makanan->id,
                'sku' => 'PRD000001',
                'barcode' => null,
                'name' => 'Mie Ayam',
                'slug' => Str::slug('Mie Ayam'),
                'description' => 'Mie ayam original',
                'cost_price' => 10000,
                'selling_price' => 15000,
                'stock' => 50,
                'minimum_stock' => 10,
                'image' => null,
                'status' => true,
            ],

            [
                'category_id' => $makanan->id,
                'sku' => 'PRD000002',
                'barcode' => null,
                'name' => 'Ayam Geprek',
                'slug' => Str::slug('Ayam Geprek'),
                'description' => 'Ayam geprek sambal bawang',
                'cost_price' => 12000,
                'selling_price' => 18000,
                'stock' => 40,
                'minimum_stock' => 10,
                'image' => null,
                'status' => true,
            ],

        ];

        foreach ($products as $product) {

            Product::updateOrCreate(
                ['sku' => $product['sku']],
                $product
            );

        }
    }
}
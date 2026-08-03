<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
   //     $name = fake()->unique()->words(2, true);

   return [

  //          'category_id' => Category::factory(),

//            'sku' => strtoupper(fake()->unique()->bothify('PRD#####')),

  //          'barcode' => null,

    //        'name' => ucwords($name),

      //      'slug' => Str::slug($name),

        //    'description' => fake()->sentence(),

          //  'cost_price' => fake()->numberBetween(5000, 50000),

           // 'selling_price' => fake()->numberBetween(60000, 100000),

//            'stock' => fake()->numberBetween(10, 200),

  //          'minimum_stock' => fake()->numberBetween(1, 10),

    //        'image' => null,

      //      'status' => true,
 
        ];
  }
}
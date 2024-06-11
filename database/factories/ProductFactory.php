<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    public function definition(): array
    {
        // libreria faker
        return [
            'sku' =>$this->faker->unique()->numberBetween(10,20),
            'name'=>$this->faker->sentence(),
            'description'=>$this->faker->text(10),
            'image_path'=> 'products'.$this->faker->image('public/storage/products',640,480, null, false),
            'price'=>$this->faker->randomFloat(2, 1, 100),
            'subcategory_id'=>$this->faker->numberBetween(1,110),
        ];
    }
}

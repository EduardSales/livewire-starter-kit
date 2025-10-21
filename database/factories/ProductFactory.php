<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'description' => $this->faker->optional(0.7)->sentence(),
            'price' => $this->faker->randomFloat(2, 5, 500), // entre 5.00 i 500.00
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory()->create()->id,
            'is_active' => $this->faker->boolean(90), // 90% d’estar actiu
        ];
    }
}

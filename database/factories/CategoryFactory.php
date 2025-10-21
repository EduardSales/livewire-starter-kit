<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = \App\Models\Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->words(2, true), // ex: "Electronics Home"
            'description' => $this->faker->optional(0.6)->sentence(), // 60% chance de tenir descripció
            'is_active' => $this->faker->boolean(80), // 80% true
        ];
    }
}

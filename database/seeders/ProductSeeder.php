<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 categories
        $categories = Category::factory()->count(10)->create();

        // Ensure each category has at least 2 products (10 categories * 2 = 20 products)
        $categories->each(function ($category) {
            Product::factory()->count(2)->create([
                'category_id' => $category->id,
            ]);
        });

        // Create the remaining 30 products (50 total - 20 already created = 30 remaining)
        // Distribute them randomly among all categories
        Product::factory()->count(30)->create([
            'category_id' => $categories->random()->id,
        ]);
    }
}
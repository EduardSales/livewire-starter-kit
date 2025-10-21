<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 categories
        $categories = Category::factory()->count(10)->create();

        // Crear 50 productes distribuïts entre categories
        foreach ($categories as $category) {
            // Assegurar que cada categoria té almenys 2 productes
            Product::factory()->count(2)->for($category)->create();
        }

        // Crear els restants productes aleatoris fins a 50
        $remaining = 50 - ($categories->count() * 2);
        Product::factory()->count($remaining)->create();
    }
}

<?php

use App\Livewire\Products\ProductList;
use App\Models\Category;
use App\Models\Product;
use Livewire\Livewire;

test('product list component renders successfully', function () {
    Livewire::test(ProductList::class)
        ->assertStatus(200);
});

test('product list displays products', function () {
    $category = Category::factory()->create(['name' => 'Electronics']);
    $product = Product::factory()->create([
        'name' => 'Laptop',
        'category_id' => $category->id,
    ]);

    Livewire::test(ProductList::class)
        ->assertSee('Laptop')
        ->assertSee('Electronics');
});

test('product list paginates 10 items per page', function () {
    $category = Category::factory()->create();
    Product::factory()->count(25)->create(['category_id' => $category->id]);

    Livewire::test(ProductList::class)
        ->assertViewHas('products', function ($products) {
            return $products->count() === 10;
        });
});

test('search filter works correctly', function () {
    $category = Category::factory()->create();
    Product::factory()->create(['name' => 'Laptop HP', 'category_id' => $category->id]);
    Product::factory()->create(['name' => 'Mouse Logitech', 'category_id' => $category->id]);

    Livewire::test(ProductList::class)
        ->set('search', 'Laptop')
        ->assertSee('Laptop HP')
        ->assertDontSee('Mouse Logitech');
});

test('category filter works correctly', function () {
    $category1 = Category::factory()->create(['name' => 'Electronics']);
    $category2 = Category::factory()->create(['name' => 'Books']);

    Product::factory()->create(['name' => 'Laptop', 'category_id' => $category1->id]);
    Product::factory()->create(['name' => 'Novel', 'category_id' => $category2->id]);

    Livewire::test(ProductList::class)
        ->set('categoryFilter', $category1->id)
        ->assertSee('Laptop')
        ->assertDontSee('Novel');
});

test('status filter works correctly', function () {
    $category = Category::factory()->create();
    Product::factory()->create(['name' => 'Active Product', 'is_active' => true, 'category_id' => $category->id]);
    Product::factory()->create(['name' => 'Inactive Product', 'is_active' => false, 'category_id' => $category->id]);

    Livewire::test(ProductList::class)
        ->set('statusFilter', '1')
        ->assertSee('Active Product')
        ->assertDontSee('Inactive Product');
});

test('clear filters resets all filters', function () {
    $category = Category::factory()->create();
    Product::factory()->create(['category_id' => $category->id]);

    Livewire::test(ProductList::class)
        ->set('search', 'test')
        ->set('categoryFilter', $category->id)
        ->set('statusFilter', '1')
        ->call('clearFilters')
        ->assertSet('search', '')
        ->assertSet('categoryFilter', null)
        ->assertSet('statusFilter', null);
});

test('delete product removes it from database', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    expect(Product::count())->toBe(1);

    Livewire::test(ProductList::class)
        ->call('deleteProduct', $product->id)
        ->assertSessionHas('success');

    expect(Product::count())->toBe(0);
});

test('delete nonexistent product shows error', function () {
    Livewire::test(ProductList::class)
        ->call('deleteProduct', 9999)
        ->assertSessionHas('error');
});

test('search updates reset pagination', function () {
    $category = Category::factory()->create();
    Product::factory()->count(25)->create(['category_id' => $category->id]);

    $component = Livewire::test(ProductList::class);

    // Go to page 2
    $component->set('page', 2);

    // Search should reset to page 1
    $component->set('search', 'test');

    expect($component->get('page'))->toBe(1);
});

test('product list shows formatted price', function () {
    $category = Category::factory()->create();
    Product::factory()->create([
        'name' => 'Product',
        'price' => 99.99,
        'category_id' => $category->id,
    ]);

    Livewire::test(ProductList::class)
        ->assertSee('€ 99.99');
});

test('product list shows category badges', function () {
    $category = Category::factory()->create(['name' => 'Electronics']);
    Product::factory()->create(['category_id' => $category->id]);

    Livewire::test(ProductList::class)
        ->assertSee('Electronics');
});

test('product list shows active/inactive status', function () {
    $category = Category::factory()->create();
    Product::factory()->create(['is_active' => true, 'category_id' => $category->id]);
    Product::factory()->create(['is_active' => false, 'category_id' => $category->id]);

    Livewire::test(ProductList::class)
        ->assertSee('Activo')
        ->assertSee('Inactivo');
});
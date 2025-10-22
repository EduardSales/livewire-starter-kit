<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ProductForm extends Component
{
    public $product;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $category_id;
    public $is_active = true;
    public $categories;

    public function mount($product = null)
    {
        $this->categories = Category::getAllCategories();

        if ($product) {
            $this->product = Product::findOrFail($product);
            $this->name = $this->product->name;
            $this->description = $this->product->description;
            $this->price = $this->product->price;
            $this->stock = $this->product->stock;
            $this->category_id = $this->product->category_id;
            $this->is_active = $this->product->is_active;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Product::updateOrCreate(
            ['id' => $this->product->id ?? null],
            $validated
        );

        session()->flash('success', 'Producte guardat correctament!');
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.products.product-form');
    }
}

<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductEdit extends Component
{
    public Product $product;

    public string $name = '';
    public string $description = '';
    public string $price = '';
    public int $stock = 0;
    public ?int $category_id = null;
    public bool $is_active = true;

    /**
     * Mount the component.
     */
    public function mount(Product $product): void
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description ?? '';
        $this->price = (string) $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->is_active = $product->is_active;
    }

    /**
     * Validation rules.
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Custom validation messages.
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número válido.',
            'price.min' => 'El precio debe ser mayor o igual a 0.',
            'price.regex' => 'El precio debe tener máximo 2 decimales.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser mayor o igual a 0.',
            'category_id.required' => 'Debe seleccionar una categoría.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',
        ];
    }

    /**
     * Update the product.
     */
    public function save(): void
    {
        $this->validate();

        try {
            $this->product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'stock' => $this->stock,
                'category_id' => $this->category_id,
                'is_active' => $this->is_active,
            ]);

            session()->flash('success', 'Producto actualizado correctamente.');

            $this->redirect(route('products.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar el producto.');
        }
    }

    /**
     * Cancel and return to products list.
     */
    public function cancel(): void
    {
        $this->redirect(route('products.index'), navigate: true);
    }

    /**
     * Get all active categories.
     */
    public function getCategoriesProperty()
    {
        return Category::where('is_active', true)->orderBy('name')->get();
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.products.product-edit', [
            'categories' => $this->categories,
        ])->layout('components.layouts.app');
    }
}
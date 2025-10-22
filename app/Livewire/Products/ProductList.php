<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public string $search = '';
    public ?string $categoryFilter = null;
    public ?string $statusFilter = null;

    /**
     * Reset pagination when filters change.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    /**
     * Clear all filters.
     */
    public function clearFilters(): void
    {
        $this->reset(['search', 'categoryFilter', 'statusFilter']);
        $this->resetPage();
    }

    /**
     * Delete a product.
     */
    public function deleteProduct(int $productId): void
    {
        try {
            $product = Product::findOrFail($productId);
            $product->delete();

            session()->flash('success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el producto.');
        }
    }

    /**
     * Get filtered products.
     */
    public function getProductsProperty()
    {
        $query = Product::query()->with('category');

        // Apply search filter
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Apply category filter
        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        // Apply status filter
        if ($this->statusFilter !== null && $this->statusFilter !== '') {
            $query->where('is_active', $this->statusFilter === '1');
        }

        return $query->latest()->paginate(10);
    }

    /**
     * Get all categories for the filter dropdown.
     */
    public function getCategoriesProperty()
    {
        return Category::orderBy('name')->get();
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.products.product-list', [
            'products' => $this->products,
            'categories' => $this->categories,
        ])->layout('layouts.app');
    }
}
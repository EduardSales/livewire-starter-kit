<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination;

    public string $search = '';
    public ?string $statusFilter = null;

    /**
     * Reset pagination when filters change.
     */
    public function updatingSearch(): void
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
        $this->reset(['search', 'statusFilter']);
        $this->resetPage();
    }

    /**
     * Delete a category.
     */
    public function deleteCategory(int $categoryId): void
    {
        try {
            $category = Category::findOrFail($categoryId);

            // Check if category has products
            if ($category->products()->count() > 0) {
                session()->flash('error', 'No se puede eliminar una categoría que tiene productos asociados.');
                return;
            }

            $category->delete();
            session()->flash('success', 'Categoría eliminada correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar la categoría.');
        }
    }

    /**
     * Get filtered categories.
     */
    public function getCategoriesProperty()
    {
        $query = Category::query()->withCount('products');

        // Apply search filter
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Apply status filter
        if ($this->statusFilter !== null && $this->statusFilter !== '') {
            $query->where('is_active', $this->statusFilter === '1');
        }

        return $query->latest()->paginate(10);
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.categories.category-list', [
            'categories' => $this->categories,
        ])->layout('components.layouts.app');
    }
}
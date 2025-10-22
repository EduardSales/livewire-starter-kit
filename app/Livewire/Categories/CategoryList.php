<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = ''; // '', '1', '0'

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (! $category) {
            session()->flash('error', 'Categoria no trobada.');
            return;
        }

        // Elimina la categoria i els productes associats (si tens cascade a la DB)
        $category->delete();

        session()->flash('success', 'Categoria eliminada correctament!');
        $this->resetPage();
    }

    public function render()
    {
        $query = Category::query();

        if ($this->search) {
            $query->where('name', 'like', '%'.$this->search.'%');
        }

        if ($this->statusFilter !== '') {
            $query->where('is_active', $this->statusFilter == '1');
        }

        $categories = $query->orderBy('name')->paginate(10);

        return view('livewire.categories.category-list', [
            'categories' => $categories,
        ]);
    }
}

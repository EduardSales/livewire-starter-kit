<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = ''; // '', '1' o '0'

    protected $paginationTheme = 'tailwind'; // o 'bootstrap' si fas servir bootstrap

    // Quan es canvia el valor d'aquests, tornem a la primera pàgina
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    // Mètode per eliminar un producte
    public function delete($id)
    {
        $product = Product::find($id);

        if (! $product) {
            session()->flash('error', 'Producte no trobat.');
            return;
        }

        $product->delete();
        session()->flash('success', 'Producte eliminat correctament.');

        // Si ets a la última pàgina i l'element era l'únic, retrocedir pàgina
        if ($this->page > 1 && Product::query()->count() <= ($this->page - 1) * 10) {
            $this->previousPage();
        }
    }

    public function render()
    {
        $query = Product::query()->with('category');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->categoryFilter !== '') {
            $query->where('category_id', $this->categoryFilter);
        }

        if ($this->statusFilter !== '') {
            $query->where('is_active', $this->statusFilter == '1');
        }

        $products = $query->orderBy('name')->paginate(10);

        $categories = Category::orderBy('name')->get();

        // Aquí declares quines variables s’envien a la vista
        return view('livewire.products.product-list', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}

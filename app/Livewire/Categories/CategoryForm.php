<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    public $category;
    public $name;
    public $description;
    public $is_active = true;

    public function mount($category = null)
    {
        if ($category) {
            $this->category = Category::findOrFail($category);
            $this->name = $this->category->name;
            $this->description = $this->category->description;
            $this->is_active = $this->category->is_active;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . ($this->category->id ?? 'null'),
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Category::updateOrCreate(
            ['id' => $this->category->id ?? null],
            $validated
        );

        session()->flash('success', 'Categoria guardada correctament!');
        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.categories.category-form');
    }
}

<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class CategoryEdit extends Component
{
    public Category $category;

    public string $name = '';
    public string $description = '';
    public bool $is_active = true;

    /**
     * Mount the component.
     */
    public function mount(Category $category): void
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description ?? '';
        $this->is_active = $category->is_active;
    }

    /**
     * Validation rules.
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->category->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Custom validation messages.
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con este nombre.',
        ];
    }

    /**
     * Update the category.
     */
    public function save(): void
    {
        $this->validate();

        try {
            $this->category->update([
                'name' => $this->name,
                'description' => $this->description,
                'is_active' => $this->is_active,
            ]);

            session()->flash('success', 'Categoría actualizada correctamente.');

            $this->redirect(route('categories.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar la categoría.');
        }
    }

    /**
     * Cancel and return to categories list.
     */
    public function cancel(): void
    {
        $this->redirect(route('categories.index'), navigate: true);
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.categories.category-edit')->layout('layouts.app');
    }
}
<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class CategoryForm extends Component
{
    public string $name = '';
    public string $description = '';
    public bool $is_active = true;

    /**
     * Validation rules.
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name',
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
     * Save the category.
     */
    public function save(): void
    {
        $this->validate();

        try {
            Category::create([
                'name' => $this->name,
                'description' => $this->description,
                'is_active' => $this->is_active,
            ]);

            session()->flash('success', 'Categoría creada correctamente.');

            $this->redirect(route('categories.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear la categoría.');
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
        return view('livewire.categories.category-form')->layout('components.layouts.app');
    }
}
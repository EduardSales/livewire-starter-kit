<div>
    <h1 class="text-xl font-bold mb-4">
        {{ isset($product) ? 'Editar Producte' : 'Crear Producte' }}
    </h1>

    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block font-semibold">Nom:</label>
            <input type="text" wire:model="name" class="border p-2 w-full">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Descripció:</label>
            <textarea wire:model="description" class="border p-2 w-full"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Preu:</label>
            <input type="number" wire:model="price" step="0.01" class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Stock:</label>
            <input type="number" wire:model="stock" class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Categoria:</label>
            <select wire:model="category_id" class="border p-2 w-full">
                <option value="">-- Selecciona una categoria --</option>
                @foreach(\App\Models\Category::getAllCategories() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">
                <input type="checkbox" wire:model="is_active">
                Actiu
            </label>
        </div>

        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </form>
</div>

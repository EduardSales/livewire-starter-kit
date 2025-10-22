<div class="p-4 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">
        {{ isset($category) ? 'Editar Categoria' : 'Nova Categoria' }}
    </h1>

    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block font-semibold mb-1">Nom:</label>
            <input type="text" wire:model="name" class="border rounded w-full p-2">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Descripció:</label>
            <textarea wire:model="description" class="border rounded w-full p-2"></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 flex items-center">
            <input type="checkbox" wire:model="is_active" id="is_active" class="mr-2">
            <label for="is_active">Activa</label>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary mr-2">Cancel·lar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>

<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Llistat de Categories</h1>

    <div class="flex items-center space-x-4 mb-4">
        <input type="text" wire:model="search" placeholder="Cerca per nom..."
            class="border p-2 rounded w-1/3">

        <select wire:model="statusFilter" class="border p-2 rounded">
            <option value="">Totes</option>
            <option value="1">Actives</option>
            <option value="0">Inactives</option>
        </select>

        <a href="{{ route('categories.create') }}" class="btn btn-primary">Nova Categoria</a>
    </div>

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-left">Nom</th>
                <th class="border p-2 text-left">Descripció</th>
                <th class="border p-2 text-left">Activa</th>
                <th class="border p-2 text-left">Productes Actius</th>
                <th class="border p-2 text-right">Accions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr wire:key="category-{{ $category->id }}">
                    <td class="border p-2">{{ $category->name }}</td>
                    <td class="border p-2">{{ $category->description ?? '-' }}</td>
                    <td class="border p-2">{{ $category->is_active ? 'Sí' : 'No' }}</td>
                    <td class="border p-2">{{ $category->active_products_count }}</td>
                    <td class="border p-2 text-right">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-secondary mr-2">Editar</a>
                        <button
                            type="button"
                            class="btn btn-sm btn-error"
                            onclick="if(confirm('Segur que vols eliminar aquesta categoria?')) { @this.call('delete', {{ $category->id }}) }"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No s'han trobat categories.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>

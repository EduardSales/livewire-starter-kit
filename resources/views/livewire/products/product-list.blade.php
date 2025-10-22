<div>
    {{-- Notifications --}}
    @if (session()->has('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    {{-- Filtres i accions --}}
    <div class="flex flex-col md:flex-row md:items-center md:space-x-4 mb-4">
        <input
            type="text"
            wire:model.debounce.500ms="search"
            placeholder="Buscar producte..."
            class="input input-bordered w-full md:max-w-md mb-2 md:mb-0"
        />

       <select wire:model="categoryFilter" class="select select-bordered">
            <option value="">Totes les categories</option>
            @foreach(\App\Models\Category::getAllCategories() as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <select wire:model="statusFilter" class="select select-bordered">
            <option value="">Tots els estats</option>
            <option value="1">Actiu</option>
            <option value="0">Inactiu</option>
        </select>

        <div class="ml-auto">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Crear Producte</a>
        </div>
    </div>

    {{-- Taula de resultats --}}
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Categoria</th>
                    <th>Preu</th>
                    <th>Stock</th>
                    <th>Estat</th>
                    <th class="text-right">Accions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\Product::getAllProducts() as $products)
                <tr wire:key="product-{{ $product->id }}">
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category?->name ?? '-' }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->is_active ? 'Actiu' : 'Inactiu' }}</td>
                    <td class="text-right">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-secondary mr-2">Editar</a>
                        <button
                            type="button"
                            class="btn btn-sm btn-error"
                            onclick="if(confirm('Segur que vols eliminar aquest producte?')) { @this.call('delete', {{ $product->id }}) }"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No s'han trobat productes.</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>

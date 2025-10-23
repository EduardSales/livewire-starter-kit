<div>
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                    </div>
                    <span>Gestión de Categorías</span>
                </h1>
                <p class="text-gray-600">Organiza tus productos en categorías personalizadas</p>
            </div>
            <flux:button wire:navigate href="{{ route('categories.create') }}" variant="primary" class="shadow-lg hover:shadow-xl transition-shadow">
                <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Categoría
            </flux:button>
        </div>

        {{-- Flash Messages --}}
        @if (session()->has('success'))
            <div class="mb-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-lg shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 p-4 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-800 rounded-lg shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Filters Card --}}
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <div class="flex items-center gap-2 mb-4">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Filtros</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Search --}}
                <div class="md:col-span-2">
                    <flux:input
                        wire:model.live.debounce.300ms="search"
                        placeholder="Buscar por nombre..."
                    />
                </div>

                {{-- Status Filter --}}
                <div>
                    <flux:select wire:model.live="statusFilter">
                        <option value="">Todos los estados</option>
                        <option value="1">Activas</option>
                        <option value="0">Inactivas</option>
                    </flux:select>
                </div>
            </div>

            {{-- Clear Filters Button --}}
            @if($search || $statusFilter !== null)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <flux:button wire:click="clearFilters" variant="ghost" size="sm">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Limpiar filtros
                    </flux:button>
                </div>
            @endif
        </div>
    </div>

    {{-- Categories Table --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <table class="min-w-full border-separate border-spacing-x-4 divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-1/5">Nombre</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-2/5">Descripción</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-1/5">Productos</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-1/6">Estado</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-1/6">Acciones</th>
            </tr>
        </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                    <tr wire:key="category-{{ $category->id }}" class="hover:bg-purple-50/50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-lg flex items-center justify-center shadow-sm">
                                </div>
                                <span class="font-semibold text-gray-900">{{ $category->name }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            @if($category->description)
                                <div class="text-sm text-gray-600 max-w-md">
                                    {{ Str::limit($category->description, 60) }}
                                </div>
                            @else
                                <span class="text-gray-400 text-sm italic">Sin descripción</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 shadow-sm">
                                    {{ $category->products_count }} total
                                </span>
                                @if($category->active_products_count > 0)
                                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 shadow-sm">
                                        {{ $category->active_products_count }} activos
                                    </span>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category->is_active)
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 shadow-sm">
                                    Activa
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-gradient-to-r from-red-100 to-pink-100 text-red-800 shadow-sm">
                                    Inactiva
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2">
                                <flux:button
                                    wire:navigate
                                    href="{{ route('categories.edit', $category) }}"
                                    variant="ghost"
                                    size="sm"
                                    class="hover:bg-purple-100"
                                >
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </flux:button>

                                <flux:button
                                    wire:click="deleteCategory({{ $category->id }})"
                                    wire:confirm="¿Estás seguro de que deseas eliminar esta categoría? No se puede eliminar si tiene productos asociados."
                                    variant="ghost"
                                    size="sm"
                                    color="red"
                                    class="hover:bg-red-100"
                                >
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </flux:button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                </div>
                                <div>
                                    <p class="text-gray-900 font-medium">No se encontraron categorías</p>
                                    <p class="text-gray-500 text-sm mt-1">Intenta ajustar los filtros o crea una nueva categoría</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
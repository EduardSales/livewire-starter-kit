<div>
    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-3">
            <a href="{{ route('categories.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-150">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-2">
                    <span>Editar Categoría</span>
                </h1>
                <p class="text-gray-600 mt-1">Modifique los campos que desea actualizar</p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-200">
            <form wire:submit="save">
                <div class="space-y-8">
                    {{-- Basic Information Section --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4 pb-2 border-b-2 border-purple-500">
                            <h2 class="text-lg font-bold text-gray-900">Información de la Categoría</h2>
                        </div>

                        <div class="space-y-5">
                            {{-- Name --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre de la Categoría *</label>
                                <flux:input wire:model="name" placeholder="Ej: Electrónica" />
                                @error('name') <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p> @enderror
                                <p class="mt-2 text-sm text-gray-500 flex items-start gap-1.5">
                                    <span>El nombre debe ser único y descriptivo para identificar fácilmente los productos de esta categoría.</span>
                                </p>
                            </div>

                            {{-- Description --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Descripción</label>
                                <textarea
                                    wire:model="description"
                                    placeholder="Descripción detallada de la categoría..."
                                    rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-150"
                                ></textarea>
                                @error('description') <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p> @enderror
                                <p class="mt-2 text-sm text-gray-500">
                                    Descripción opcional para identificar mejor la categoría y sus características.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Products Stats Section --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4 pb-2 border-b-2 border-blue-500">
                            <h2 class="text-lg font-bold text-gray-900">Estadísticas de Productos</h2>
                        </div>

                        <div class="p-5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg border border-blue-200">
                            <div class="flex items-center gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <div class="p-3 bg-white rounded-lg shadow-sm">
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Total de Productos</p>
                                            <p class="text-2xl font-bold text-gray-900">{{ $category->products->count() }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <div class="p-3 bg-white rounded-lg shadow-sm">
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Productos Activos</p>
                                            <p class="text-2xl font-bold text-green-700">{{ $category->active_products_count }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($category->products->count() > 0)
                                <div class="mt-4 pt-4 border-t border-blue-200">
                                    <p class="text-sm text-gray-700 flex items-center gap-1.5">
                                        Esta categoría tiene productos asociados. Los cambios afectarán a todos los productos de esta categoría.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Status Section --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4 pb-2 border-b-2 border-green-500">
                            <h2 class="text-lg font-bold text-gray-900">Estado</h2>
                        </div>

                        {{-- Is Active --}}
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <label class="flex items-start">
                                <input type="checkbox" wire:model="is_active" class="mt-1 rounded border-gray-300 text-purple-600 focus:ring-purple-500 w-5 h-5">
                                <div class="ml-3">
                                    <span class="text-sm font-semibold text-gray-700">Categoría activa</span>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Las categorías activas estarán disponibles para asignar a productos y se mostrarán en los filtros.
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-3 pt-6 border-t border-gray-200">
                        <flux:button type="submit" variant="primary" class="shadow-lg hover:shadow-xl transition-shadow">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Actualizar Categoría
                        </flux:button>

                        <flux:button wire:click="cancel" variant="ghost">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancelar
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
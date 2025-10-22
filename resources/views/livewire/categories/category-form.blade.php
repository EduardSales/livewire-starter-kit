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
                    <span>Crear Nueva Categoría</span>
                </h1>
                <p class="text-gray-600 mt-1">Complete el formulario para agregar una nueva categoría</p>
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
                            {{-- <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg> --}}
                            <h2 class="text-lg font-bold text-gray-900">Información de la Categoría</h2>
                        </div>

                        <div class="space-y-5">
                            {{-- Name --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre de la Categoría *</label>
                                <flux:input wire:model="name" placeholder="Ej: Electrónica" />
                                @error('name') <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    {{-- <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg> --}}
                                    {{ $message }}
                                </p> @enderror
                                <p class="mt-2 text-sm text-gray-500 flex items-start gap-1.5">
                                    {{-- <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg> --}}
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
                                    {{-- <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg> --}}
                                    {{ $message }}
                                </p> @enderror
                                <p class="mt-2 text-sm text-gray-500">
                                    Descripción opcional para identificar mejor la categoría y sus características.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Status Section --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4 pb-2 border-b-2 border-green-500">
                            {{-- <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg> --}}
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
                            {{-- <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg> --}}
                            Crear Categoría
                        </flux:button>

                        <flux:button wire:click="cancel" variant="ghost">
                            {{-- <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg> --}}
                            Cancelar
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
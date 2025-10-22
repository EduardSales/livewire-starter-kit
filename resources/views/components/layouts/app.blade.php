<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    @fluxStyles
</head>
<body class="bg-gradient-to-br from-gray-50 via-gray-100 to-blue-50 min-h-screen font-sans text-gray-800">
    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <nav class="bg-white shadow border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6">
                <div class="flex justify-between items-center h-12">
                    @auth
                        <div class="hidden md:flex items-center space-x-1">
                            <a href="{{ route('products.index') }}" class="flex items-center space-x-0.5 px-2 py-0.5 rounded-md text-xs font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-150">
                                {{-- <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                                </svg> --}}
                                <span>Productes</span>
                            </a>
                            <a href="{{ route('categories.index') }}" class="flex items-center space-x-0.5 px-2 py-0.5 rounded-md text-xs font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-150">
                                {{-- <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg> --}}
                                <span>Categories</span>
                            </a>
                        </div>
                    @endauth

                    <!-- Usuari -->
                    <div class="flex items-center space-x-1">
                        @auth
                            <div class="hidden md:flex items-center space-x-1">
                                {{-- <span class="px-2 py-0.5 bg-blue-50 text-blue-700 text-xs rounded-full font-medium">
                                    {{ auth()->user()->name ?? 'Usuari' }}
                                </span> --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center space-x-0.5 px-2 py-0.5 text-xs text-gray-700 hover:text-red-600 hover:bg-red-50 rounded-md transition-all duration-150">
                                        {{-- <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg> --}}
                                        <span>Sortir</span>
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="px-2 py-0.5 rounded-md text-xs font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-sm hover:shadow transition-all">
                                Inicia sessió
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contingut -->
        <main class="flex-1 py-6">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6">
                {{ $slot }}
            </div>
        </main>

        <!-- Peu de pàgina -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 py-4 text-center text-xs text-gray-600">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }} — Tots els drets reservats.
            </div>
        </footer>
    </div>

    @fluxScripts
</body>
<style>
    svg {
        height:24px;
        width:24px;
    }
    </style>
</html>

<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Livewire\Livewire;

use App\Http\Livewire\Products\ProductList;
use App\Http\Livewire\Products\ProductForm;
use App\Http\Livewire\Categories\CategoryList;
use App\Http\Livewire\Categories\CategoryForm;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/categories', CategoryList::class)->name('categories.index');
// Crear categoria
Route::get('/categories/create', CategoryForm::class)->name('categories.create');

// Editar categoria
Route::get('/categories/{category}/edit', CategoryForm::class)->name('categories.edit');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');


    // Registrem els components Livewire
    Livewire::component('products.product-list', ProductList::class);
    Livewire::component('products.product-form', ProductForm::class);

    // Mostrem les vistes Livewire
    Route::view('/products', 'livewire.products.product-list')->name('products.index');
    Route::view('/products/create', 'livewire.products.product-form')->name('products.create');
    Route::view('/products/{product}/edit', 'livewire.products.product-form')->name('products.edit');

    // Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    // Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    // Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    // Volt::route('settings/two-factor', 'settings.two-factor')
    //     ->middleware(
    //         when(
    //             Features::canManageTwoFactorAuthentication()
    //                 && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
    //             ['password.confirm'],
    //             [],
    //         ),
    //     )
    //     ->name('two-factor.show');
});

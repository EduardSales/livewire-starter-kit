<?php

use App\Livewire\Products\ProductList;
use App\Livewire\Products\ProductForm;
use App\Livewire\Products\ProductEdit;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', ProductList::class)->name('index');
    Route::get('/create', ProductForm::class)->name('create');
    Route::get('/{product}/edit', ProductEdit::class)->name('edit');
});
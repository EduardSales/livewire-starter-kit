<?php

use App\Livewire\Categories\CategoryList;
use App\Livewire\Categories\CategoryForm;
use App\Livewire\Categories\CategoryEdit;
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', CategoryList::class)->name('index');
    Route::get('/create', CategoryForm::class)->name('create');
    Route::get('/{category}/edit', CategoryEdit::class)->name('edit');
});
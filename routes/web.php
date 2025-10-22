<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Livewire\Livewire;



Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.dashboard');
    })->name('dashboard');
    require __DIR__.'/web_products_routes.php';
    require __DIR__.'/web_categories_routes.php';

    Volt::route('/settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('/settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('/settings/appearance', 'settings.appearance')->name('appearance.edit');

    if (Features::enabled(Features::twoFactorAuthentication())) {
        Volt::route('/settings/two-factor', 'settings.two-factor')
            ->middleware('password.confirm')
            ->name('two-factor.show');
    }
});

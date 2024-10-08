<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::get('/', function () {
//     return view('welcome');
// });

Volt::route('/count', 'counter')->name('counter');

// Volt::route('/', '/home/index')->name('dashboard');
Volt::route('/', '/index2')->name('dashboard');
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    // Route::get('/dashboard', function () {in
    //     return view('livewire.dashboard');
    // })->name('dashboard');
});

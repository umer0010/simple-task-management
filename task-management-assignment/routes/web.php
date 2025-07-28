<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Tasks\TaskListAssignment;


Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', TaskListAssignment::class)->name('dashboard');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

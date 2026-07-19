<?php

use App\Livewire\ChatComponent;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Ruta del chat usando componente Livewire
Route::get('chat', ChatComponent::class)
    ->name('dashboard')
    ->middleware('auth');

require __DIR__.'/settings.php';

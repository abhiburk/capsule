<?php

use App\Livewire\Capsule\CreateCapsule;
use App\Livewire\Capsule\CreateMessage;
use App\Livewire\Capsule\ListMessage;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('home', 'home')
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::prefix('capsules')->name('capsules.')->group(function () {
            Route::get('create', CreateCapsule::class)->name('create');
            Route::get('{capsule}', CreateMessage::class)->name('show');
            Route::get('{capsule}/messages', ListMessage::class)->name('messages.index');
        });
    }
);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

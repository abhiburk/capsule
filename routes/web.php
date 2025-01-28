<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Capsule\CreateCapsule;
use App\Livewire\Capsule\CreateLetter;
use App\Livewire\Capsule\ListCapsule;
use App\Livewire\Capsule\ListLetter;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::prefix('capsules')->name('capsules.')->group(function () {
            Route::get('/', ListCapsule::class)->name('index');
            Route::get('create', CreateCapsule::class)->name('create');
            Route::get('{capsule}', CreateLetter::class)->name('show');
            Route::get('{capsule}/letters', ListLetter::class)->name('letters.index');
        });
    }
);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

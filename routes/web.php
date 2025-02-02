<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Capsule\CreateCapsule;
use App\Livewire\Capsule\Letter\CreateLetter;
use App\Livewire\Capsule\Letter\ListLetter;
use App\Livewire\Capsule\ListCapsule;
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
            Route::prefix('{capsule}/letters')->name('letters.')->group(function () {
                Route::get('/', ListLetter::class)->name('index');
                Route::get('create', CreateLetter::class)->name('create');
            });
        });
    }
);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Capsule\CreateCapsule;
use App\Livewire\Capsule\Letter\CreateLetter;
use App\Livewire\Capsule\Letter\ListLetter;
use App\Livewire\Capsule\ListCapsule;
use App\Mail\RecipientLetterEmail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/mailable', function () {
    return new RecipientLetterEmail('9e1b78ab-3c12-4181-865b-4bf6c6cc2e83');
});

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
                Route::get('/{letter}', CreateLetter::class)->name('show');
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

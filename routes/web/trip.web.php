<?php

declare(strict_types=1);

use App\Http\Controllers\TripController;
use App\Http\Controllers\TripUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::get('trips', [TripController::class, 'index'])->name('trips.index');
    Route::get('trips/create', [TripController::class, 'create'])->name('trips.create');
    Route::post('trips', [TripController::class, 'store'])->name('trips.store');
    Route::get('trips/{trip}', [TripController::class, 'show'])
        ->name('trips.show')
        ->can('view', 'trip');
    Route::post('trips/{trip}/users', [TripUserController::class, 'store'])
        ->name('trips.users.store');
});

<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Trip\TripController;
use App\Http\Controllers\Web\Trip\TripItineraryController;
use App\Http\Controllers\Web\Trip\TripUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::get('trips', [TripController::class, 'index'])->name('trips.index');
    Route::get('trips/create', [TripController::class, 'create'])->name('trips.create');
    Route::post('trips', [TripController::class, 'store'])->name('trips.store');
    Route::get('trips/{trip}', [TripController::class, 'show'])
        ->name('trips.show')
        ->can('view', 'trip');
    Route::get('trips/{trip}/itineraries/create', [TripItineraryController::class, 'create'])
        ->name('trips.itineraries.create')
        ->can('view', 'trip');
    Route::post('trips/{trip}/itineraries', [TripItineraryController::class, 'store'])
        ->name('trips.itineraries.store')
        ->can('view', 'trip');
    Route::post('trips/{trip}/users', [TripUserController::class, 'store'])
        ->name('trips.users.store');
});

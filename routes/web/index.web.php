<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

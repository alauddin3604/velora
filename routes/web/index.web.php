<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome');

Route::get('home', [DashboardController::class, 'index'])
    ->name('home')
    ->middleware('auth');

<?php

declare(strict_types=1);

use App\Http\Controllers\Authentication\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('auth.login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout')->middleware('auth');

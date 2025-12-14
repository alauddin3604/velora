<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::get('users', [UserController::class, 'index'])
        ->name('users.index')
        ->can('viewAny', User::class);

    Route::get('users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->can('create', User::class);

    Route::post('users', [UserController::class, 'store'])
        ->name('users.store')
        ->can('create', User::class);

    Route::get('users/{user}', [UserController::class, 'show'])
        ->name('users.show')
        ->can('view', User::class);

    Route::delete('users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->can('delete', User::class);
});

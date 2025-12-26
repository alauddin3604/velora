<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Authentication\AuthenticatedSessionController;
use App\Http\Controllers\Web\Authentication\ForgotPasswordController;
use App\Http\Controllers\Web\Authentication\ResetPasswordController;
use App\Http\Controllers\Web\Authentication\SocialController;
use App\Http\Controllers\Web\Authentication\UserRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('auth.login');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout')->middleware('auth');

Route::get('signup', [UserRegistrationController::class, 'create'])->name('signup')->middleware('guest');
Route::post('signup', [UserRegistrationController::class, 'store'])->name('auth.signup');

Route::get('forgot-password', [ForgotPasswordController::class, 'create'])->name('password.forgot')->middleware('guest');
Route::post('forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email')->middleware('guest');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset')->middleware('guest');
Route::post('reset-password', [ResetPasswordController::class, 'store'])->name('password.update')->middleware('guest');

Route::get('auth/{provider}/redirect', [SocialController::class, 'redirect'])
    ->name('auth.social.redirect')
    ->middleware('guest');

Route::get('auth/{provider}/callback', [SocialController::class, 'callback'])
    ->name('auth.social.callback');

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Response;

final class ResetPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(string $token): Response
    {
        return inertia('Auth/ResetPasswordPage', [
            'token' => $token,
        ]);
    }

    /**
     * Reset the given user's password.
     */
    public function store(ResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password): void {
                $user->forceFill([
                    'password' => $password,
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? to_route('login')->with('success', __($status))
            : back()->withInput()->with('error', __($status));
    }
}

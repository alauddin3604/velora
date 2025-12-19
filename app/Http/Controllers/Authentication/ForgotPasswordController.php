<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Inertia\Response;

final class ForgotPasswordController extends Controller
{
    public function create(): Response
    {
        return inertia('Auth/ForgotPasswordPage');
    }

    public function store(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('info', __($status))
            : back()->withInput()->withErrors(['email' => __($status)]);
    }
}

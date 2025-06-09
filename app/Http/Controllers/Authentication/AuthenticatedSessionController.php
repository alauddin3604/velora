<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authentication;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\DataTransferObjects\LoginData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

final class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form.
     */
    public function create(): Response
    {
        return inertia('Auth/Login');
    }

    /**
     * Process the login request.
     */
    public function store(LoginRequest $request, LoginAction $action): RedirectResponse
    {
        $action->run(LoginData::from($request->safe()->toArray()));

        return to_route('dashboard')->with('info', 'You have been logged in.');
    }

    /**
     * Process the logout request.
     */
    public function destroy(LogoutRequest $request, LogoutAction $action): RedirectResponse
    {
        $action->run($request);

        return to_route('login')->with('info', 'You have been logged out.');
    }
}

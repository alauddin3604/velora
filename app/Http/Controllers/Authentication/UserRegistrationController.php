<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authentication;

use App\Actions\Auth\SignupAction;
use App\DataTransferObjects\SignupData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

final class UserRegistrationController extends Controller
{
    public function create(): Response
    {
        return inertia('Auth/SignupPage');
    }

    public function store(SignupRequest $request, SignupAction $action): RedirectResponse
    {
        $action->run(SignupData::from($request->validated()));

        return to_route('dashboard')->with('success', 'You have successfully signed up!');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Authentication;

use App\Actions\Auth\HandleSocialLoginAction;
use App\Enums\SocialiteProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Socialite;

class SocialController extends Controller
{
    /**
     * Redirect to social provider for authentication.
     */
    public function redirect(SocialiteProvider $provider): RedirectResponse
    {
        return Socialite::driver($provider->value)->redirect();
    }

    /**
     * Handle social provider callback and login the user.
     */
    public function callback(HandleSocialLoginAction $action, SocialiteProvider $provider): RedirectResponse
    {
        $action->run($provider);

        return to_route('dashboard')->with('success', 'You have been logged in successfully.');
    }
}

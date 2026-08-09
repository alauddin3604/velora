<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Authentication;

use App\Enums\SocialiteProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class RedirectSocialController extends Controller
{
    /**
     * Redirect to social provider for authentication.
     */
    public function __invoke(SocialiteProvider $provider): RedirectResponse
    {
        return Socialite::driver($provider->value)->redirect();
    }
}

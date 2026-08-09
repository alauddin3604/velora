<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Authentication;

use App\Actions\Auth\HandleSocialLoginAction;
use App\Enums\SocialiteProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class HandleSocialCallbackController extends Controller
{
    /**
     * Handle social provider callback and login the user.
     */
    public function __invoke(HandleSocialLoginAction $action, SocialiteProvider $provider): RedirectResponse
    {
        $action->run($provider);

        return to_route('home')->with('success', 'You have been logged in successfully.');
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;

final readonly class HandleSocialLoginAction
{
    /**
     * Execute the action.
     */
    public function run(string $provider): void
    {
        DB::transaction(function () use ($provider): void {
            $social = Socialite::driver($provider)->user();

            $user = User::query()
                ->updateOrCreate([
                    'socialite_id' => $social->getId(),
                    'provider' => $provider,
                    'email' => $social->getEmail(),
                ], [
                    'name' => $social->getName(),
                    'password' => Str::password(8),
                    'avatar' => $social->getAvatar(),
                ]);

            Auth::login($user);
        });
    }
}

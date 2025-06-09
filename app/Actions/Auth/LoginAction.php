<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\DataTransferObjects\LoginData;
use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;

final readonly class LoginAction
{
    /**
     * Run the login action.
     *
     * @throws LoginException If the login fails.
     */
    public function run(LoginData $data): void
    {
        if (! Auth::attempt($data->toArray())) {
            throw new LoginException;
        }
    }
}

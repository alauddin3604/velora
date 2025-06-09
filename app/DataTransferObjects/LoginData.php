<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

final class LoginData extends Data
{
    /**
     * Create a new LoginData instance.
     *
     * @param  string  $email     The user's email.
     * @param  string  $password  The user's password.
     */
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {}
}

<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

final class SignupData extends Data
{
    /**
     * @param  string  $name      The name of the user
     * @param  string  $email     The email of the user
     * @param  string  $password  The password of the user
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {}
}

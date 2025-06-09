<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

final class ProfileData extends Data
{
    /**
     * Construct the class instance.
     *
     * @param  string  $name   The user's name.
     * @param  string  $email  The user's email.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}
}

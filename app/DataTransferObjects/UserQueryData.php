<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

final class UserQueryData extends Data
{
    /**
     * Construct the class instance.
     *
     * @param  null|string  $name   The user's name.
     * @param  null|string  $email  The user's email.
     */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $email = null,
    ) {}
}

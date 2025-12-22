<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Trip;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
final class StoreTripUserData extends Data
{
    /**
     * @param  array<int, int>  $userIds  The IDs of the users to invite.
     * @param  string           $role     The role of the user.
     */
    public function __construct(
        public readonly array $userIds,
        public readonly string $role,
    ) {}
}

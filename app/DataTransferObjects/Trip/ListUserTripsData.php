<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Trip;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
final class ListUserTripsData extends Data
{
    /**
     * @param  ?string  $search     The search query
     * @param  ?string  $status     The status of the trip
     * @param  ?bool    $isInvited  Whether the trip is invited
     * @param  ?int     $perPage    The number of trips per page
     */
    public function __construct(
        public readonly ?string $search,
        public readonly ?string $status,
        public readonly ?bool $isInvited,
        public readonly ?int $perPage,
    ) {}
}

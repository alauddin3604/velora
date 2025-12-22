<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Trip;

use Carbon\CarbonInterface;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
final class StoreTripData extends Data
{
    /**
     * @param  string           $title      The title of the trip
     * @param  CarbonInterface  $startDate  The start date of the trip
     * @param  CarbonInterface  $endDate    The end date of the trip
     */
    public function __construct(
        public readonly string $title,
        public readonly CarbonInterface $startDate,
        public readonly CarbonInterface $endDate,
    ) {}
}

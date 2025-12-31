<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Trip;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
final class StoreTripItineraryData extends Data
{
    /**
     * @param  string   $title             The title of the itinerary.
     * @param  string   $type              The type of the itinerary.
     * @param  ?string  $description       The description of the itinerary.
     * @param  ?string  $location          The location of the itinerary.
     * @param  ?string  $startTime         The start time of the itinerary.
     * @param  ?string  $endTime           The end time of the itinerary.
     * @param  ?int     $dayNumber         The day number of the itinerary.
     * @param  ?int     $order             The order of the itinerary.
     * @param  ?int     $budgetEstimation  The budget estimation of the itinerary.
     */
    public function __construct(
        public readonly string $title,
        public readonly string $type,
        public readonly ?string $description,
        public readonly ?string $location,
        public readonly ?string $startTime,
        public readonly ?string $endTime,
        public readonly ?int $dayNumber,
        public readonly ?int $order,
        public readonly ?int $budgetEstimation,
    ) {}
}

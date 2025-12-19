<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Trip;

use App\Http\Requests\Trip\StoreTripRequest;
use Carbon\CarbonInterface;
use Spatie\LaravelData\Data;

final class StoreTripData extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly CarbonInterface $startDate,
        public readonly CarbonInterface $endDate,
    ) {}

    public static function fromStoreTripRequest(StoreTripRequest $request): self
    {
        return new self(
            title: $request->input('title'),
            startDate: $request->date('start_date'),
            endDate: $request->date('end_date'),
        );
    }
}

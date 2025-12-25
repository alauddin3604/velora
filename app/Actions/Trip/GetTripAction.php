<?php

declare(strict_types=1);

namespace App\Actions\Trip;

use App\Models\Trip;

final readonly class GetTripAction
{
    public function run(Trip $trip): Trip
    {
        return $trip->load([
            'users',
            'itineraries',
        ]);
    }
}

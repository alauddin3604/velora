<?php

declare(strict_types=1);

namespace App\Actions\Trip;

use App\Actions\Action;
use App\Models\Trip;

final readonly class GetTripAction extends Action
{
    /**
     * Get a trip with its related users and itineraries.
     */
    public function run(Trip $trip): Trip
    {
        return $trip->load([
            'users',
            'itineraries',
        ]);
    }
}

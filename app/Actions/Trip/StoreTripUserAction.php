<?php

declare(strict_types=1);

namespace App\Actions\Trip;

use App\Actions\Action;
use App\DataTransferObjects\Trip\StoreTripUserData;
use App\Models\Trip;

final readonly class StoreTripUserAction extends Action
{
    /**
     * @param  Trip               $trip  The trip to invite users to.
     * @param  StoreTripUserData  $data  The data for inviting users to the trip.
     */
    public function run(Trip $trip, StoreTripUserData $data): void
    {
        $trip->users()->attach($data->userIds, ['role' => $data->role]);
    }
}

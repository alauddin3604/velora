<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TripPolicy
{
    /**
     * Determine if the given trip can be viewed by the user.
     */
    public function view(User $user, Trip $trip): Response
    {
        return $user->id === $trip->user_id || $user->invitedTrips()->where('trip_id', $trip->id)->exists()
            ? Response::allow()
            : Response::deny('You are not allowed to view the trip.');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Trip;

use App\Actions\Trip\StoreTripUserAction;
use App\DataTransferObjects\Trip\StoreTripUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\StoreTripUserRequest;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;

final class TripUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripUserRequest $request, StoreTripUserAction $action, Trip $trip): RedirectResponse
    {
        $action->run($trip, StoreTripUserData::from($request->safe()->toArray()));

        return to_route('trips.show', $trip)->with('success', 'Invite sent successfully.');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Trip;

use App\Actions\Trip\StoreTripItineraryAction;
use App\DataTransferObjects\Trip\StoreTripItineraryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\StoreTripItineraryRequest;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final class TripItineraryController extends Controller
{
    /**
     * Create a new itinerary for a trip.
     *
     * @param  Trip  $trip  The trip to which the itinerary will be added.
     */
    public function create(Trip $trip): Response
    {
        return Inertia::render('Trip/Itinerary/CreatePage', [
            'trip' => $trip,
        ]);
    }

    /**
     * Store a newly created itinerary for a trip.
     *
     * @param  StoreTripItineraryRequest  $request  The request containing the itinerary data.
     * @param  StoreTripItineraryAction   $action   The action to store the itinerary.
     * @param  Trip                       $trip     The trip to which the itinerary will be added.
     */
    public function store(StoreTripItineraryRequest $request, StoreTripItineraryAction $action, Trip $trip): RedirectResponse
    {
        $action->run($trip, StoreTripItineraryData::from($request->safe()->toArray()));

        return to_route('trips.show', $trip)->with('success', 'Itinerary created successfully.');
    }
}

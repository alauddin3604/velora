<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Trip\GetTripListAction;
use App\Actions\Trip\StoreTripAction;
use App\DataTransferObjects\Trip\GetTripListData;
use App\DataTransferObjects\Trip\StoreTripData;
use App\Http\Requests\Trip\GetTripListRequest;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class TripController extends Controller
{
    public function index(GetTripListRequest $request, GetTripListAction $action): Response
    {
        $data = GetTripListData::fromGetTripListRequest($request);

        return inertia('Trip/IndexPage', [
            'trips' => TripResource::collection($action->handle($data)),
            'search' => $data->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return inertia('Trip/CreatePage');
    }

    public function store(StoreTripRequest $request, StoreTripAction $action): RedirectResponse
    {
        $action->handle(StoreTripData::fromStoreTripRequest($request));

        return to_route('trips.index')->with('success', 'Trip created successfully');
    }

    public function show(Trip $trip): Response
    {
        return inertia('Trip/ShowPage', [
            'trip' => TripResource::make($trip),
        ]);
    }
}

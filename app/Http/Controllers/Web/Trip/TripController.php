<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Trip;

use App\Actions\Trip\GetTripAction;
use App\Actions\Trip\ListUserTripsAction;
use App\Actions\Trip\StoreTripAction;
use App\DataTransferObjects\Trip\ListUserTripsData;
use App\DataTransferObjects\Trip\StoreTripData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\ListUserTripsRequest;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TripController extends Controller
{
    /**
     * Display a listing of the trips.
     */
    public function index(ListUserTripsRequest $request, ListUserTripsAction $action): Response
    {
        $data = ListUserTripsData::from($request->safe()->toArray());

        return inertia('Trip/IndexPage', [
            'trips' => Inertia::defer(fn (): JsonResource => TripResource::collection($action->run($data))),
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

    /**
     * Store a newly created trip in storage.
     */
    public function store(StoreTripRequest $request, StoreTripAction $action): RedirectResponse
    {
        $action->run(
            user: $request->user(),
            data: StoreTripData::from([
                'title' => $request->safe()->input('title'),
                'start_date' => $request->safe()->date('start_date'),
                'end_date' => $request->safe()->date('end_date'),
            ])
        );

        return to_route('trips.index')->with('success', 'Trip created successfully');
    }

    /**
     * Display the specified trip.
     */
    public function show(GetTripAction $action, Trip $trip): Response
    {
        return inertia('Trip/ShowPage', [
            'trip' => TripResource::make($action->run($trip)),
            'users' => Inertia::optional(fn () => request()->filled('search_user')
                ? User::query()
                    ->whereNot('id', Auth::id())
                    ->where('name', 'like', '%'.request('search_user').'%')
                    ->get()
                : collect()),
        ]);
    }
}

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
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TripController extends Controller
{
    public function index(GetTripListRequest $request, GetTripListAction $action): Response
    {
        $data = GetTripListData::fromGetTripListRequest($request);

        return inertia('Trip/IndexPage', [
            'trips' => Inertia::defer(fn (): JsonResource => TripResource::collection($action->handle($data))),
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
        $action->run(StoreTripData::fromStoreTripRequest($request));

        return to_route('trips.index')->with('success', 'Trip created successfully');
    }

    public function show(Trip $trip): Response
    {
        return inertia('Trip/ShowPage', [
            'trip' => TripResource::make($trip),
            'users' => Inertia::optional(fn () => request()->filled('search_user')
                ? User::query()
                    ->whereNot('id', Auth::id())
                    ->where('name', 'like', '%'.request('search_user').'%')
                    ->get()
                : collect()),
        ]);
    }
}

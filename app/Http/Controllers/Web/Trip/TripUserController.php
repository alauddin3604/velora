<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Trip;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class TripUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Trip $trip): RedirectResponse
    {
        // TODO: refactor this
        $request->validate([
            'user_ids' => [
                'required',
                'array',
                'min:1',
            ],
            'user_ids.*' => ['exists:users,id'],
            'role' => ['required', 'in:viewer,editor'],
        ]);

        $trip->users()->attach($request->user_ids, ['role' => $request->role]);

        return to_route('trips.show', $trip)->with('success', 'Invite sent successfully.');
    }
}

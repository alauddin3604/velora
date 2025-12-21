<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

final class TripUserController extends Controller
{
    public function store(Request $request, Trip $trip)
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

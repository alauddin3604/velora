<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Profile\UpdateProfileAction;
use App\DataTransferObjects\ProfileData;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

final class ProfileController extends Controller
{
    /**
     * Render the profile edit page.
     */
    public function edit(): Response
    {
        return inertia('Profile');
    }

    /**
     * Update the profile.
     */
    public function update(UpdateProfileRequest $request, UpdateProfileAction $action): RedirectResponse
    {
        $action->run($request->user(), ProfileData::from($request->safe()->toArray()));

        return back()->with('success', 'Your profile has been updated.');
    }
}

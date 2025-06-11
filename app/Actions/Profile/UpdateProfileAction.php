<?php

declare(strict_types=1);

namespace App\Actions\Profile;

use App\Actions\Action;
use App\DataTransferObjects\ProfileData;
use App\Models\User;

final readonly class UpdateProfileAction extends Action
{
    /**
     * Execute the action.
     */
    public function run(User $user, ProfileData $data): User
    {
        $user->update([
            'name' => $data->name,
            'email' => $data->email,
        ]);

        return $user;
    }
}

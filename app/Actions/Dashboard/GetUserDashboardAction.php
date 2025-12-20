<?php

declare(strict_types=1);

namespace App\Actions\Dashboard;

use App\Actions\Action;
use App\Models\User;

final readonly class GetUserDashboardAction extends Action
{
    public function run(User $user): array
    {
        return [
            'trips_count' => $user->trips()->count(),
        ];
    }
}

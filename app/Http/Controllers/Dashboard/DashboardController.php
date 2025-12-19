<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Inertia\Inertia;
use Inertia\Response;

final class DashboardController extends Controller
{
    /**
     * Render the dashboard page.
     */
    public function index(): Response
    {
        $props = [
            'trips_count' => Trip::query()->count(),
        ];

        return Inertia::render('DashboardPage', $props);
    }
}

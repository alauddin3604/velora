<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

final class DashboardController extends Controller
{
    /**
     * Render the dashboard page.
     */
    public function index(): Response
    {
        return Inertia::render('Welcome');
    }
}

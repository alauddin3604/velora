<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\GetUserDashboardAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

final class DashboardController extends Controller
{
    /**
     * Render the dashboard page.
     */
    public function index(GetUserDashboardAction $action): Response
    {
        $props = $action->run(Auth::user());

        return Inertia::render('DashboardPage', $props);
    }
}

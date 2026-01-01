<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Response;

final class WelcomeController extends Controller
{
    public function index(): Response
    {
        return inertia('WelcomePage');
    }
}

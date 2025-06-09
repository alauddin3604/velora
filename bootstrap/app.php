<?php

declare(strict_types=1);

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function (Response $response) {
            if (app()->isProduction() && $response->getStatusCode() === 500) {
                return inertia('Error', ['error' => 'Something went wrong. Please contact support.']);
            }

            if ($response->getStatusCode() === 419) {
                return back()->with([
                    'warning' => 'The page expired, please try again.',
                ]);
            }

            if ($response->getStatusCode() === 403) {
                return back()->with([
                    'error' => 'You are not authorized to perform this action.',
                ]);
            }

            return $response;
        });
    })
    ->create();

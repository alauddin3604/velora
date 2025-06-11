<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('can view login page', function (): void {
    get('/login')
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page): AssertableInertia => $page
                ->component('Auth/Login')
        );
});

it('cannot view login page if authenticated', function (): void {
    actingAs(createUser())
        ->get('/login')
        ->assertRedirect(route('dashboard'));
});

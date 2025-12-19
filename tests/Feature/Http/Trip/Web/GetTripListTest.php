<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('can get trip list', function (): void {
    $user = createUser();

    actingAs($user);

    $response = get('trip');
    $response->assertOk();
    $response->assertInertia(fn (AssertableInertia $page): AssertableInertia => $page
        ->component('Trip/IndexPage')
        ->where('trips.data', []));
});

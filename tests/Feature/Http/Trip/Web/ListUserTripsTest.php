<?php

declare(strict_types=1);

use App\Models\Trip;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('can get trip list', function (): void {
    $user = createUser();

    $trip = Trip::factory()->for($user)->create();

    actingAs($user);

    $response = get('trips');
    $response->assertOk();
    $response->assertInertia(fn (AssertableInertia $page): AssertableInertia => $page
        ->component('Trip/IndexPage')
        ->loadDeferredProps(
            fn (AssertableInertia $reload): AssertableInertia => $reload
                ->has('trips.data', 1)
                ->where('trips.data.0.id', $trip->id)
        )
    );
});

it('can get invited trip list', function (): void {
    $user = createUser();

    /** @var Trip */
    $trip = Trip::factory()->create();
    $trip->users()->attach($user, [
        'is_accepted' => true,
    ]);

    actingAs($user);

    $response = get('trips');
    $response->assertOk();
    $response->assertInertia(
        fn (AssertableInertia $page): AssertableInertia => $page
            ->component('Trip/IndexPage')
            ->missing('trips')
            ->loadDeferredProps(
                fn (AssertableInertia $reload): AssertableInertia => $reload
                    ->has('trips.data', 1)
                    ->where('trips.data.0.id', $trip->id)
            )
    );
});

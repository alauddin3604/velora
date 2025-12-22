<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Date;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\from;

it('can store a trip', function (): void {
    $user = createUser();

    actingAs($user);

    $currentDate = Date::now();

    $startDate = $currentDate->addDays(7)->format('Y-m-d');
    $endDate = $currentDate->addDays(14)->format('Y-m-d');

    $response = from(route('trips.create'))->post(route('trips.store'), [
        'title' => 'Test Trip',
        'start_date' => $startDate,
        'end_date' => $endDate,
    ]);

    $response->assertValid();
    $response->assertRedirect(route('trips.index'));
    $response->assertSessionHas('success', 'Trip created successfully');

    assertDatabaseHas('trips', [
        'title' => 'Test Trip',
        'user_id' => $user->id,
        'start_date' => $startDate,
        'end_date' => $endDate,
    ]);
});

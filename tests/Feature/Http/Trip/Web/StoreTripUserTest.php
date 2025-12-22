<?php

declare(strict_types=1);

use App\Models\Trip;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertDatabaseHas;

it('cannot invite users to a trip that is not owned', function (): void {
    $users = User::factory()->count(2)->create();

    $user = createUser();

    $trip = Trip::factory()->create();

    expect($user->id)->not()->toBe($trip->user_id, 'The user should not be the owner of the trip');

    actingAs($user)
        ->post('trips/'.$trip->id.'/users', [
            'user_ids' => $users->pluck('id')->toArray(),
            'role' => 'viewer',
        ])
        ->assertRedirectToRoute('dashboard')
        ->assertSessionHas('error', 'This action is unauthorized.');

    assertDatabaseEmpty('trip_user');
});

it('can invite users to a trip', function (): void {
    $users = User::factory()->count(2)->create();

    $user = createUser();

    $trip = Trip::factory()->for($user)->create();

    actingAs($user)
        ->post('trips/'.$trip->id.'/users', [
            'user_ids' => $users->pluck('id')->toArray(),
            'role' => 'viewer',
        ])
        ->assertValid()
        ->assertRedirect()
        ->assertSessionHas('success', 'Invite sent successfully.');

    assertDatabaseHas('trip_user', [
        'trip_id' => $trip->id,
        'user_id' => $users[0]->id,
        'role' => 'viewer',
        'is_accepted' => null,
    ]);

    assertDatabaseHas('trip_user', [
        'trip_id' => $trip->id,
        'user_id' => $users[1]->id,
        'role' => 'viewer',
        'is_accepted' => null,
    ]);
});

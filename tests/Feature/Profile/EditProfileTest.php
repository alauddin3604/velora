<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;

it('can edit profile if authenticated', function (): void {
    $user = createUser([
        'name' => 'Test User',
    ]);

    actingAs($user)
        ->get('/profile/edit')
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page): AssertableInertia => $page
                ->component('Profile')
                ->where('auth.user.id', $user->id)
                ->where('auth.user.name', 'Test User')
                ->where('auth.user.email', $user->email)
        );
});

it('cannot edit profile if not authenticated', function (): void {
    assertGuest()
        ->get('/profile/edit')
        ->assertRedirect(route('login'));
});

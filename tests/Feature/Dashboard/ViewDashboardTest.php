<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;

it('can view dashboard if authenticated', function (): void {
    $user = createUser();

    actingAs($user)
        ->get('/')
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page): AssertableInertia => $page
                ->component('Welcome')
                ->where('auth.user.id', $user->id)
                ->where('auth.user.name', $user->name)
                ->where('auth.user.email', $user->email)
        );
});

it('cannot view dashboard if not authenticated', function (): void {
    assertGuest();

    get('/')->assertRedirect('/login');
});

<?php

declare(strict_types=1);

use App\Enums\RoleName;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;

test('super admin can create user', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::SuperAdmin);

    actingAs($user)
        ->get(route('users.create'))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page): AssertableInertia => $page
                ->component('User/Create')
        );
});

test('admin cannot create user', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::Admin);

    actingAs($user)
        ->get(route('users.create'))
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error', 'This action is unauthorized.');
});

test('user cannot create user', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::User);

    actingAs($user)
        ->get(route('users.create'))
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error', 'This action is unauthorized.');
});

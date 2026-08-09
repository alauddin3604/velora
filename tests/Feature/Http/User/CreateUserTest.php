<?php

declare(strict_types=1);

use App\Enums\RoleName;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertTrue;

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
        ->assertRedirect(route('home'))
        ->assertSessionHas('error', 'This action is unauthorized.');
});

test('user cannot create user', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::User);

    actingAs($user)
        ->get(route('users.create'))
        ->assertRedirect(route('home'))
        ->assertSessionHas('error', 'This action is unauthorized.');
});

test('super admin can delete a user', function (): void {
    $superAdmin = createUser(role: RoleName::SuperAdmin);

    assertTrue($superAdmin->hasRole(RoleName::SuperAdmin));

    $user = createUser();

    actingAs($superAdmin)
        ->from(route('users.index'))
        ->delete(route('users.destroy', $user))
        ->assertRedirect(route('users.index'))
        ->assertSessionHas('success', 'User deleted successfully.');
});

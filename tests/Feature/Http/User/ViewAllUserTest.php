<?php

declare(strict_types=1);

use App\Enums\RoleName;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;

beforeEach(function (): void {
    $this->endpoint = route('users.index');
});

test('super admin can view all users', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::SuperAdmin);

    User::factory()->count(3)->create();

    actingAs($user)
        ->get($this->endpoint)
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page): AssertableInertia => $page
                ->component('User/IndexPage')
                ->has('users', 4)
                ->where('users.0.id', $user->id)
                ->where('users.0.name', $user->name)
        );
});

test('non super admin cannot view all users', function (): void {
    $user = createUser();

    actingAs($user)
        ->get($this->endpoint)
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error', 'This action is unauthorized.');
});

test('admin cannot view all users', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::Admin);

    actingAs($user)
        ->get($this->endpoint)
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error', 'This action is unauthorized.');
});

test('user cannot view all users', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::User);

    actingAs($user)
        ->get($this->endpoint)
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error', 'This action is unauthorized.');
});

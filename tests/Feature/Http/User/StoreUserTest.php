<?php

declare(strict_types=1);

use App\Enums\RoleName;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('super admin can store new user', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::SuperAdmin);

    assertDatabaseCount('users', 1);

    $newUserEmail = 'johndoe@example.com';

    actingAs($user)
        ->post(route('users.store'), [
            'name' => 'John Doe',
            'email' => $newUserEmail,
            'password' => 'password',
        ])
        ->assertRedirect(route('users.index'))
        ->assertSessionHas('success', 'User created successfully.');

    assertDatabaseCount('users', 2);
    assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => $newUserEmail,
    ]);

    $createdUser = User::where('email', $newUserEmail)->firstOrFail();

    $this->assertTrue(Hash::check('password', $createdUser->password));
});

test('admin cannot store new user', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::Admin);

    actingAs($user)
        ->post(route('users.store'), [
            'name' => 'Jammie Fox',
            'email' => 'jamfox@example.com',
            'password' => 'password',
        ])
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error', 'This action is unauthorized.');

    assertDatabaseCount('users', 1);
    assertDatabaseMissing('users', [
        'name' => 'Jammie Fox',
        'email' => 'jamfox@example.com',
    ]);
});

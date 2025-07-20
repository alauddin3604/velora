<?php

declare(strict_types=1);

use App\Enums\RoleName;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

test('super admin can store new user', function (): void {
    $user = createUser();

    $user->assignRole(RoleName::SuperAdmin);

    assertDatabaseCount('users', 1);

    actingAs($user)
        ->post(route('users.store'), [
            'name' => 'John Doe',
            'email' => 'a9a0F@example.com',
            'password' => 'password',
        ])
        ->assertRedirect(route('users.index'))
        ->assertSessionHas('success', 'User created successfully.');

    assertDatabaseCount('users', 2);
    assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'a9a0F@example.com',
    ]);

    $createdUser = User::where('email', 'a9a0F@example.com')->firstOrFail();

    $this->assertTrue(Hash::check('password', $createdUser->password));
});

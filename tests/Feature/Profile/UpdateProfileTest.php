<?php

declare(strict_types=1);

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertNotTrue;
use function PHPUnit\Framework\assertTrue;

it('can update profile', function (): void {
    $user = createUser([
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    actingAs($user)
        ->put('/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])
        ->assertRedirectBack()
        ->assertSessionHas('success', 'Your profile has been updated.');

    assertTrue($user->wasChanged('name'));

    assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
});

it('cannot update profile with invalid data', function (): void {
    $user = createUser([
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    actingAs($user)
        ->put('/profile', [
            'name' => '',
        ])
        ->assertRedirectBack()
        ->assertInvalid([
            'name' => 'The name field is required',
        ]);

    assertNotTrue($user->wasChanged('name'));
});

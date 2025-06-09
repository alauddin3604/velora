<?php

declare(strict_types=1);

use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Exceptions;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertEquals;

it('can login', function (): void {
    $user = createUser([
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    post('/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ])
        ->assertRedirect(route('dashboard'));

    assertAuthenticatedAs($user);
    assertEquals($user->id, Auth::id(), 'Auth::id() should return the authenticated user ID.');
});

it('cannot login with invalid credentials', function (): void {
    Exceptions::fake();

    post('/login', [
        'email' => 'test@example.com',
        'password' => 'invalid-password',
    ])
        ->assertRedirectBack()
        ->assertSessionHas('error', 'Invalid email or password.');

    assertGuest();

    Exceptions::assertReported(LoginException::class);
});

it('cannot login with missing credentials', function (): void {
    post('/login', [])
        ->assertRedirectBack()
        ->assertInvalid([
            'email' => 'The email field is required.',
            'password' => 'The password field is required.',
        ]);
});

it('cannot login with invalid email', function (): void {
    post('/login', [
        'email' => 'invalid-email',
        'password' => 'password',
    ])
        ->assertRedirectBack()
        ->assertInvalid([
            'email' => 'The email field must be a valid email address',
        ]);
});

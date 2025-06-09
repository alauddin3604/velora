<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;

it('can logout', function (): void {
    $initialSessionId = session()->getId();

    $user = createUser();

    $this
        ->actingAs($user)
        ->assertAuthenticatedAs($user)
        ->post('/logout')
        ->assertRedirect(route('login'));

    $this->assertGuest();
    $this->assertNotEquals($initialSessionId, session()->getId(), 'Session ID should have changed.');
    $this->assertFalse(Auth::check(), 'Auth::check() should return false.');
    $this->assertNull(Auth::user(), 'Auth::user() should return null.');
});

it('cannot logout when not authenticated', function (): void {
    $this->assertGuest();
    $this->assertNull(Auth::user(), 'Auth::user() should return null.');

    $this
        ->post('/logout')
        ->assertRedirect(route('login'));
});

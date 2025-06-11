<?php

declare(strict_types=1);

use Spatie\Permission\Models\Role;

describe('user has roles', function (): void {
    test('can assign role to user', function (): void {
        $user = createUser();

        $role = Role::create(['name' => 'admin']);

        $user->assignRole($role);

        expect($user->hasRole($role))->toBeTrue();
    });

    test('can remove role from user', function (): void {
        $user = createUser();

        $role = Role::create(['name' => 'admin']);

        $user->assignRole($role);

        $user->removeRole($role);

        expect($user->hasRole($role))->toBeFalse();
    });

    test('can assign multiple roles to user', function (): void {
        $user = createUser();

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $user->assignRole([$adminRole, $userRole]);

        expect($user->hasRole($adminRole))->toBeTrue();
        expect($user->hasRole($userRole))->toBeTrue();
    });

    test('can sync roles to user', function (): void {
        $user = createUser();

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $user->assignRole([$adminRole, $userRole]);

        $user->syncRoles($adminRole);

        expect($user->hasRole($adminRole))->toBeTrue();
        expect($user->hasRole($userRole))->toBeFalse();
    });
});

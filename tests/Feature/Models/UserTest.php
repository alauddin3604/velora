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

        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);

        $user->assignRole([$role1, $role2]);

        expect($user->hasRole($role1))->toBeTrue();
        expect($user->hasRole($role2))->toBeTrue();
    });

    test('can sync roles to user', function (): void {
        $user = createUser();

        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);

        $user->assignRole([$role1, $role2]);

        $user->syncRoles($role1);

        expect($user->hasRole($role1))->toBeTrue();
        expect($user->hasRole($role2))->toBeFalse();
    });
});

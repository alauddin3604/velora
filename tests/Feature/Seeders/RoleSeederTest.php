<?php

declare(strict_types=1);

use App\Enums\Permission\UserPermission;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

beforeEach(function (): void {
    DB::table('roles')->truncate();
    DB::table('permissions')->truncate();
    DB::table('role_has_permissions')->truncate();
});

test('can run RoleAndPermissionSeeder', function (): void {
    assertDatabaseEmpty('roles');
    assertDatabaseEmpty('permissions');
    assertDatabaseEmpty('role_has_permissions');

    artisan('db:seed', ['--class' => RoleAndPermissionSeeder::class])
        ->assertSuccessful();

    assertDatabaseCount('roles', 3);
    assertDatabaseCount('permissions', 6);

    $superAdminRole = Role::findByName('super_admin');
    $adminRole = Role::findByName('admin');
    $user = Role::findByName('user');

    assertTrue($superAdminRole->hasPermissionTo(UserPermission::ViewAny));
    assertTrue($superAdminRole->hasPermissionTo(UserPermission::View));
    assertTrue($superAdminRole->hasPermissionTo(UserPermission::Create));
    assertTrue($superAdminRole->hasPermissionTo(UserPermission::Update));
    assertTrue($superAdminRole->hasPermissionTo(UserPermission::Delete));

    assertFalse($adminRole->hasPermissionTo(UserPermission::ViewAny));
    assertFalse($adminRole->hasPermissionTo(UserPermission::View));
    assertFalse($adminRole->hasPermissionTo(UserPermission::Create));
    assertFalse($adminRole->hasPermissionTo(UserPermission::Update));
    assertFalse($adminRole->hasPermissionTo(UserPermission::Delete));

    assertFalse($user->hasPermissionTo(UserPermission::ViewAny));
    assertFalse($user->hasPermissionTo(UserPermission::View));
    assertFalse($user->hasPermissionTo(UserPermission::Create));
    assertFalse($user->hasPermissionTo(UserPermission::Update));
    assertFalse($user->hasPermissionTo(UserPermission::Delete));
});

test('can upsert when running RoleAndPermissionSeeder multiple times', function (): void {
    assertDatabaseEmpty('roles');

    artisan('db:seed', ['--class' => RoleAndPermissionSeeder::class])
        ->assertSuccessful();

    assertDatabaseCount('roles', 3);

    artisan('db:seed', ['--class' => RoleAndPermissionSeeder::class])
        ->assertSuccessful();

    assertDatabaseCount('roles', 3);
});

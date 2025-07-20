<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Permission\UserPermission;
use App\Enums\RoleName;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

final class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = RoleName::cases();

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role->value,
            ]);
        }

        $permissions = array_merge(
            UserPermission::cases(),
        );

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'name' => $permission->value,
            ]);
        }

        $this->syncPermissions();
    }

    private function syncPermissions(): void
    {
        $roles = Role::all();

        $roles->each(function (Role $role): void {
            switch ($role->name) {
                case RoleName::SuperAdmin->value:
                    $role->syncPermissions(UserPermission::cases());
                    break;
                default:
                    break;
            }
        });
    }
}

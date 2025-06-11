<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

final class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::cases();

        $data = [];

        foreach ($roles as $role) {
            $data[] = [
                'name' => $role->name,
                'guard_name' => 'web',
            ];
        }

        ModelsRole::query()->upsert($data, ['name', 'guard_name']);
    }
}

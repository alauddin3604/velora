<?php

declare(strict_types=1);

use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;

beforeEach(function (): void {
    DB::table('roles')->truncate();
});

test('can run RoleSeeder', function (): void {
    assertDatabaseEmpty('roles');

    artisan('db:seed', ['--class' => RoleSeeder::class])
        ->assertSuccessful();

    assertDatabaseCount('roles', 2);
});

test('can upsert when running RoleSeeder multiple times', function (): void {
    assertDatabaseEmpty('roles');

    artisan('db:seed', ['--class' => RoleSeeder::class])
        ->assertSuccessful();

    assertDatabaseCount('roles', 2);

    artisan('db:seed', ['--class' => RoleSeeder::class])
        ->assertSuccessful();

    assertDatabaseCount('roles', 2);
});

<?php

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;

beforeEach(function () {
    $superAdminRole = Role::query()->create(['name' => 'super_admin']);
    Role::query()->create(['name' => 'pracownik']);
    Role::query()->create(['name' => 'redaktor']);

    collect(['ViewAny', 'View', 'Create', 'Update', 'Delete'])->each(function (string $action) use ($superAdminRole): void {
        $permission = Permission::query()->create([
            'name' => $action.':User',
            'guard_name' => 'web',
        ]);

        $superAdminRole->givePermissionTo($permission);
    });

    $user = User::factory()->create();
    $user->assignRole('super_admin');
    actingAs($user);
});

test('it can list users on the resource', function () {
    get('/panel/users')->assertOk();
});

test('it can create a user with role assignment', function () {
    $user = User::factory()->create([
        'name' => 'Nowy Pracownik',
        'email' => 'pracownik@example.com',
    ]);

    $user->syncRoles(['pracownik']);

    assertDatabaseHas('users', [
        'name' => 'Nowy Pracownik',
        'email' => 'pracownik@example.com',
    ]);

    expect($user->hasRole('pracownik'))->toBeTrue();
});

test('it can edit a user and change role', function () {
    $user = User::factory()->create();
    $user->assignRole('redaktor');

    $user->update([
        'name' => 'Zmienione Imię',
    ]);
    $user->syncRoles(['pracownik']);

    assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Zmienione Imię',
    ]);

    expect($user->fresh()?->hasRole('pracownik'))->toBeTrue();
    expect($user->fresh()?->hasRole('redaktor'))->toBeFalse();
});

test('it blocks user listing without permission', function () {
    $userWithoutPermission = User::factory()->create();
    $userWithoutPermission->assignRole('redaktor');

    actingAs($userWithoutPermission)
        ->get('/panel/users')
        ->assertForbidden();
});

<?php

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\assertDatabaseHas;

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

    $this->user = User::factory()->create();
    $this->user->assignRole('super_admin');
    $this->actingAs($this->user);
});

test('it can list users on the resource', function () {
    $this->get('/admin/users')->assertOk();
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

    $this->actingAs($userWithoutPermission)
        ->get('/admin/users')
        ->assertForbidden();
});

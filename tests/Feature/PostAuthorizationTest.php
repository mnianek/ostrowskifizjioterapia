<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

function grantPostCrudPermissions(Role $role): void
{
    collect([
        'ViewAny:Post',
        'View:Post',
        'Create:Post',
        'Update:Post',
    ])->each(function (string $name) use ($role): void {
        $permission = Permission::query()->firstOrCreate([
            'name' => $name,
            'guard_name' => 'web',
        ]);

        $role->givePermissionTo($permission);
    });
}

it('requires authentication for post create and edit pages in panel', function () {
    $category = Category::query()->create(['name' => 'Rehabilitacja']);

    $post = Post::query()->create([
        'category_id' => $category->id,
        'title' => 'Wpis chroniony',
        'slug' => 'wpis-chroniony',
        'content' => 'Tresci testowe wpisu.',
        'author' => 'Admin',
        'status' => 'draft',
        'is_published' => false,
    ]);

    get('/panel/posts/create')->assertRedirect('/panel/login');
    get('/panel/posts/'.$post->id.'/edit')->assertRedirect('/panel/login');
});

it('returns forbidden for panel user without post permissions', function () {
    $role = Role::query()->firstOrCreate(['name' => 'panel_user']);

    /** @var User $user */
    $user = User::factory()->create();
    $user->assignRole($role);

    $category = Category::query()->create(['name' => 'Neurologia']);

    $post = Post::query()->create([
        'category_id' => $category->id,
        'title' => 'Wpis bez uprawnien',
        'slug' => 'wpis-bez-uprawnien',
        'content' => 'Tresci testowe wpisu.',
        'author' => 'Admin',
        'status' => 'draft',
        'is_published' => false,
    ]);

    actingAs($user)->get('/panel/posts')->assertForbidden();
    actingAs($user)->get('/panel/posts/create')->assertForbidden();
    actingAs($user)->get('/panel/posts/'.$post->id.'/edit')->assertForbidden();
});

it('allows users with post permissions to create edit and publish content', function () {
    $role = Role::query()->firstOrCreate(['name' => 'redaktor']);
    grantPostCrudPermissions($role);

    /** @var User $user */
    $user = User::factory()->create();
    $user->assignRole($role);

    $category = Category::query()->create(['name' => 'Ortopedia']);

    $post = Post::query()->create([
        'category_id' => $category->id,
        'title' => 'Wpis redaktora',
        'slug' => 'wpis-redaktora',
        'content' => 'Tresci testowe wpisu.',
        'author' => 'Admin',
        'status' => 'draft',
        'is_published' => false,
    ]);

    actingAs($user)->get('/panel/posts')->assertOk();
    actingAs($user)->get('/panel/posts/create')->assertOk();
    actingAs($user)->get('/panel/posts/'.$post->id.'/edit')->assertOk();

    // Publikacja wpisu opiera sie o uprawnienie Update:Post.
    expect($user->can('Update:Post'))->toBeTrue();
    expect($user->can('update', $post))->toBeTrue();
});

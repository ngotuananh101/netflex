<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    /**
     * Seed the permission and roles.
     */
    public function seedPermissionsAndRoles(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * Create permissions.
         */
        // super admin permissions
        Permission::create(['name' => 'admin']);
        // admin permissions
        Permission::create(['name' => 'admin.access']);
        // common
        Permission::create(['name' => 'roles.view']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.update']);
        Permission::create(['name' => 'roles.delete']);

        Permission::create(['name' => 'custom_pages.view']);
        Permission::create(['name' => 'custom_pages.create']);
        Permission::create(['name' => 'custom_pages.update']);
        Permission::create(['name' => 'custom_pages.delete']);

        Permission::create(['name' => 'users.view']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.delete']);

        Permission::create(['name' => 'settings.view']);
        Permission::create(['name' => 'settings.update']);

        Permission::create(['name' => 'plans.view']);
        Permission::create(['name' => 'plans.create']);
        Permission::create(['name' => 'plans.update']);
        Permission::create(['name' => 'plans.delete']);

        Permission::create(['name' => 'subscriptions.view']);
        Permission::create(['name' => 'subscriptions.create']);
        Permission::create(['name' => 'subscriptions.update']);
        Permission::create(['name' => 'subscriptions.delete']);

        Permission::create(['name' => 'invoices.view']);
        Permission::create(['name' => 'invoices.create']);
        Permission::create(['name' => 'invoices.update']);
        Permission::create(['name' => 'invoices.delete']);

        Permission::create(['name' => 'payments.view']);
        Permission::create(['name' => 'payments.create']);
        Permission::create(['name' => 'payments.update']);
        Permission::create(['name' => 'payments.delete']);

        Permission::create(['name' => 'tags.view']);
        Permission::create(['name' => 'tags.create']);
        Permission::create(['name' => 'tags.update']);
        Permission::create(['name' => 'tags.delete']);

        Permission::create(['name' => 'titles.view']);
        Permission::create(['name' => 'titles.create']);
        Permission::create(['name' => 'titles.update']);
        Permission::create(['name' => 'titles.delete']);

        Permission::create(['name' => 'genres.view']);
        Permission::create(['name' => 'genres.create']);
        Permission::create(['name' => 'genres.update']);
        Permission::create(['name' => 'genres.delete']);

        Permission::create(['name' => 'videos.rate']);
        Permission::create(['name' => 'videos.view']);
        Permission::create(['name' => 'videos.create']);
        Permission::create(['name' => 'videos.update']);
        Permission::create(['name' => 'videos.delete']);
    }
}

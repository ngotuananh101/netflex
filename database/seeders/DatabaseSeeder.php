<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Plan;
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

        $this->seedPermissionsAndRoles();
        $this->seedPlans();
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
        // Admin
        Permission::create(['name' => 'admin.super']); // Super admin permission
        Permission::create(['name' => 'admin.access']); // Access admin panel
        Permission::create(['name' => 'admin.update']); // Update admin settings
        Permission::create(['name' => 'admin.report']); // View report admin

        // Pages
        Permission::create(['name' => 'pages.view']);
        Permission::create(['name' => 'pages.create']);
        Permission::create(['name' => 'pages.update']);
        Permission::create(['name' => 'pages.delete']);

        // Invoices
        Permission::create(['name' => 'invoices.view']);

        // News
        Permission::create(['name' => 'news.view']);
        Permission::create(['name' => 'news.create']);
        Permission::create(['name' => 'news.update']);
        Permission::create(['name' => 'news.delete']);

        // People
        Permission::create(['name' => 'people.view']);
        Permission::create(['name' => 'people.create']);
        Permission::create(['name' => 'people.update']);
        Permission::create(['name' => 'people.delete']);

        // Plans
        Permission::create(['name' => 'plans.view']);
        Permission::create(['name' => 'plans.create']);
        Permission::create(['name' => 'plans.update']);
        Permission::create(['name' => 'plans.delete']);

        // Reviews
        Permission::create(['name' => 'reviews.view']);
        Permission::create(['name' => 'reviews.create']);
        Permission::create(['name' => 'reviews.update']);
        Permission::create(['name' => 'reviews.delete']);

        // Roles
        Permission::create(['name' => 'roles.view']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.update']);
        Permission::create(['name' => 'roles.delete']);

        // Settings
        Permission::create(['name' => 'settings.view']);
        Permission::create(['name' => 'settings.update']);

        // Tags
        Permission::create(['name' => 'tags.view']);
        Permission::create(['name' => 'tags.create']);
        Permission::create(['name' => 'tags.update']);
        Permission::create(['name' => 'tags.delete']);

        // Titles
        Permission::create(['name' => 'titles.view']);
        Permission::create(['name' => 'titles.create']);
        Permission::create(['name' => 'titles.update']);
        Permission::create(['name' => 'titles.delete']);

        // Users
        Permission::create(['name' => 'users.view']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.delete']);

        // Videos
        Permission::create(['name' => 'videos.view']);
        Permission::create(['name' => 'videos.create']);
        Permission::create(['name' => 'videos.update']);
        Permission::create(['name' => 'videos.delete']);
        Permission::create(['name' => 'videos.rate']);
        Permission::create(['name' => 'videos.play']);

        /**
         * Create permissions.
         */
        // Admin
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('admin.super');

        // User
        $user = Role::create(['name' => 'user', 'default' => true]);
        $user->givePermissionTo('pages.view');
        $user->givePermissionTo('invoices.view');
        $user->givePermissionTo('news.view');
        $user->givePermissionTo('people.view');
        $user->givePermissionTo('plans.view');
        $user->givePermissionTo('reviews.view');
        $user->givePermissionTo('settings.view');
        $user->givePermissionTo('tags.view');
        $user->givePermissionTo('titles.view');
        $user->givePermissionTo('users.view');
        $user->givePermissionTo('videos.view');
        $user->givePermissionTo('videos.rate');
        $user->givePermissionTo('videos.play');
    }

    /**
     * Seed the plan.
     */
    public function seedPlans(): void
    {
        // Seed plans
        $plans = [
            [
                'id' => 1, // Free plan
                'name' => 'Free',
                'price' => 0,
                'interval' => 'month',
                'interval_count' => 1,
                'sort_order' => 1,
                'currency' => 'USD',
                'description' => 'Free plan',
                'is_active' => 1,
                'is_recurring' => 1,
                'is_featured' => 0,
                'is_trial_plan' => 0,
                'trial_interval' => 'month',
                'trial_interval_count' => 1,
                'trial_period_days' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2, // Premium plan
                'name' => 'Premium',
                'price' => 9.99,
                'interval' => 'month',
                'interval_count' => 1,
                'sort_order' => 2,
                'currency' => 'USD',
                'description' => 'Premium plan',
                'is_active' => 1,
                'is_recurring' => 1,
                'is_featured' => 1,
                'is_trial_plan' => 0,
                'trial_interval' => 'month',
                'trial_interval_count' => 1,
                'trial_period_days' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}

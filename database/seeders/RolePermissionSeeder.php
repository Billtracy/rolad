<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define Roles
        $roles = [
            ['name' => 'Super Admin', 'slug' => 'super-admin'],
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Agent', 'slug' => 'agent'],
            ['name' => 'User', 'slug' => 'user'],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate(['slug' => $roleData['slug']], $roleData);
        }

        // Define Permissions
        $permissions = [
            ['name' => 'View Dashboard', 'slug' => 'view_dashboard'],
            ['name' => 'Manage Properties', 'slug' => 'manage_properties'],
            ['name' => 'Manage Clients', 'slug' => 'manage_clients'],
            ['name' => 'Manage Affiliates', 'slug' => 'manage_affiliates'],
            ['name' => 'Manage Transactions', 'slug' => 'manage_transactions'],
            ['name' => 'Manage Content', 'slug' => 'manage_content'],
            ['name' => 'Manage Settings', 'slug' => 'manage_settings'],
        ];

        foreach ($permissions as $permissionData) {
            Permission::firstOrCreate(['slug' => $permissionData['slug']], $permissionData);
        }

        // Assign Permissions to Roles
        $superAdmin = Role::where('slug', 'super-admin')->first();
        $admin = Role::where('slug', 'admin')->first();
        $agent = Role::where('slug', 'agent')->first();

        $allPermissions = Permission::all();
        $superAdmin->permissions()->sync($allPermissions);

        // Admin has most permissions except maybe some settings (optional, but giving all for now or restriction)
        // Let's give Admin all except maybe high level system settings if we had them.
        // For now, let's give Admin everything too, or restricted.
        // User asked for "Super admin ... power to do everything".
        // Let's duplicate for Admin for now, or maybe restrict Settings.
        $adminPermissions = $allPermissions->filter(function($p) {
             return $p->slug !== 'manage_settings';
        });
        $admin->permissions()->sync($adminPermissions);

        // Agent permissions (example)
        $agentPermissions = Permission::whereIn('slug', ['view_dashboard', 'manage_properties'])->get();
        $agent->permissions()->sync($agentPermissions);

        // Create Super Admin User
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@rolad.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'role_id' => $superAdmin->id,
                'email_verified_at' => now(),
            ]
        );

        // Ensure role is set if user existed
        if ($superAdminUser->role_id !== $superAdmin->id) {
             $superAdminUser->update(['role_id' => $superAdmin->id]);
        }
    }
}

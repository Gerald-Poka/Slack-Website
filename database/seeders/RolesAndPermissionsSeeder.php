<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Auth\Models\Role;
use App\Modules\Auth\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $roles = [
            ['id' => 1, 'name' => 'super_admin', 'guard_name' => 'web', 'display_name' => 'Super Administrator', 'description' => 'Full unrestricted access to all platform features.'],
            ['id' => 2, 'name' => 'admin',       'guard_name' => 'web', 'display_name' => 'Administrator',       'description' => 'Site configuration, theme management, user management.'],
            ['id' => 3, 'name' => 'editor',      'guard_name' => 'web', 'display_name' => 'Editor',              'description' => 'Create, edit, and publish content across the platform.'],
            ['id' => 4, 'name' => 'contributor', 'guard_name' => 'web', 'display_name' => 'Contributor',         'description' => 'Create and edit own content. Requires editor approval.'],
            ['id' => 5, 'name' => 'viewer',      'guard_name' => 'web', 'display_name' => 'Viewer',              'description' => 'Read-only access to admin panel.'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }

        // Permissions
        $permissions = [
            // Theme
            ['name' => 'theme.view',        'guard_name' => 'web', 'group' => 'themes',   'display_name' => 'View Themes'],
            ['name' => 'theme.create',      'guard_name' => 'web', 'group' => 'themes',   'display_name' => 'Create Themes'],
            ['name' => 'theme.edit',        'guard_name' => 'web', 'group' => 'themes',   'display_name' => 'Edit Theme Settings'],
            ['name' => 'theme.delete',      'guard_name' => 'web', 'group' => 'themes',   'display_name' => 'Delete Themes'],
            ['name' => 'theme.activate',    'guard_name' => 'web', 'group' => 'themes',   'display_name' => 'Activate Theme'],
            // Pages
            ['name' => 'page.view',         'guard_name' => 'web', 'group' => 'pages',    'display_name' => 'View Pages'],
            ['name' => 'page.create',       'guard_name' => 'web', 'group' => 'pages',    'display_name' => 'Create Pages'],
            ['name' => 'page.edit',         'guard_name' => 'web', 'group' => 'pages',    'display_name' => 'Edit Pages'],
            ['name' => 'page.delete',       'guard_name' => 'web', 'group' => 'pages',    'display_name' => 'Delete Pages'],
            ['name' => 'page.publish',      'guard_name' => 'web', 'group' => 'pages',    'display_name' => 'Publish Pages'],
            // Content
            ['name' => 'content.view',      'guard_name' => 'web', 'group' => 'content',  'display_name' => 'View Content'],
            ['name' => 'content.create',    'guard_name' => 'web', 'group' => 'content',  'display_name' => 'Create Content'],
            ['name' => 'content.edit',      'guard_name' => 'web', 'group' => 'content',  'display_name' => 'Edit Content'],
            ['name' => 'content.delete',    'guard_name' => 'web', 'group' => 'content',  'display_name' => 'Delete Content'],
            ['name' => 'content.publish',   'guard_name' => 'web', 'group' => 'content',  'display_name' => 'Publish Content'],
            // Media
            ['name' => 'media.view',        'guard_name' => 'web', 'group' => 'media',    'display_name' => 'View Media Library'],
            ['name' => 'media.upload',      'guard_name' => 'web', 'group' => 'media',    'display_name' => 'Upload Media'],
            ['name' => 'media.delete',      'guard_name' => 'web', 'group' => 'media',    'display_name' => 'Delete Media'],
            // Settings
            ['name' => 'settings.view',     'guard_name' => 'web', 'group' => 'settings', 'display_name' => 'View Settings'],
            ['name' => 'settings.edit',     'guard_name' => 'web', 'group' => 'settings', 'display_name' => 'Edit Settings'],
            ['name' => 'settings.system',   'guard_name' => 'web', 'group' => 'settings', 'display_name' => 'Edit System Settings'],
            // Users
            ['name' => 'users.view',        'guard_name' => 'web', 'group' => 'users',    'display_name' => 'View Users'],
            ['name' => 'users.create',      'guard_name' => 'web', 'group' => 'users',    'display_name' => 'Create Users'],
            ['name' => 'users.edit',        'guard_name' => 'web', 'group' => 'users',    'display_name' => 'Edit Users'],
            ['name' => 'users.delete',      'guard_name' => 'web', 'group' => 'users',    'display_name' => 'Delete Users'],
            ['name' => 'users.assign_roles','guard_name' => 'web', 'group' => 'users',    'display_name' => 'Assign Roles'],
            // Navigation
            ['name' => 'nav.view',          'guard_name' => 'web', 'group' => 'navigation','display_name' => 'View Navigation Menus'],
            ['name' => 'nav.edit',          'guard_name' => 'web', 'group' => 'navigation','display_name' => 'Edit Navigation Menus'],
            // Plugins
            ['name' => 'plugins.view',      'guard_name' => 'web', 'group' => 'plugins',  'display_name' => 'View Plugins'],
            ['name' => 'plugins.manage',    'guard_name' => 'web', 'group' => 'plugins',  'display_name' => 'Install/Activate Plugins'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name'], 'guard_name' => $permission['guard_name']], $permission);
        }

        // Assign all permissions to super_admin
        $superAdmin = Role::find(1);
        $superAdmin->syncPermissions(Permission::all());

        // Assign standard admin permissions
        $admin = Role::find(2);
        $admin->syncPermissions(Permission::whereNotIn('name', ['settings.system', 'plugins.manage', 'users.delete'])->get());

        // Assign editor permissions
        $editor = Role::find(3);
        $editor->syncPermissions(Permission::whereIn('group', ['pages', 'content', 'media', 'navigation'])
            ->whereNotIn('name', ['page.delete'])
            ->get());

        // Assign contributor permissions
        $contributor = Role::find(4);
        $contributor->syncPermissions(Permission::whereIn('name', ['page.view', 'page.create', 'page.edit', 'content.view', 'content.create', 'content.edit', 'media.view', 'media.upload'])->get());

        // Assign viewer permissions
        $viewer = Role::find(5);
        $viewer->syncPermissions(Permission::where('name', 'like', '%.view')->get());
    }
}

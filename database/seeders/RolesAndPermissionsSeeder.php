<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Seed the application's roles and permissions.
     */
    public function run(): void
    {
        // Limpiar caché de roles y permisos
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Permisos base del módulo de usuarios
        $permissions = [
            // Usuarios
            'users.create',
            'users.read',
            'users.update',
            'users.delete',

            // Roles
            'roles.create',
            'roles.read',
            'roles.update',
            'roles.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Roles base
        $superAdmin = Role::firstOrCreate([
            'name' => 'super admin',
            'guard_name' => 'web',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $user = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        // El Super Admin tiene todos los permisos
        $superAdmin->syncPermissions(Permission::all());

        $admin->syncPermissions([
            'users.create',
            'users.read',
            'users.update',
            'users.delete',

            'roles.create',
            'roles.read',
            'roles.update',
            'roles.delete',
        ]);

        // El rol User inicia sin permisos.
        // Conforme se creen nuevos módulos se le podrán asignar.
        $user->syncPermissions([]);
    }
}

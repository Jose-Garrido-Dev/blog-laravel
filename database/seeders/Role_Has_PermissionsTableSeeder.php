<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Role_Has_PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::find(1); // ID del rol Admin
        $permission = Permission::find(1); // ID del permiso acceso dashboard
        $role->givePermissionTo($permission);

        $role = Role::find(2); // ID del rol Blogger
        $permission = Permission::find(1); // ID del permiso acceso dashboard
        $role->givePermissionTo($permission);

        $role = Role::find(1); // ID del rol Admin
        $permission = Permission::find(2); // ID del permiso acceso categorias
        $role->givePermissionTo($permission);

        $role = Role::find(1); // ID del rol Admin
        $permission = Permission::find(3); // ID del permiso acceso articulos
        $role->givePermissionTo($permission);

        $role = Role::find(2); // ID del rol Blogger
        $permission = Permission::find(3); // ID del permiso acceso articulos
        $role->givePermissionTo($permission);

        $role = Role::find(1); // ID del rol Admin
        $permission = Permission::find(4); // ID del permiso acceso roles
        $role->givePermissionTo($permission);

        $role = Role::find(1); // ID del rol Admin
        $permission = Permission::find(5); // ID del permiso acceso permisos
        $role->givePermissionTo($permission);

        $role = Role::find(1); // ID del rol Admin
        $permission = Permission::find(6); // ID del permiso acceso usuarios
        $role->givePermissionTo($permission);
    }
}

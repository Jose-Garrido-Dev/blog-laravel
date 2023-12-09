<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'acceso dashboard',
                'guard_name' => 'web',
            ],
            [
                'name' => 'acceso categorias',
                'guard_name' => 'web',
            ],
            [
                'name' => 'acceso articulos',
                'guard_name' => 'web',
            ],
            [
                'name' => 'acceso roles',
                'guard_name' => 'web',
            ],
            [
                'name' => 'acceso permisos',
                'guard_name' => 'web',
            ],
            [
                'name' => 'acceso usuarios',
                'guard_name' => 'web',
            ],
            // Puedes agregar más permisos aquí si es necesario
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}

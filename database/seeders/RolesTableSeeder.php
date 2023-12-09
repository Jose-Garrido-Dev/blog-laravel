<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Blogger',
                'guard_name' => 'web',
            ],
            // Puedes agregar más roles aquí si es necesario
        ];
    
        foreach ($roles as $role) {
            Role::create($role);
        }
    
    }
}

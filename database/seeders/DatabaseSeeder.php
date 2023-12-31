<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'user X',
            'email' => 'admin@bytewise.com',
            'password' => bcrypt('12345678')
        ]);

        \App\Models\User::factory(5)->create();
        \App\Models\Category::factory(4)->create();
        \App\Models\Post::factory(15)->create();

        $this->call(TagSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(Role_Has_PermissionsTableSeeder::class);
        
    }
}

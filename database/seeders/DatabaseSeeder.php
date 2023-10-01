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
            'name' => 'José Garrido Silva',
            'email' => 'r4gnarc0de@gmail.com',
            'password' => bcrypt('gs992017')
        ]);

        \App\Models\User::factory(20)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Post::factory(100)->create();

        $this->call(TagSeeder::class);
    }
}

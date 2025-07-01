<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Safely create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'is_admin' => true
            ]
        );

        // Create 3 regular users if they don't exist
        if (User::count() <= 1) { // Only seed if admin is the only user
            User::factory(3)->create();
        }

        // Seed default application data
        $this->call([
            StatusesTableSeeder::class,
            GroupSeeder::class,
            TaskComplexitiesTableSeeder::class,
            TaskSeeder::class,
            
        ]);
    }
}
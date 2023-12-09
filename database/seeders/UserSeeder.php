<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adding a super admin user for the purpose of testing all modules
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        // Adding an admin user
        User::factory()->create([
            'email' => 'admin@example.com',
        ]);

        // Adding a PUPUK admin user
        User::factory()->create([
            'email' => 'pupuk@example.com',
        ]);

        // Adding a kiosk participant user
        User::factory()->create([
            'email' => 'participant@example.com',
        ]);

        // Adding a technical team user
        User::factory()->create([
            'email' => 'technical@example.com',
        ]);

        // Adding an FK bursary user
        User::factory()->create([
            'email' => 'bursary@example.com',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create user for Jayson Bogs Ramos
        $user = User::updateOrCreate([
            'email' => 'jaysonbogs.ramos@example.com',
        ], [
            'name' => 'Jayson Bogs Ramos',
            'password' => 'password123',
            'avatar' => 'avatar.png', // Place avatar.png in public/images/
        ]);

        // No profile creation needed since avatar is on users table
    }
}

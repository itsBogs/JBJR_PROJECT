<?php

namespace Database\Seeders;

use App\Models\UserAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserAccount::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'username' => 'admin',
                'password' => 'password123',
                'role' => 'admin',
                'is_active' => true,
                'must_change_password' => false,
            ]
        );

        UserAccount::updateOrCreate(
            ['email' => 'profcamus@gmail.com'],
            [
                'username' => 'profcamus',
                'password' => 'naps123',
                'role' => 'teacher',
                'is_active' => true,
                'must_change_password' => true,
            ]
        );

        UserAccount::updateOrCreate(
            ['email' => 'student@example.com'],
            [
                'username' => 'student1',
                'password' => 'student123',
                'role' => 'student',
                'is_active' => true,
                'must_change_password' => true,
            ]
        );
    }
}

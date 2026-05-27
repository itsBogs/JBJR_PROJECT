<?php

namespace Database\Seeders;

use App\Models\Degree;
use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Database\Seeder;

class SampleStudentSeeder extends Seeder
{
    public function run(): void
    {
        $degree = Degree::firstOrCreate([
            'degree_title' => 'Bachelor of Science in Information Technology',
        ]);

        $userAccount = UserAccount::where('username', 'jaysonramos')
            ->orWhere('email', 'jayson.bogs.jimenez.ramos@example.com')
            ->first() ?? new UserAccount();

        $userAccount->fill([
            'username' => 'jaysonramos',
            'email' => 'jayson.bogs.jimenez.ramos@example.com',
            'password' => 'student123',
            'role' => 'student',
            'is_active' => true,
            'must_change_password' => false,
            'avatar' => 'images/logo.png',
        ])->save();

        Student::updateOrCreate(
            ['user_account_id' => $userAccount->id],
            [
                'first_name' => 'Jayson',
                'middle_name' => 'Bogs Jimenez',
                'last_name' => 'Ramos',
                'address' => 'Dagupan City, Pangasinan',
                'contact_number' => '09171234567',
                'degree_id' => $degree->id,
            ]
        );
    }
}

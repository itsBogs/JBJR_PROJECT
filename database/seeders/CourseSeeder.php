<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ['course_code' => 'ELEC1', 'course_name' => 'Elective 1', 'description' => 'Default course: Elective 1'],
            ['course_code' => 'ELEC2', 'course_name' => 'Elective 2', 'description' => 'Default course: Elective 2'],
            ['course_code' => 'ELEC3', 'course_name' => 'Elective 3', 'description' => 'Default course: Elective 3'],
            ['course_code' => 'ELEC4', 'course_name' => 'Elective 4', 'description' => 'Default course: Elective 4'],
            ['course_code' => 'ELEC5', 'course_name' => 'Elective 5', 'description' => 'Default course: Elective 5'],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                ['course_code' => $course['course_code']],
                $course
            );
        }
    }
}

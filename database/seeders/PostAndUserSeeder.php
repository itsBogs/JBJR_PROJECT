<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Get student 1 (the one used in PagesController methods)
        $student = Student::first();
        
        if (!$student) {
            return;
        }

        // 2. Create sample posts for this student
        $posts = [
            ['title' => 'First Post', 'content' => 'Hello this is my first post as a student.'],
            ['title' => 'Laravel Learning', 'content' => 'I am currently enjoying learning Laravel and Eloquent relationships.'],
            ['title' => 'Campus Life', 'content' => 'Study hard, play hard. This is the life!']
        ];

        foreach($posts as $postData) {
            Post::updateOrCreate(
                ['student_id' => $student->id, 'title' => $postData['title']],
                $postData
            );
        }
    }
}

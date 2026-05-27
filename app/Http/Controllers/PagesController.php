<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Post;

class PagesController extends Controller
{
    public function  about () {
        $a = 3;
        $b = 5;
        $sum = $a + $b;
        return "Sum is: ".$sum;
    }

    public function userProfile() {
       $user = Student::find(1);
       if (!$user) {
           return "Student not found.";
       }
       echo ($user->fname ?? $user->first_name) . " - " . ($user->profile->bio ?? 'No bio');
    }  
    
    public function userPosts() {
        $user = Student::find(1);
        if (!$user) {
            return "Student not found.";
        }
        
        $fname = $user->fname ?? $user->first_name;
        
        if (!isset($user->posts) || $user->posts->isEmpty()) {
            return "No posts found for this student.";
        }
        
        $output = "Posts by ".$fname.":<br>";
        foreach($user->posts as $post) {
            $output .= $fname.": ".$post->title." - ".$post->content."<br>";
        }
        return $output;
    }  
    
    public function studentCourses() {
        $student = Student::find(1);
        if (!$student) {
            return "Student not found.";
        }
        
        $fname = $student->fname ?? $student->first_name;
        $lname = $student->lname ?? $student->last_name;

        if (!isset($student->courses) || $student->courses->isEmpty()) {
            return "No courses found.";
        }

        foreach($student->courses as $course) {
            echo $fname . " " . $lname . " is enrolled in: " . $course->course_name . "<br>";
        }

    }

    public function maintenace()
    {
        return $this->renderAjaxOrView('maintenance');
    }
  
}



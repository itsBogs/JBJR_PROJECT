<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Degree;
use App\Models\Post;
use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'teacher' => redirect()->route('teacher.dashboard'),
            default => redirect()->route('student.dashboard'),
        };
    }

    public function student()
    {
        $student = Auth::user()->student;
        $courseCount = Course::count();
        $degreeCount = Degree::count();

        return $this->renderAjaxOrView('dashboards.student', [
            'title' => 'Student Dashboard',
            'student' => $student,
            'courseCount' => $courseCount,
            'degreeCount' => $degreeCount
        ]);
    }

    public function teacher()
    {
        $studentCount = Student::count();
        $courseCount = Course::count();
        $postCount = Post::count();
        
        $recentStudents = Student::with('degree')->latest()->take(5)->get();
        $students = Student::with(['degree'])
            ->latest()
            ->take(10)
            ->get();

        return $this->renderAjaxOrView('dashboards.teacher', [
            'title' => 'Teacher Dashboard',
            'studentCount' => $studentCount,
            'courseCount' => $courseCount,
            'postCount' => $postCount,
            'recentStudents' => $recentStudents,
            'students' => $students
        ]);
    }

    public function admin()
    {
        $studentCount = Student::count();
        $teacherCount = UserAccount::where('role', 'teacher')->count();
        $userCount = UserAccount::count();
        $courseCount = Course::count();
        
        $teachers = UserAccount::where('role', 'teacher')
            ->latest()
            ->take(5)
            ->get();
            
        $students = Student::with(['degree'])
            ->latest()
            ->take(5)
            ->get();

        return $this->renderAjaxOrView('dashboards.admin', [
            'title' => 'Admin Dashboard',
            'studentCount' => $studentCount,
            'teacherCount' => $teacherCount,
            'userCount' => $userCount,
            'courseCount' => $courseCount,
            'teachers' => $teachers,
            'students' => $students
        ]);
    }
}

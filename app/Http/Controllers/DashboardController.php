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
        $student = Auth::user()->student?->load('degree');
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
        $students = Student::with(['degree', 'userAccount'])
            ->latest()
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
        $adminCount = UserAccount::where('role', 'admin')->count();
        $userCount = UserAccount::count();
        $courseCount = Course::count();
        $degreeCount = Degree::count();
        $teachers = UserAccount::where('role', 'teacher')
            ->latest()
            ->get();
        $students = Student::with(['degree', 'userAccount'])
            ->latest()
            ->get();

        return $this->renderAjaxOrView('dashboards.admin', [
            'title' => 'Admin Dashboard',
            'studentCount' => $studentCount,
            'teacherCount' => $teacherCount,
            'adminCount' => $adminCount,
            'userCount' => $userCount,
            'courseCount' => $courseCount,
            'degreeCount' => $degreeCount,
            'teachers' => $teachers,
            'students' => $students
        ]);
    }
}

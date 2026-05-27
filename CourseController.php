<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('students')->latest()->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses',
            'description' => 'nullable|string',
        ]);

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function enrollView(Course $course = null)
    {
        $courses = Course::all();
        $students = Student::all();
        $selectedCourse = $course;
        return view('courses.enroll', compact('courses', 'students', 'selectedCourse'));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $course = Course::findOrFail($request->course_id);

        if ($course->students()->where('student_id', $request->student_id)->exists()) {
            return back()->with('error', 'Student is already enrolled in this course.');
        }

        $course->students()->attach($request->student_id);

        return redirect()->route('courses.index')->with('success', 'Student enrolled successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}

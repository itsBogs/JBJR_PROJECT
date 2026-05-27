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
        return $this->renderAjaxOrView('courses.index', compact('courses'));
    }

    public function create()
    {
        return $this->renderAjaxOrView('courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses',
            'description' => 'nullable|string',
        ]);

        Course::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Course created successfully.',
                'redirect' => route('admin.dashboard')
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Course created successfully.');
    }

    public function enrollView(Course $course = null)
    {
        $courses = Course::all();
        $students = Student::all();
        $selectedCourse = $course;
        return $this->renderAjaxOrView('courses.enroll', compact('courses', 'students', 'selectedCourse'));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $course = Course::findOrFail($request->course_id);

        if ($course->students()->where('student_id', $request->student_id)->exists()) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Student is already enrolled in this course.'], 422);
            }
            return back()->with('error', 'Student is already enrolled in this course.');
        }

        $course->students()->attach($request->student_id);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Student enrolled successfully.',
                'redirect' => route('courses.index')
            ]);
        }

        return redirect()->route('courses.index')->with('success', 'Student enrolled successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Course deleted successfully.',
                'redirect' => route('courses.index')
            ]);
        }

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function show(Course $course)
    {
        // Load students enrolled in this course
        $course->load('students');
        return $this->renderAjaxOrView('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return $this->renderAjaxOrView('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses,course_code,' . $course->id,
            'description' => 'nullable|string',
        ]);

        $course->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Course updated successfully.',
                'redirect' => route('courses.index')
            ]);
        }

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }
}

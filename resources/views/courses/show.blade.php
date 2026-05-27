@extends('format.studentLayout')

@section('title', 'Course Details')

@section('content')
<div class="panel">
    <h2>Course: {{ $course->course_name }} ({{ $course->course_code }})</h2>
    <p>{{ $course->description }}</p>

    <h3>Enrolled Students</h3>
    @if ($course->students->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->email_address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No students enrolled in this course yet.</p>
    @endif
    <div style="margin-top: 20px;">
        <a href="{{ route('courses.index') }}" class="btn btn-primary" style="text-decoration:none;">Back to Courses</a>
    </div>
</div>
@endsection

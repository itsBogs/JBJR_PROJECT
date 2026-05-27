@extends('format.studentLayout')

@section('title', 'Courses')

@section('content')
<div class="panel" data-live-refresh="true" data-refresh-interval="4000">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;">
        <div>
            <h2 style="margin:0;">Courses</h2>
            <p style="margin:4px 0 0;color:#475569;">Manage courses and enroll students.</p>
        </div>
        <div style="display:flex;gap:10px;">
            @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'teacher'], true))
                <a href="{{ route('courses.enroll.view') }}" style="background:#2563eb;color:#fff;padding:10px 14px;border-radius:8px;font-weight:700;text-decoration:none;">Enroll a Student</a>
            @endif
            @if(Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('courses.create') }}" style="background:#0f172a;color:#fff;padding:10px 14px;border-radius:8px;font-weight:700;text-decoration:none;">+ Add Course</a>
            @endif
        </div>
    </div>

    @if (session('success'))
        <div style="margin-top:12px;margin-bottom:12px;color:#166534;background:#dcfce7;border:1px solid #bbf7d0;padding:10px 12px;border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($courses->count() === 0)
        <p style="margin:16px 0 0;color:#64748b;">No courses yet. Add one to get started.</p>
    @else
        <div style="overflow-x:auto;margin-top:12px;">
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Course Name</th>
                        <th>Students Enrolled</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->course_code }}</td>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->students_count }}</td>
                            <td style="display:flex;gap:8px;align-items:center;">
                                <a href="{{ route('courses.show', $course) }}" style="color:#2563eb;font-weight:600;text-decoration:underline;">View</a>
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                    <a href="{{ route('courses.edit', $course) }}" style="color:#059669;font-weight:600;text-decoration:underline;">Edit</a>
                                    <form action="{{ route('courses.destroy', $course) }}" method="POST" data-confirm="Delete this course?" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:none;border:none;color:#dc2626;font-weight:600;cursor:pointer;padding:0;">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

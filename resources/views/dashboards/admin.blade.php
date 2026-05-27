@extends('format.studentLayout')

@section('title', 'Admin Dashboard')

@section('content')
<div data-live-refresh="true" data-refresh-interval="10000" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; align-items: start;">
    <!-- Panel 1: Overview -->
    <div class="panel" style="margin-bottom:0; height: 100%;">
        <h2 style="margin:0;">Dashboard Overview</h2>
        <p style="margin:6px 0 0;color:#475569;">Full system management access.</p>

        <div style="display:grid;grid-template-columns: 1fr;gap:12px;margin-top:16px;">
            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:12px;background:#f8faff;">
                <div style="color:#64748b;font-weight:700;font-size:0.85rem;">Teachers</div>
                <div style="font-size:1.8rem;font-weight:800;color:#0f172a;margin-top:2px;">{{ $teacherCount }}</div>
            </div>
            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:12px;background:#f8faff;">
                <div style="color:#64748b;font-weight:700;font-size:0.85rem;">Students</div>
                <div style="font-size:1.8rem;font-weight:800;color:#0f172a;margin-top:2px;">{{ $studentCount }}</div>
            </div>
            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:12px;background:#f8faff;">
                <div style="color:#64748b;font-weight:700;font-size:0.85rem;">Courses</div>
                <div style="font-size:1.8rem;font-weight:800;color:#0f172a;margin-top:2px;">{{ $courseCount }}</div>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:10px;margin-top:20px;">
            <a href="{{ route('courses.create') }}" style="background:#047857;color:#fff;padding:10px;border-radius:8px;font-weight:700;text-decoration:none;text-align:center;font-size:0.9rem;">+ New Course</a>
            <a href="{{ route('students.create') }}" style="background:#2563eb;color:#fff;padding:10px;border-radius:8px;font-weight:700;text-decoration:none;text-align:center;font-size:0.9rem;">+ New Student</a>
            <a href="{{ route('users.create') }}" style="background:#0f172a;color:#fff;padding:10px;border-radius:8px;font-weight:700;text-decoration:none;text-align:center;font-size:0.9rem;">+ New Teacher</a>
        </div>
    </div>

    <!-- Panel 2: Teacher List -->
    <div class="panel" style="margin-bottom:0; height: 100%;">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h2 style="margin:0;">Teachers</h2>
            <a href="{{ route('users.index') }}" style="color:#2563eb;font-weight:700;text-decoration:none;font-size:0.85rem;">Manage</a>
        </div>

        @if($teachers->count() === 0)
            <p style="margin:16px 0 0;color:#64748b;">No teachers registered.</p>
        @else
            <div style="overflow-x:auto;margin-top:14px;">
                <table style="font-size:0.85rem;">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers->take(8) as $teacher)
                            <tr>
                                <td>
                                    <div style="font-weight:700;color:#0f172a;">{{ $teacher->username }}</div>
                                    <div style="font-size:0.75rem;color:#64748b;">{{ $teacher->email }}</div>
                                </td>
                                <td><span style="color:{{ $teacher->is_active ? '#059669' : '#dc2626' }};font-weight:700;">{{ $teacher->is_active ? 'Active' : 'Off' }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Panel 3: Student List -->
    <div class="panel" style="margin-bottom:0; height: 100%;">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h2 style="margin:0;">Students</h2>
            <a href="{{ route('students.create') }}" style="color:#2563eb;font-weight:700;text-decoration:none;font-size:0.85rem;">Enroll</a>
        </div>

        @if($students->count() === 0)
            <p style="margin:16px 0 0;color:#64748b;">No students found.</p>
        @else
            <div style="overflow-x:auto;margin-top:14px;">
                <table style="font-size:0.85rem;">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Degree</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students->take(8) as $student)
                            <tr>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" style="text-decoration:none;color:#0f172a;font-weight:700;">
                                        {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                                    </a>
                                </td>
                                <td style="color:#64748b;">{{ $student->degree?->degree_title ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

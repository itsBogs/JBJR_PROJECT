@extends('format.studentLayout')

@section('title', 'Teacher Dashboard')

@section('content')
<!-- Teacher Profile Section -->
<div class="panel" style="margin-bottom: 20px; display: flex; align-items: center; gap: 20px;">
    @php
        $avatarPath = auth()->user()->avatar;
        $avatarUrl = $avatarPath
            ? (str_starts_with($avatarPath, 'images/') ? asset($avatarPath) : asset('storage/' . $avatarPath))
            : null;
    @endphp
    <div style="flex-shrink: 0;">
        @if($avatarUrl)
            <img src="{{ $avatarUrl }}" alt="Profile" style="width:70px;height:70px;border-radius:50%;object-fit:cover;border:2px solid var(--psu-blue);">
        @else
            <div style="width:70px;height:70px;border-radius:50%;background:#eef3ff;color:#64748b;display:flex;align-items:center;justify-content:center;font-size:1.8rem;border:2px solid var(--psu-blue);">
                <i class="fa-solid fa-user-tie"></i>
            </div>
        @endif
    </div>
    <div style="flex-grow: 1;">
        <h2 style="margin:0; font-size: 1.5rem;">Welcome, {{ auth()->user()->username }}!</h2>
        <p style="margin:4px 0 0; color:#475569; font-weight: 500;">
            <i class="fa-solid fa-envelope" style="margin-right: 5px;"></i> {{ auth()->user()->email }} | 
            <span style="text-transform: capitalize; background: #dcfce7; color: #14532d; padding: 2px 8px; border-radius: 12px; font-size: 0.85rem;">{{ auth()->user()->role }}</span>
        </p>
    </div>
    <div style="flex-shrink: 0;">
        <a href="{{ route('password.change') }}" style="color:var(--psu-blue); text-decoration:none; font-weight:700; font-size: 0.9rem;">
            <i class="fa-solid fa-key"></i> Change Password
        </a>
    </div>
</div>

<div data-live-refresh="true" data-refresh-interval="4000" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; align-items: start;">
    <!-- Panel 1: Overview and Actions -->
    <div class="panel" style="margin-bottom:0; height: 100%;">
        <h2 style="margin:0;">Management</h2>
        <p style="margin:6px 0 0;color:#475569;">Tools for student records.</p>

        <div style="display:grid;grid-template-columns: 1fr;gap:12px;margin-top:16px;">
            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:12px;background:#f8faff;">
                <div style="color:#64748b;font-weight:700;font-size:0.85rem;">Registered Students</div>
                <div style="font-size:1.8rem;font-weight:800;color:#0f172a;margin-top:2px;">{{ $studentCount }}</div>
            </div>
            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:12px;background:#f8faff;">
                <div style="color:#64748b;font-weight:700;font-size:0.85rem;">Active Courses</div>
                <div style="font-size:1.8rem;font-weight:800;color:#0f172a;margin-top:2px;">{{ $courseCount }}</div>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:10px;margin-top:20px;">
            <a href="{{ route('students.create') }}" style="background:#2563eb;color:#fff;padding:10px;border-radius:8px;font-weight:700;text-decoration:none;text-align:center;font-size:0.9rem;">+ Enroll Student</a>
            <a href="{{ route('courses.enroll.view') }}" style="background:#047857;color:#fff;padding:10px;border-radius:8px;font-weight:700;text-decoration:none;text-align:center;font-size:0.9rem;">Course Enrollment</a>
            <a href="{{ route('students.index') }}" style="background:#e2e8f0;color:#0f172a;padding:10px;border-radius:8px;font-weight:700;text-decoration:none;text-align:center;font-size:0.9rem;">Student List</a>
        </div>
    </div>

    <!-- Panel 2: Recent Activity / Summary -->
    <div class="panel" style="margin-bottom:0; height: 100%;">
        <h2 style="margin:0;">Recent Summary</h2>
        <p style="margin:4px 0 10px;color:#475569;">Latest student updates.</p>
        <ul style="margin:0;padding-left:18px;font-size:0.9rem;">
            @forelse($recentStudents->take(10) as $student)
                <li style="margin:10px 0;">
                    <div style="font-weight:700;color:#0f172a;">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</div>
                    <div style="font-size:0.75rem;color:#64748b;">{{ $student->degree?->degree_title ?? 'No degree' }}</div>
                </li>
            @empty
                <li style="color:#64748b;">No recent activity.</li>
            @endforelse
        </ul>
    </div>

    <!-- Panel 3: Full Student List -->
    <div class="panel" style="margin-bottom:0; height: 100%;">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h2 style="margin:0;">Students Quickview</h2>
            <a href="{{ route('students.index') }}" style="color:#2563eb;font-weight:700;text-decoration:none;font-size:0.85rem;">View All</a>
        </div>

        @if($students->count() === 0)
            <p style="margin:16px 0 0;color:#64748b;">No students found.</p>
        @else
            <div style="overflow-x:auto;margin-top:14px;">
                <table style="font-size:0.85rem;">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students->take(10) as $student)
                            <tr>
                                <td>
                                    <div style="font-weight:700;">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</div>
                                </td>
                                <td style="color:#64748b;">{{ $student->contact_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

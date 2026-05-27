@extends('format.studentLayout')

@section('title', 'Student Dashboard')

@section('content')
<div data-live-refresh="true" data-refresh-interval="10000" style="display: grid; grid-template-columns: 1fr; gap: 20px;">
    <!-- Panel 1: Overview -->
    <div class="panel">
        <h2 style="margin:0;">Student Dashboard</h2>
        <p style="margin:6px 0 0;color:#475569;">View-only access for student accounts.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:16px;">
            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:16px;">
                <div style="color:#64748b;font-weight:700;">Degrees Available</div>
                <div style="font-size:2rem;font-weight:800;color:#0f172a;margin-top:6px;">{{ $degreeCount }}</div>
            </div>
            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:16px;">
                <div style="color:#64748b;font-weight:700;">Courses Available</div>
                <div style="font-size:2rem;font-weight:800;color:#0f172a;margin-top:6px;">{{ $courseCount }}</div>
            </div>
        </div>
    </div>

    <!-- Panel 2: My Profile -->
    <div class="panel">
        <h3 style="margin-top:0;">My Profile Information</h3>
        @if($student)
            <div style="display:flex;align-items:center;gap:16px;">
                @php
                    $avatarPath = auth()->user()->avatar;
                    $avatarUrl = $avatarPath
                        ? (str_starts_with($avatarPath, 'images/') ? asset($avatarPath) : asset('storage/' . $avatarPath))
                        : null;
                @endphp
                @if($avatarUrl)
                    <img src="{{ $avatarUrl }}" alt="Profile" style="width:64px;height:64px;border-radius:50%;object-fit:cover;">
                @else
                    <div style="width:64px;height:64px;border-radius:50%;background:#eef3ff;color:#64748b;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                @endif
                <div>
                    <h4 style="margin:0;">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</h4>
                    <p style="margin:4px 0 0;color:#475569;">{{ $student->degree?->degree_title ?? 'No degree assigned' }}</p>
                </div>
            </div>
            <div style="margin-top:16px;">
                <a href="{{ route('students.show', $student) }}" style="background:#2563eb;color:#fff;padding:10px 14px;border-radius:8px;font-weight:700;text-decoration:none;">View Full Profile</a>
            </div>
        @else
            <p style="margin:0;color:#64748b;">No linked student profile yet.</p>
        @endif
    </div>

    <!-- Panel 3: Quick Links or System Notice -->
    <div class="panel">
        <h3 style="margin-top:0;">Navigation & Help</h3>
        <p style="margin:4px 0 10px;color:#475569;">Quickly navigate to different parts of the platform.</p>
        <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <a href="{{ route('courses.index') }}" style="background:#f1f5f9;color:#0f172a;padding:8px 12px;border-radius:6px;text-decoration:none;font-weight:600;border:1px solid #e2e8f0;">Browse Courses</a>
            <a href="{{ route('posts.index') }}" style="background:#f1f5f9;color:#0f172a;padding:8px 12px;border-radius:6px;text-decoration:none;font-weight:600;border:1px solid #e2e8f0;">Announcements</a>
        </div>
    </div>
</div>
@endsection
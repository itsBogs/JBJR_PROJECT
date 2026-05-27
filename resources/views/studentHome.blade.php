@extends('format.studentLayout')

@section('title', 'Student Home')

@push('styles')
<style>
	.student-list-table {
		min-width: 1400px;
	}

	.student-list-table th,
	.student-list-table td {
		white-space: nowrap;
	}
</style>
@endpush

@section('content')
<div data-live-refresh="true" data-refresh-interval="10000" style="display: grid; grid-template-columns: 1fr; gap: 20px;">
    <!-- Panel 1: Overview -->
    <div class="panel">
        <h2 style="margin:0;">Dashboard Overview</h2>
        <p style="margin:6px 0 0;color:#475569;">Quick view of your records and shortcuts.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;margin-top:14px;">
            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:14px;background:#ffffff;">
                <div style="color:#64748b;font-weight:700;letter-spacing:0.02em;">Total Degrees</div>
                <div style="font-size:1.9rem;font-weight:800;color:#0f172a;margin-top:6px;">{{ $degrees->count() }}</div>
                <div style="margin-top:10px;">
                    @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'teacher'], true))
                        <a href="{{ route('degrees.create') }}" style="color:#2563eb;font-weight:700;text-decoration:none;">Add a new degree</a>
                    @endif
                </div>
            </div>

            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:14px;background:#ffffff;">
                <div style="color:#64748b;font-weight:700;letter-spacing:0.02em;">Total Students</div>
                <div style="font-size:1.9rem;font-weight:800;color:#0f172a;margin-top:6px;">{{ $students->count() }}</div>
                <div style="margin-top:10px;">
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <a href="{{ route('students.create') }}" style="color:#2563eb;font-weight:700;text-decoration:none;">Enroll a student</a>
                    @endif
                </div>
            </div>

            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:14px;background:#ffffff;">
                <div style="color:#64748b;font-weight:700;letter-spacing:0.02em;">Activity Logs</div>
                <div style="font-size:1.1rem;font-weight:800;color:#0f172a;margin-top:6px;">Track edits and deletes</div>
                <div style="margin-top:10px;">
                    <a href="{{ route('students.activity-logs') }}" style="color:#2563eb;font-weight:700;text-decoration:none;">Open activity logs</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel 2: Degree List -->
    <div class="panel">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;">
            <div>
                <h2 style="margin:0;">Degree List</h2>
                <p style="margin:4px 0 0;color:#475569;">Manage degrees and assign them to students.</p>
            </div>
            @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'teacher'], true))
                <a href="{{ route('degrees.create') }}" style="background:#0f172a;color:#fff;padding:10px 14px;border-radius:8px;font-weight:700;text-decoration:none;">+ Add Degree</a>
            @endif
        </div>

        @if (session('success') && session('source') !== 'students')
            <div style="margin-top:12px;margin-bottom:12px;color:#166534;background:#dcfce7;border:1px solid #bbf7d0;padding:10px 12px;border-radius:8px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($degrees->count() === 0)
            <p style="margin:16px 0 0;color:#64748b;">No degrees yet.</p>
        @else
            <div style="overflow-x:auto;margin-top:12px;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Degree Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($degrees as $degree)
                            <tr>
                                <td>{{ $degree->id }}</td>
                                <td>{{ $degree->degree_title }}</td>
                                <td style="display:flex;gap:8px;align-items:center;">
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <a href="{{ route('degrees.show', $degree) }}" style="color:#0f172a;font-weight:600;">View</a>
                                        <a href="{{ route('degrees.edit', $degree) }}" style="color:#2563eb;font-weight:600;">Edit</a>
                                        <form action="{{ route('degrees.destroy', $degree) }}" method="POST" data-confirm="Delete this degree?" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:none;border:none;color:#dc2626;font-weight:600;cursor:pointer;padding:0;">Delete</button>
                                        </form>
                                    @else
                                        <span style="color:#64748b;font-weight:600;">View only</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Panel 3: Student List -->
    <div class="panel">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;">
            <div>
                <h2 style="margin:0;">Student List</h2>
                <p style="margin:4px 0 0;color:#475569;">Add, view, edit, or remove students from the database.</p>
            </div>
            @if(Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('students.create') }}" style="background:#2563eb;color:#fff;padding:10px 14px;border-radius:8px;font-weight:700;text-decoration:none;">+ Add Student</a>
            @endif
        </div>

        @if (session('success') && session('source') === 'students')
            <div style="margin-top:12px;margin-bottom:12px;color:#166534;background:#dcfce7;border:1px solid #bbf7d0;padding:10px 12px;border-radius:8px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($students->count() === 0)
            <p style="margin:16px 0 0;color:#64748b;">No students yet.</p>
        @else
            <div style="overflow-x:auto;margin-top:12px;">
                <table class="student-list-table">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Degree</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            @php
                                $avatarPath = $student->userAccount?->avatar;
                                $avatarUrl = $avatarPath
                                    ? (str_starts_with($avatarPath, 'images/') ? asset($avatarPath) : asset('storage/' . $avatarPath))
                                    : null;
                            @endphp
                            <tr>
                                <td>
                                    @if($avatarUrl)
                                        <img src="{{ $avatarUrl }}" alt="Profile" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                                    @else
                                        <div style="width:40px;height:40px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#64748b;">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->degree?->degree_title ?? '—' }}</td>
                                <td>{{ $student->userAccount?->email ?? '-' }}</td>
                                <td>{{ $student->contact_number }}</td>
                                <td style="display:flex;gap:10px;align-items:center;">
                                    <a href="{{ route('students.show', $student) }}" style="color:#0f172a;font-weight:600;">View</a>
                                    @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'teacher'], true))
                                        <a href="{{ route('students.edit', $student) }}" style="color:#2563eb;font-weight:600;">Edit</a>
                                        <form action="{{ route('students.destroy', $student) }}" method="POST" data-confirm="Delete this student?" style="margin:0;">
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
</div>
@endsection





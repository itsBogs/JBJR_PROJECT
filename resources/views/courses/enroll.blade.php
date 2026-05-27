@extends('format.studentLayout')

@section('title', 'Enroll Student')

@section('content')
<div class="panel">
    <h2 style="margin:0;">Student Enrollment</h2>
    <p style="margin:6px 0 20px;color:#475569;">Select a course and a student to complete the enrollment.</p>

    @if (session('error'))
        <div style="margin-bottom:12px;color:#991b1b;background:#fee2e2;border:1px solid #fecaca;padding:10px 12px;border-radius:8px;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('courses.enroll') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="course_id">Select Course</label>
            <select name="course_id" id="course_id" required>
                <option value="">-- Choose Course --</option>
                @foreach ($courses as $c)
                    <option value="{{ $c->id }}" {{ (isset($selectedCourse) && $selectedCourse->id == $c->id) ? 'selected' : '' }}>
                        {{ $c->course_code }} - {{ $c->course_name }}
                    </option>
                @endforeach
            </select>
            @error('course_id') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="student_id">Select Student</label>
            <select name="student_id" id="student_id" required>
                <option value="">-- Choose Student --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }} ({{ $student->email_address }})
                    </option>
                @endforeach
            </select>
            @error('student_id') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-top:20px;">
            <button type="submit" class="btn btn-primary" style="padding:12px 24px;">Confirm Enrollment</button>
            <a href="{{ route('courses.index') }}" style="margin-left:12px;color:#64748b;font-weight:600;text-decoration:none;">Cancel</a>
        </div>
    </form>
</div>
@endsection

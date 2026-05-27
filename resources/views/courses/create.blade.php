@extends('format.studentLayout')

@section('title', 'Add Course')

@section('content')
<div class="panel">
    <h2 style="margin:0;">Add New Course</h2>
    <p style="margin:6px 0 20px;color:#475569;">Fill in the details to create a new course.</p>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="course_code">Course Code</label>
            <input type="text" name="course_code" id="course_code" required placeholder="e.g. COMP101">
            @error('course_code') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" name="course_name" id="course_name" required placeholder="e.g. Introduction to Computing">
            @error('course_name') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea name="description" id="description" rows="3"></textarea>
            @error('description') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-top:20px;">
            <button type="submit" class="btn btn-primary" style="padding:12px 24px;">Create Course</button>
            <a href="{{ route('dashboard') }}" style="margin-left:12px;color:#64748b;font-weight:600;text-decoration:none;">Cancel</a>
        </div>
    </form>
</div>
@endsection

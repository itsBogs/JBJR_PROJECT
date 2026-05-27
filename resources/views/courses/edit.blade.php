@extends(auth()->user()->role === 'student' ? 'format.studentLayout' : (auth()->user()->role === 'teacher' ? 'format.studentLayout' : 'format.studentLayout'))

@section('content')
<div class="row items-center justify-between" style="margin-bottom: 2rem;">
    <h1 style="font-size: 1.875rem; font-weight: 700; color: #1e293b;">Edit Course</h1>
    <a href="{{ route('courses.index') }}" class="btn-primary" style="background: #64748b;">Back to List</a>
</div>

<div style="background: white; padding: 2rem; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 600px;">
    <form action="{{ route('courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Course Code</label>
            <input type="text" name="course_code" value="{{ old('course_code', $course->course_code) }}" 
                style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 8px;" required>
            @error('course_code') <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Course Name</label>
            <input type="text" name="course_name" value="{{ old('course_name', $course->course_name) }}" 
                style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 8px;" required>
            @error('course_name') <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Description</label>
            <textarea name="description" rows="4" 
                style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 8px;">{{ old('description', $course->description) }}</textarea>
            @error('description') <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; padding: 0.75rem; font-size: 1rem;">Update Course</button>
    </form>
</div>
@endsection
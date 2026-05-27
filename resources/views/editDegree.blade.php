@extends('format.studentLayout')

@section('title', 'Edit Degree')

@section('content')
<div class="panel">
	<h2>Edit Degree</h2>

	@if ($errors->any())
		<div style="margin-bottom:12px;color:#b91c1c;background:#fee2e2;border:1px solid #fecdd3;padding:10px 12px;border-radius:8px;">
			<ul style="margin:0;padding-left:18px;">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form method="POST" action="{{ route('degrees.update', $degree) }}">
		@csrf
		@method('PUT')
		<div style="margin-bottom:12px;">
			<label for="degree_title" style="display:block;font-weight:600;margin-bottom:6px;">Degree Title</label>
			<input id="degree_title" name="degree_title" type="text" value="{{ old('degree_title', $degree->degree_title) }}" required style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:8px;">
		</div>

		<button type="submit" style="background:#0f172a;color:#fff;padding:10px 16px;border:none;border-radius:8px;font-weight:700;cursor:pointer;">Update Degree</button>
		<a href="{{ route('dashboard') }}" style="color:#2563eb;font-weight:600;">Cancel</a>
	</form>
</div>
@endsection

@extends('format.studentLayout')

@section('title', 'Edit Student')

@push('styles')
<style>
	.edit-student-panel {
		max-width: 1120px;
		margin: 0 auto;
	}

	.edit-student-form {
		display: grid;
		grid-template-columns: repeat(2, minmax(280px, 1fr));
		gap: 14px 18px;
		align-items: start;
	}

	.edit-student-field {
		margin-bottom: 0;
	}

	.edit-student-field label {
		display: block;
		font-weight: 600;
		margin-bottom: 6px;
	}

	.edit-student-field input,
	.edit-student-field select,
	.edit-student-field textarea {
		width: 100%;
		padding: 10px;
		border: 1px solid #cbd5e1;
		border-radius: 8px;
		font: inherit;
	}

	.edit-student-field--full {
		grid-column: 1 / -1;
	}

	.edit-student-actions {
		grid-column: 1 / -1;
		display: flex;
		align-items: center;
		gap: 10px;
		flex-wrap: wrap;
	}

	@media (max-width: 860px) {
		.edit-student-form {
			grid-template-columns: 1fr;
		}

		.edit-student-field--full,
		.edit-student-actions {
			grid-column: auto;
		}
	}
</style>
@endpush

@section('content')
<div class="panel edit-student-panel">
	<h2>Edit Student</h2>


	<form method="POST" action="{{ route('students.update', $student) }}" class="edit-student-form" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		@php
			$avatarPath = $student->userAccount?->avatar;
			$avatarUrl = $avatarPath
				? (str_starts_with($avatarPath, 'images/') ? asset($avatarPath) : asset('storage/' . $avatarPath))
				: null;
		@endphp
		<div class="edit-student-field edit-student-field--full" style="display:flex;flex-direction:column;align-items:center;margin-bottom:20px;">
			<label for="avatar" style="font-weight:700;color:var(--psu-blue-dark);">Update Profile Image</label>
			<div style="width:120px;height:120px;border-radius:50%;border:3px dashed var(--psu-blue);background:#f8fafc;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:10px;">
				@if($avatarUrl)
					<img id="avatar-preview" src="{{ $avatarUrl }}" alt="Profile Preview" style="width:100%;height:100%;object-fit:cover;">
					<i class="fa-solid fa-user" id="avatar-icon" style="display:none;font-size:3rem;color:#cbd5e1;"></i>
				@else
					<img id="avatar-preview" src="#" alt="Profile Preview" style="display:none;width:100%;height:100%;object-fit:cover;">
					<i class="fa-solid fa-user" id="avatar-icon" style="font-size:3rem;color:#cbd5e1;"></i>
				@endif
			</div>
			<input type="file" id="avatar" name="avatar" accept="image/*" style="max-width:250px;border:none;padding:0;" onchange="previewImage(event)">
			@if ($errors->has('avatar'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('avatar') }}</div>
			@endif
		</div>

		<div class="edit-student-field">
			<label for="first_name">First Name</label>
			<input id="first_name" name="first_name" type="text" value="{{ old('first_name', $student->first_name) }}">
			@if ($errors->has('first_name'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('first_name') }}</div>
			@endif
		</div>

		<div class="edit-student-field">
			<label for="middle_name">Middle Name (optional)</label>
			<input id="middle_name" name="middle_name" type="text" value="{{ old('middle_name', $student->middle_name) }}">
			@if ($errors->has('middle_name'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('middle_name') }}</div>
			@endif
		</div>

		<div class="edit-student-field">
			<label for="last_name">Last Name</label>
			<input id="last_name" name="last_name" type="text" value="{{ old('last_name', $student->last_name) }}">
			@if ($errors->has('last_name'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('last_name') }}</div>
			@endif
		</div>

		<div class="edit-student-field">
			<label for="email_address">Email Address</label>
			<input id="email_address" name="email_address" type="email" value="{{ old('email_address', $student->userAccount?->email) }}">
			@if ($errors->has('email_address'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('email_address') }}</div>
			@endif
		</div>

		<div class="edit-student-field">
			<label for="degree_id">Degree</label>
			<select id="degree_id" name="degree_id">
				<option value="">-- Select a Degree --</option>
				@foreach($degrees as $degree)
					<option value="{{ $degree->id }}" {{ (string) old('degree_id', $student->degree_id) === (string) $degree->id ? 'selected' : '' }}>{{ $degree->degree_title }}</option>
				@endforeach
			</select>
			@if ($errors->has('degree_id'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('degree_id') }}</div>
			@endif
		</div>

		<div class="edit-student-field">
			<label for="contact_number">Contact Number</label>
			<input id="contact_number" name="contact_number" type="text" value="{{ old('contact_number', $student->contact_number) }}" placeholder="09123456789">
			@if ($errors->has('contact_number'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('contact_number') }}</div>
			@endif
		</div>

		<div class="edit-student-field edit-student-field--full">
			<label for="address">Address</label>
			<textarea id="address" name="address" style="min-height:80px;">{{ old('address', $student->address) }}</textarea>
			@if ($errors->has('address'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('address') }}</div>
			@endif
		</div>
		<div class="edit-student-actions">
			<button type="submit" class="btn btn-primary">Update Student</button>
			<a href="{{ route('dashboard') }}" class="action-link">Cancel</a>
		</div>
		@if ($errors->any())
			<div style="margin-top:18px;color:#b91c1c;background:#fee2e2;border:1px solid #fecdd3;padding:10px 12px;border-radius:8px;">
				<ul style="margin:0;padding-left:18px;">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
	</form>
</div>
<script>
function previewImage(event) {
	const input = event.target;
	if (input.files && input.files[0]) {
		const reader = new FileReader();
		reader.onload = function(e) {
			const preview = document.getElementById('avatar-preview');
			const icon = document.getElementById('avatar-icon');

			preview.src = e.target.result;
			preview.style.display = 'block';
			icon.style.display = 'none';
		};
		reader.readAsDataURL(input.files[0]);
	}
}
</script>
@endsection

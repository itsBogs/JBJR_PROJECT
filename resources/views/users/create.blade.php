@extends('format.studentLayout')

@section('title', 'Add Teacher')

@push('styles')
<style>
	.add-teacher-panel {
		max-width: 1120px;
		margin: 0 auto;
	}

	.add-teacher-form {
		display: grid;
		grid-template-columns: repeat(2, minmax(280px, 1fr));
		gap: 14px 18px;
		align-items: start;
	}

	.add-teacher-field {
		margin-bottom: 0;
	}

	.add-teacher-field label {
		display: block;
		font-weight: 600;
		margin-bottom: 6px;
	}

	.add-teacher-field input {
		width: 100%;
		padding: 10px;
		border: 1px solid #cbd5e1;
		border-radius: 8px;
		font: inherit;
	}

	.add-teacher-field--full {
		grid-column: 1 / -1;
	}

	.add-teacher-actions {
		grid-column: 1 / -1;
		display: flex;
		align-items: center;
		gap: 10px;
		flex-wrap: wrap;
	}

	@media (max-width: 860px) {
		.add-teacher-form {
			grid-template-columns: 1fr;
		}

		.add-teacher-field--full,
		.add-teacher-actions {
			grid-column: auto;
		}
	}
</style>
@endpush

@section('content')
<div class="panel add-teacher-panel">
	<h2>Add Teacher</h2>
	<p style="margin:6px 0 20px;color:#475569;">Create a teacher account with profile image and login credentials.</p>

	<form action="{{ route('users.store') }}" method="POST" class="add-teacher-form" enctype="multipart/form-data">
		@csrf

		<div class="add-teacher-field add-teacher-field--full" style="display:flex;flex-direction:column;align-items:center;margin-bottom:20px;">
			<label for="avatar" style="font-weight:700;color:var(--psu-blue-dark);">Upload Profile Image</label>
			<div style="width:120px;height:120px;border-radius:50%;border:3px dashed var(--psu-blue);background:#f8fafc;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:10px;">
				<i class="fa-solid fa-user-tie" style="font-size:3rem;color:#cbd5e1;" id="avatar-icon"></i>
				<img id="avatar-preview" src="#" alt="Preview" style="display:none;width:100%;height:100%;object-fit:cover;">
			</div>
			<input type="file" id="avatar" name="avatar" accept="image/*" style="max-width:250px;border:none;padding:0;" onchange="previewImage(event)">
			@if ($errors->has('avatar'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('avatar') }}</div>
			@endif
		</div>

		<div class="add-teacher-field">
			<label for="username">Username</label>
			<input id="username" type="text" name="username" value="{{ old('username') }}" required>
			@if ($errors->has('username'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('username') }}</div>
			@endif
		</div>

		<div class="add-teacher-field">
			<label for="email">Email Address</label>
			<input id="email" type="email" name="email" value="{{ old('email') }}" required>
			@if ($errors->has('email'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('email') }}</div>
			@endif
		</div>

		<div class="add-teacher-field">
			<label for="password">Password</label>
			<input id="password" type="password" name="password" required>
			@if ($errors->has('password'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('password') }}</div>
			@endif
		</div>

		<div class="add-teacher-field">
			<label>Role</label>
			<input type="text" value="Teacher" disabled>
		</div>

		<div class="add-teacher-actions">
			<button type="submit" class="btn btn-primary">Save Teacher</button>
			<a href="{{ route('dashboard') }}" class="action-link">Cancel</a>
		</div>

		@if ($errors->any())
			<div class="add-teacher-field--full" style="margin-top:18px;color:#b91c1c;background:#fee2e2;border:1px solid #fecdd3;padding:10px 12px;border-radius:8px;">
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

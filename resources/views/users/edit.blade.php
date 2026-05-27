@extends('format.studentLayout')

@section('title', 'Edit User')

@push('styles')
<style>
	.edit-user-panel {
		max-width: 800px;
		margin: 0 auto;
	}

	.edit-user-form {
		display: grid;
		grid-template-columns: 1fr;
		gap: 18px;
	}

	.edit-user-field label {
		display: block;
		font-weight: 600;
		margin-bottom: 6px;
	}

	.edit-user-field input {
		width: 100%;
		padding: 10px;
		border: 1px solid #cbd5e1;
		border-radius: 8px;
		font: inherit;
	}

	.edit-user-actions {
		display: flex;
		align-items: center;
		gap: 10px;
		margin-top: 10px;
	}
</style>
@endpush

@section('content')
<div class="panel edit-user-panel">
	<h2>Edit User Account</h2>
	<p style="margin:6px 0 20px;color:#475569;">Update user profile information and account settings.</p>

	<form action="{{ route('users.update', $user) }}" method="POST" class="edit-user-form" enctype="multipart/form-data">
		@csrf
        @method('PUT')

		<div class="edit-user-field" style="display:flex;flex-direction:column;align-items:center;margin-bottom:10px;">
			<div style="width:100px;height:100px;border-radius:50%;border:3px solid var(--psu-blue);background:#f8fafc;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:10px;">
                @if($user->avatar)
				    <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar) }}" alt="Preview" style="width:100%;height:100%;object-fit:cover;">
                @else
                    <i class="fa-solid fa-user" style="font-size:2.5rem;color:#cbd5e1;" id="avatar-icon"></i>
                    <img id="avatar-preview" src="#" alt="Preview" style="display:none;width:100%;height:100%;object-fit:cover;">
                @endif
			</div>
			<input type="file" id="avatar" name="avatar" accept="image/*" style="max-width:250px;border:none;padding:0;" onchange="previewImage(event)">
			@if ($errors->has('avatar'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('avatar') }}</div>
			@endif
		</div>

		<div class="edit-user-field">
			<label for="username">Username</label>
			<input id="username" type="text" name="username" value="{{ old('username', $user->username) }}" required>
			@if ($errors->has('username'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('username') }}</div>
			@endif
		</div>

		<div class="edit-user-field">
			<label for="email">Email Address</label>
			<input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
			@if ($errors->has('email'))
				<div style="color:#b91c1c;font-size:13px;margin-top:2px;">{{ $errors->first('email') }}</div>
			@endif
		</div>

		<div class="edit-user-actions">
			<button type="submit" style="background:var(--psu-blue);color:#fff;padding:12px 24px;border-radius:8px;font-weight:700;border:none;cursor:pointer;">Update Account</button>
			<a href="{{ route('users.index') }}" style="color:#475569;font-weight:700;text-decoration:none;">Cancel</a>
		</div>
	</form>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const preview = document.getElementById('avatar-preview');
        const icon = document.getElementById('avatar-icon');
        preview.src = reader.result;
        preview.style.display = 'block';
        if (icon) icon.style.display = 'none';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
@extends('format.studentLayout')

@section('title', 'Student Page.')
@section('content')

@php
	$avatarPath = $student->userAccount?->avatar;
	$avatarUrl = null;

	if ($avatarPath) {
		$avatarUrl = str_starts_with($avatarPath, 'http://') || str_starts_with($avatarPath, 'https://')
			? $avatarPath
			: (str_starts_with($avatarPath, 'images/') ? asset($avatarPath) : asset('storage/' . $avatarPath));
	}
@endphp

<div class="panel" data-live-refresh="true" data-refresh-interval="10000">
	<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
		<div>
			<h2 style="margin:0;">Student Details</h2>
			<p style="margin:4px 0 0;color:#475569;">View detailed information for this student.</p>
		</div>
		<div style="display:flex;gap:10px;align-items:center;">
			@if(Auth::check() && Auth::user()->role === 'admin')
				<a href="{{ route('students.edit', $student) }}" style="background:#2563eb;color:#fff;padding:10px 14px;border-radius:8px;font-weight:700;text-decoration:none;">Edit</a>
			@endif
			<a href="{{ route('dashboard') }}" style="color:#2563eb;font-weight:700;text-decoration:none;">Back</a>
		</div>
	</div>

	<div style="margin-top:20px; display:flex; gap: 20px; align-items: flex-start;">
		<div style="flex: 0 0 150px; background: #fff; padding: 10px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
			@if($avatarUrl)
				<img src="{{ $avatarUrl }}" alt="Profile Image" style="width: 130px; height: 130px; border-radius: 50%; object-fit: cover; border: 3px solid #0a2ca8;">
			@else
				<div style="width: 130px; height: 130px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #94a3b8; border: 3px solid #0a2ca8; margin: 0 auto;">
					<i class="fa-solid fa-user"></i>
				</div>
			@endif
			<p style="margin: 10px 0 0; font-weight: 700; color: #0f172a; font-size: 0.9rem;">ID: {{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}</p>
		</div>

		<div style="flex: 1; overflow-x:auto;">
			<table>
				<tbody>
					<tr>
						<th style="width:220px;">First Name</th>
					<td>{{ $student->first_name }}</td>
				</tr>
				<tr>
					<th>Middle Name</th>
					<td>{{ $student->middle_name }}</td>
				</tr>
				<tr>
					<th>Last Name</th>
					<td>{{ $student->last_name }}</td>
				</tr>
				<tr>
					<th>Email Address</th>
					<td>{{ $student->userAccount->email ?? '' }}</td>
				</tr>
				<tr>
					<th>Username</th>
					<td>{{ $student->userAccount->username ?? '' }}</td>
				</tr>
				<tr>
					<th>Role</th>
					<td style="text-transform:capitalize;">{{ $student->userAccount->role ?? 'student' }}</td>
				</tr>
				<tr>
					<th>Account Status</th>
					<td>{{ $student->userAccount?->is_active ? 'Active' : 'Inactive' }}</td>
				</tr>
				<tr>
					<th>Password</th>
					<td>Stored securely in the system and hidden for safety</td>
				</tr>
				<tr>
					<th>Degree</th>
					<td>{{ $student->degree?->degree_title ?? '—' }}</td>
				</tr>
				<tr>
					<th>Contact Number</th>
					<td>{{ $student->contact_number }}</td>
				</tr>
				<tr>
					<th>Address</th>
					<td>{{ $student->address }}</td>
				</tr>
			</tbody>
		</table>
	</div>
	</div>
</div>
@endsection




@extends('format.layout')

@section('title', 'Client Profile')

@section('content')
	<section class="panel">
		<h2 style="margin-top: 0;">Profile Information</h2>
		<table style="width: 100%; border-collapse: collapse;">
			<tbody>
				<tr>
					<td style="padding: 6px 0; color: #6b7280; width: 140px;">Name</td>
					<td>{{ $profile['name'] }}</td>
				</tr>
				<tr>
					<td style="padding: 6px 0; color: #6b7280;">Role</td>
					<td>{{ $profile['role'] }}</td>
				</tr>
				<tr>
					<td style="padding: 6px 0; color: #6b7280;">Plan</td>
					<td>{{ $profile['plan'] }}</td>
				</tr>
				<tr>
					<td style="padding: 6px 0; color: #6b7280;">Email</td>
					<td>{{ $profile['email'] }}</td>
				</tr>
				<tr>
					<td style="padding: 6px 0; color: #6b7280;">Phone</td>
					<td>{{ $profile['phone'] }}</td>
				</tr>
				<tr>
					<td style="padding: 6px 0; color: #6b7280;">Location</td>
					<td>{{ $profile['location'] }}</td>
				</tr>
			</tbody>
		</table>
	</section>

	<section class="panel">
		<h3 style="margin-top: 0;">Preferences</h3>
		<ul style="padding-left: 20px; margin: 0;">
			@foreach ($preferences as $preference)
				<li style="margin-bottom: 6px;">{{ $preference }}</li>
			@endforeach
		</ul>
	</section>

	<section class="panel">
		<h3 style="margin-top: 0;">Recent Activity</h3>
		@foreach ($activity as $entry)
			<div style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
				<strong style="display: block; color: #1d4ed8;">{{ $entry['time'] }}</strong>
				<span>{{ $entry['detail'] }}</span>
			</div>
		@endforeach
	</section>
@endsection

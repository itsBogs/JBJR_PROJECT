@extends('format.studentLayout')

@section('title', 'Degree Details')

@section('content')
<div class="panel">
	<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
		<div>
			<h2 style="margin:0;">Degree Details</h2>
			<p style="margin:4px 0 0;color:#475569;">View degree information.</p>
		</div>
		<div style="display:flex;gap:10px;align-items:center;">
			<a href="{{ route('degrees.edit', $degree) }}" style="background:#0f172a;color:#fff;padding:10px 14px;border-radius:8px;font-weight:700;text-decoration:none;">Edit</a>
			<a href="{{ route('dashboard') }}" style="color:#2563eb;font-weight:700;text-decoration:none;">Back</a>
		</div>
	</div>

	<div style="margin-top:14px;overflow-x:auto;">
		<table>
			<tbody>
				<tr>
					<th style="width:220px;">Degree Title</th>
					<td>{{ $degree->degree_title }}</td>
				</tr>
				<tr>
					<th>Students</th>
					<td>{{ $degree->students_count }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection

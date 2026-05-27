@extends('format.layout')

@section('title', 'Client Dashboard')

@section('content')
	<section class="card" style="margin-bottom: 1.5rem;">
		<h1 style="margin: 0;">Operations pulse</h1>
		<p style="margin: 0.5rem 0 0; color: #475569;">Snapshot of live KPIs for JBJR Trading.</p>
	</section>

	<section class="card-grid" style="margin-bottom: 1.5rem;">
		@foreach ($metrics as $metric)
			<article class="card" style="text-align: center;">
				<p style="text-transform: uppercase; font-size: 0.75rem; color: #94a3b8; letter-spacing: 0.08em;">{{ $metric['label'] }}</p>
				<p style="font-size: 2.25rem; margin: 0;">{{ $metric['value'] }}</p>
				<p style="margin: 0.35rem 0 0; color: #22c55e;">{{ $metric['trend'] }}</p>
			</article>
		@endforeach
	</section>

	<section class="card-grid">
		<article class="card">
			<h2 style="margin-top: 0;">Action queue</h2>
			<ul style="list-style: none; padding: 0; margin: 0;">
				@foreach ($tasks as $task)
					<li style="padding: 0.85rem 0; border-bottom: 1px solid #e2e8f0;">
						<strong>{{ $task['title'] }}</strong>
						<p style="margin: 0.25rem 0 0; color: #475569;">Due {{ $task['due'] }} • Status: {{ $task['status'] }}</p>
					</li>
				@endforeach
			</ul>
		</article>

		<article class="card">
			<h2 style="margin-top: 0;">Alerts</h2>
			<div style="display: flex; flex-direction: column; gap: 0.75rem;">
				@foreach ($alerts as $alert)
					<p style="margin: 0; padding: 0.75rem; background: #fef9c3; border: 1px solid #fde68a; border-radius: 0.75rem; color: #854d0e;">
						⚠️ {{ $alert }}
					</p>
				@endforeach
			</div>
		</article>
	</section>
@endsection

@extends('format.layout')

@section('title', 'Client Greeting')

@section('content')
	<section class="card" style="margin-bottom: 1.5rem;">
		<p style="text-transform: uppercase; letter-spacing: 0.09em; font-size: 0.75rem; color: #64748b;">Welcome back</p>
		<h1 style="margin-top: 0.25rem; font-size: clamp(1.75rem, 4vw, 2.5rem);">
			Hello {{ $client['contactPerson'] }} — {{ $client['name'] }} is live.
		</h1>
		<p style="margin-top: 0.75rem; color: #475569;">
			Industry focus: <strong>{{ $client['industry'] }}</strong> • HQ: <strong>{{ $client['location'] }}</strong>
		</p>
	</section>

	<section class="card-grid" style="margin-bottom: 1.5rem;">
		@foreach ($highlights as $item)
			<article class="card">
				<p style="font-weight: 600; margin-bottom: 0.25rem; color: #1d4ed8;">Highlight</p>
				<p style="margin: 0; color: #0f172a;">{{ $item }}</p>
			</article>
		@endforeach
	</section>

	<section class="card">
		<h2 style="margin-top: 0;">Suggested next moves</h2>
		<div class="card-grid">
			@foreach ($nextSteps as $step)
				<article class="card" style="border-style: dashed; border-color: #bfdbfe;">
					<h3 style="margin-top: 0;">{{ $step['label'] }}</h3>
					<p style="color: #475569;">{{ $step['description'] }}</p>
					<a href="{{ $step['url'] }}" style="color: #2563eb; font-weight: 600;">Open page →</a>
				</article>
			@endforeach
		</div>
	</section>
@endsection

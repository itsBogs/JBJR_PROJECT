@extends('format.layout')

@section('title', 'About JBJR')

@section('content')
	<section class="card" style="margin-bottom: 1.5rem;">
		<p style="text-transform: uppercase; letter-spacing: 0.08em; font-size: 0.8rem; color: #64748b;">About us</p>
		<h1 style="margin: 0;">{{ $company['tagline'] }}</h1>
		<p style="color: #475569;">{{ $company['mission'] }}</p>
	</section>

	<section class="card-grid" style="margin-bottom: 1.5rem;">
		<article class="card" style="background: #1d4ed8; color: white;">
			<h2 style="margin-top: 0;">Mission</h2>
			<p>{{ $company['mission'] }}</p>
		</article>
		<article class="card" style="background: #0f172a; color: white;">
			<h2 style="margin-top: 0;">Vision</h2>
			<p>{{ $company['vision'] }}</p>
		</article>
	</section>

	<section class="card" style="margin-bottom: 1.5rem;">
		<h2 style="margin-top: 0;">Values we ship with</h2>
		<ul style="padding-left: 1.25rem; margin: 0; color: #475569;">
			@foreach ($values as $value)
				<li style="margin-bottom: 0.5rem;">{{ $value }}</li>
			@endforeach
		</ul>
	</section>

	<section class="card">
		<h2 style="margin-top: 0;">Timeline</h2>
		<div style="display: grid; gap: 1rem;">
			@foreach ($timeline as $moment)
				<article style="border-left: 3px solid #2563eb; padding-left: 1rem;">
					<p style="margin: 0; font-weight: 700;">{{ $moment['year'] }}</p>
					<p style="margin: 0.25rem 0 0; color: #475569;">{{ $moment['event'] }}</p>
				</article>
			@endforeach
		</div>
	</section>
@endsection
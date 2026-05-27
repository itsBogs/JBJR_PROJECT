@extends('format.studentLayout')

@section('title', 'Home')

@push('styles')
<style>
	.home-hero {
		position: relative;
		min-height: 460px;
		border-radius: 16px;
		overflow: hidden;
		background:
			linear-gradient(120deg, rgba(4, 26, 115, 0.82) 0%, rgba(10, 44, 168, 0.8) 45%, rgba(10, 44, 168, 0.62) 100%),
			url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1800&q=80') center/cover no-repeat;
		color: #ffffff;
		box-shadow: 0 22px 50px rgba(0, 0, 0, 0.2);
	}

	.home-hero::after {
		content: '';
		position: absolute;
		inset: 0;
		background: radial-gradient(circle at 20% 25%, rgba(255, 255, 255, 0.16), transparent 30%);
		pointer-events: none;
	}

	.home-hero-inner {
		position: relative;
		z-index: 1;
		padding: 30px;
		display: grid;
		grid-template-columns: 320px 1fr;
		gap: 20px;
		min-height: 460px;
	}

	.home-news-card {
		align-self: end;
		background: rgba(255, 255, 255, 0.94);
		color: #0a0a0a;
		border-radius: 14px;
		overflow: hidden;
		border: 1px solid rgba(255, 255, 255, 0.45);
	}

	.home-news-card img {
		width: 100%;
		height: 190px;
		object-fit: cover;
		display: block;
	}

	.home-news-body {
		padding: 14px;
	}

	.home-news-body h3 {
		margin: 0 0 6px;
		font-size: 1rem;
		color: #041a73;
	}

	.home-news-body p {
		margin: 0;
		font-size: 0.88rem;
		color: #374151;
		line-height: 1.5;
	}

	.home-copy {
		align-self: center;
		text-shadow: 0 4px 18px rgba(0, 0, 0, 0.5);
	}

	.home-tag {
		display: inline-block;
		background: rgba(255, 255, 255, 0.14);
		border: 1px solid rgba(255, 255, 255, 0.35);
		border-radius: 999px;
		padding: 8px 14px;
		font-size: 0.78rem;
		font-weight: 700;
		letter-spacing: 0.06em;
		text-transform: uppercase;
		margin-bottom: 14px;
	}

	.home-copy h2 {
		margin: 0;
		font-size: clamp(1.8rem, 4.8vw, 4rem);
		line-height: 1.06;
		max-width: 760px;
		font-weight: 800;
	}

	.home-copy p {
		margin: 14px 0 0;
		font-size: clamp(0.92rem, 1.7vw, 1.08rem);
		max-width: 690px;
		line-height: 1.7;
		color: #eef2ff;
	}

	.home-actions {
		margin-top: 24px;
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
	}

	.home-btn-outline {
		color: #ffffff;
		border-color: rgba(255, 255, 255, 0.7);
		background: rgba(0, 0, 0, 0.2);
	}

	.home-btn-outline:hover {
		background: rgba(255, 255, 255, 0.14);
	}

	.home-quick-links {
		margin-top: 18px;
		display: grid;
		grid-template-columns: repeat(4, minmax(180px, 1fr));
		gap: 14px;
	}

	.home-ql-item {
		background: #ffffff;
		border: 1px solid #dbe2ff;
		border-radius: 12px;
		padding: 14px;
	}

	.home-ql-item h4 {
		margin: 0;
		color: #041a73;
		font-size: 0.94rem;
	}

	.home-ql-item p {
		margin: 7px 0 0;
		color: #3f4a5f;
		font-size: 0.84rem;
		line-height: 1.5;
	}

	@media (max-width: 980px) {
		.home-hero-inner {
			grid-template-columns: 1fr;
		}

		.home-news-card {
			max-width: 420px;
		}

		.home-quick-links {
			grid-template-columns: repeat(2, minmax(160px, 1fr));
		}
	}

	@media (max-width: 640px) {
		.home-hero {
			min-height: 440px;
		}

		.home-hero-inner {
			padding: 18px 14px;
			min-height: 440px;
		}

		.home-quick-links {
			grid-template-columns: 1fr;
		}
	}
</style>
@endpush

@section('content')
<section class="home-hero">
	<div class="home-hero-inner">
		<article class="home-news-card">
			<img src="{{ asset('images/midpic.jpg') }}" alt="Campus news">
			<div class="home-news-body">
				<h3>Latest University Highlights</h3>
				<p>Recognitions, board exam performance, and student success stories from across PSU campuses.</p>
			</div>
		</article>

		<div class="home-copy">
			<span class="home-tag">Region's Premier University of Choice</span>
			<h1>Leading Industry-Driven State University in the ASEAN Region.</h1>
			<p>
				Discover a university experience built on excellence, innovation, and public service.
				Explore programs, announcements, and student services through our digital campus.
			</p>
			<div class="home-actions">
				<a href="{{ route('dashboard') }}" class="btn btn-primary">Open Dashboard</a>
				<a href="{{ route('students.aboutus') }}" class="btn home-btn-outline">Learn More</a>
			</div>
		</div>
	</div>
</section>

<section class="home-quick-links">
	<div class="home-ql-item">
		<h4>Admissions</h4>
		<p>Start your PSU journey and check enrollment requirements.</p>
	</div>
	<div class="home-ql-item">
		<h4>Academic Programs</h4>
		<p>Browse degree programs and academic offerings.</p>
	</div>
	<div class="home-ql-item">
		<h4>Announcements</h4>
		<p>View official university updates and advisories.</p>
	</div>
	<div class="home-ql-item">
		<h4>Campus Services</h4>
		<p>Access student support, records, and campus facilities.</p>
	</div>
</section>

@if(session('show_promotion'))
<div id="promotion-popup-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 999; display: flex; align-items: center; justify-content: center; padding: 20px; font-family: sans-serif;">
    <div id="promotion-popup" style="position: relative; background: white; border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.3); max-width: 950px; width: 100%; display: flex; overflow: hidden;">
        
        <!-- Close Button -->
        <button onclick="document.getElementById('promotion-popup-overlay').style.display='none'" style="position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.3); color: white; border: none; border-radius: 50%; width: 30px; height: 30px; font-size: 16px; cursor: pointer; line-height: 30px; text-align: center; z-index: 10;">&times;</button>

        <!-- Left Column (Text) -->
        <div style="flex-basis: 55%; padding: 50px 60px; background: white;">
            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                <img src="{{ asset('images/logo.png') }}" alt="PSU Logo" style="width: 60px; height: 60px; margin-right: 15px;">
                <div>
                    <h3 style="color: #041a73; margin: 0; font-size: 1.2rem; font-weight: 600;">PANGASINAN STATE UNIVERSITY</h3>
                    <p style="color: #555; margin: 0; font-size: 0.9rem;">San Carlos City Campus</p>
                </div>
            </div>
            <p style="color: #041a73; font-size: 1.1rem; font-weight: 600; margin-bottom: 10px;">ANNOUNCEMENT</p>
            <h1 style="color: #041a73; font-size: 3.5rem; font-weight: 800; line-height: 1.1; margin-top: 0; margin-bottom: 20px;">UPCOMING<br>EXAMINATION<br>SCHEDULE</h1>
            <p style="background-color: #ffc107; color: #333; padding: 15px 20px; border-radius: 12px; font-size: 1.1rem; font-weight: 600; display: inline-block;">CHECK YOUR SCHEDULES & PREPARE</p>
        </div>

        <!-- Right Column (Image) -->
        <div style="flex-basis: 45%; background: url('{{ asset('images/promotion.jpg') }}') center/cover no-repeat;">
            <!-- This div is for the background image -->
        </div>
    </div>
</div>
@endif

@endsection

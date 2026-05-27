<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'Student Portal')</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		:root {
			--psu-blue: #0a2ca8;
			--psu-blue-dark: #041a73;
			--ink: #0a0a0a;
			--paper: #ffffff;
			--line: #dbe2ff;
			--soft: #f6f8ff;
		}

		* {
			box-sizing: border-box;
		}

		body {
			font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			margin: 0;
			background: linear-gradient(180deg, #f7f9ff 0%, #eef3ff 100%);
			color: var(--ink);
			display: flex;
			flex-direction: column;
			min-height: 100vh;
		}

		.top-strip {
			height: 6px;
			background: linear-gradient(90deg, #031252 0%, #0a2ca8 50%, #031252 100%);
		}

		header {
			background: #f1f3f7;
			border-bottom: 1px solid #d7dce7;
			padding: 18px 20px;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.header-content {
			display: flex;
			align-items: center;
			justify-content: center;
			max-width: 1200px;
			width: fit-content;
			gap: 14px;
		}

		.logo-container {
			width: 76px;
			height: 76px;
			border-radius: 50%;
			background-color: #ffffff;
			border: 2px solid #1f47d2;
			padding: 4px;
			overflow: hidden;
			box-shadow: 0 10px 22px rgba(0, 0, 0, 0.12);
		}

		.logo-container img {
			width: 100%;
			height: 100%;
			object-fit: contain;
		}

		.brand {
			line-height: 1.08;
		}

		.brand-code {
			margin: 0;
			font-size: clamp(2.1rem, 5vw, 3.3rem);
			font-weight: 800;
			letter-spacing: 0.03em;
			text-transform: uppercase;
			color: var(--psu-blue);
		}

		.brand-name {
			margin: 2px 0 0;
			font-size: clamp(0.92rem, 1.7vw, 1.72rem);
			font-weight: 600;
			color: #183f97;
		}

		.menu {
			background: linear-gradient(180deg, #0824a0 0%, #051a7d 100%);
			border-top: 1px solid rgba(255, 255, 255, 0.1);
			border-bottom: 1px solid rgba(0, 0, 0, 0.3);
			position: sticky;
			top: 0;
			z-index: 20;
		}

		.menu-inner {
			max-width: 1200px;
			margin: 0 auto;
			display: flex;
			align-items: center;
			gap: 6px;
			overflow-x: auto;
			padding: 0 10px;
			scrollbar-width: thin;
		}

		nav a {
			flex: 0 0 auto;
			display: inline-flex;
			align-items: center;
			gap: 8px;
			color: #ffffff;
			text-decoration: none;
			padding: 16px 12px;
			font-size: 0.94rem;
			font-weight: 600;
			border-bottom: 3px solid transparent;
			transition: background-color 0.2s ease, border-color 0.2s ease;
		}

		nav a:hover, nav a.active {
			background: rgba(255, 255, 255, 0.12);
			border-bottom-color: #ffffff;
			color: #ffffff;
		}

		nav a i {
			width: 16px;
			text-align: center;
		}

		.container {
			max-width: 1200px;
			margin: 22px auto;
			padding: 0 24px 40px;
			flex: 1;
			transition: opacity 0.3s ease-in-out;
		}

		.panel {
			background: #ffffff;
			border: 1px solid var(--line);
			border-radius: 14px;
			padding: 20px;
			margin-bottom: 20px;
			box-shadow: 0 10px 26px rgba(4, 26, 115, 0.08);
		}

		.panel h2,
		.panel h3 {
			color: var(--psu-blue-dark);
			border-bottom: 1px solid var(--line);
			padding-bottom: 10px;
			margin-top: 0;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			background-color: #ffffff;
			font-size: 0.95rem;
			border: 1px solid var(--line);
			border-radius: 12px;
			overflow: hidden;
		}

		th,
		td {
			padding: 12px 15px;
			border: 1px solid var(--line);
			text-align: left;
		}

		th {
			background-color: #eef3ff;
			color: #334155;
			font-weight: 600;
		}

		tr:nth-child(even) td {
			background-color: #f8faff;
		}

		tr:hover td {
			background-color: #edf2ff;
		}

		footer {
			text-align: center;
			padding: 20px 16px;
			font-size: 0.9rem;
			color: #e5e7eb;
			background: #090909;
			border-top: 1px solid #1f2937;
		}

		.btn {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			text-decoration: none;
			font-weight: 700;
			padding: 10px 16px;
			border-radius: 10px;
			border: 1px solid transparent;
			cursor: pointer;
			transition: all 0.2s ease;
			font-size: 14px;
			text-align: center;
		}

		.btn-primary {
			background-color: var(--psu-blue);
			border-color: var(--psu-blue);
			color: white;
		}

		.btn-primary:hover {
			background-color: var(--psu-blue-dark);
			border-color: var(--psu-blue-dark);
		}

		.btn-edit {
			background-color: #111111;
			border-color: #111111;
			color: white;
		}

		.btn-edit:hover {
			background-color: #000000;
			border-color: #000000;
		}

		.btn-delete {
			background-color: #dc2626;
			border-color: #dc2626;
			color: white;
		}

		.btn-delete:hover {
			background-color: #b91c1c;
			border-color: #b91c1c;
		}

		.form-group {
			margin-bottom: 15px;
		}

		.form-group label {
			display: block;
			margin-bottom: 5px;
			font-weight: 600;
			color: #334155;
		}

		.form-group input[type="text"],
		.form-group input[type="number"],
		.form-group input[type="email"],
		.form-group select,
		textarea {
			width: 100%;
			padding: 10px;
			border: 1px solid var(--line);
			border-radius: 10px;
			box-sizing: border-box;
			font-family: inherit;
		}

		.form-group input:focus,
		.form-group select:focus,
		textarea:focus {
			border-color: var(--psu-blue);
			box-shadow: 0 0 0 3px rgba(10, 44, 168, 0.15);
			outline: none;
		}

		.success-message {
			background-color: #edf2ff;
			color: var(--psu-blue-dark);
			padding: 15px;
			border-radius: 10px;
			margin-bottom: 20px;
			border: 1px solid rgba(10, 44, 168, 0.25);
		}

		.action-link {
			color: var(--psu-blue);
			text-decoration: none;
			font-weight: 600;
		}

		.action-link:hover {
			text-decoration: underline;
		}

		@media (max-width: 760px) {
			header {
				padding: 14px 12px;
			}

			.header-content {
				width: 100%;
			}

			.logo-container {
				width: 58px;
				height: 58px;
			}

			nav a {
				padding: 12px 10px;
				font-size: 0.88rem;
			}

			.container {
				padding: 0 12px 30px;
			}
		}
	</style>
	@stack('styles')
</head>
<body>
	<div class="top-strip"></div>

	<header>
		<div class="header-content">
			<div class="logo-container">
			 <img src="{{ asset('images/logo.png') }}" alt="Logo"> 
			</div>
			<div class="brand">
				<p class="brand-code">PSU</p>
				<p class="brand-name">Pangasinan State University</p>
			</div>
		</div>
	</header>

	<div class="menu">
		<nav class="menu-inner">
			@auth
				<a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fa-solid fa-house"></i>Home</a>
				<a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') || request()->routeIs('student.dashboard') || request()->routeIs('teacher.dashboard') || request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-table-columns"></i>Dashboard</a>

				@if(Auth::user()->role === 'admin')
					<a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.index') ? 'active' : '' }}"><i class="fa-solid fa-users"></i>Students</a>
					<a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.index') ? 'active' : '' }}"><i class="fa-solid fa-book"></i>Courses</a>
					<a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}"><i class="fa-solid fa-user-gear"></i>Manage Teachers</a>
				@endif

				@if(Auth::user()->role === 'teacher')
					<a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.index') ? 'active' : '' }}"><i class="fa-solid fa-users"></i>Students</a>
					<a href="{{ route('students.create') }}" class="{{ request()->routeIs('students.create') ? 'active' : '' }}"><i class="fa-solid fa-user-plus"></i>Add Student</a>
					<a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.index') || request()->routeIs('courses.show') ? 'active' : '' }}"><i class="fa-solid fa-book"></i>Courses</a>
				@endif

				@if(in_array(Auth::user()->role, ['teacher', 'student'], true))
					<a href="{{ route('password.change') }}" class="{{ request()->routeIs('password.change') ? 'active' : '' }}"><i class="fa-solid fa-key"></i>Change Password</a>
				@endif
				
				<form action="{{ route('logout') }}" method="POST" style="margin-left: auto;">
					@csrf
					<button type="submit" style="background: transparent; border: none; color: white; padding: 16px 12px; font-size: 0.94rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
						<i class="fa-solid fa-right-from-bracket"></i>Logout
					</button>
				</form>
			@else
				<a href="#" style="opacity: 0.6; cursor: not-allowed;"><i class="fa-solid fa-lock"></i> Please Login to Access Navigation</a>
			@endauth
		</nav>
	</div>

	<div class="container" id="main-content">
		@yield('content')
	</div>

	<footer>
		<p>@JaysonBogs {{ now()->format('F j, Y') }}</p>
	</footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', 'Client Portal')</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		:root {
			--facebook-blue: #1877F2;
			--facebook-bg: #F0F2F5;
			--facebook-card: #FFFFFF;
			--facebook-text: #050505;
			--facebook-text-secondary: #65676B;
			--facebook-border: #CED0D4;
		}

		body {
			font-family: 'Helvetica', 'Arial', sans-serif;
			margin: 0;
			background: var(--facebook-bg);
			color: var(--facebook-text);
		}

		header {
			background: var(--facebook-card);
			color: var(--facebook-text);
			padding: 10px 32px;
			box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
			border-bottom: 1px solid var(--facebook-border);
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.header-content {
			flex-grow: 1;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.logo-container {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			background-color: #fff;
			margin-right: 15px;
			overflow: hidden;
			border: 1px solid var(--facebook-border);
		}

		.logo-container img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		header h1 {
			margin: 0;
			font-size: 1.8rem;
			font-weight: 700;
			color: var(--facebook-blue);
		}

		nav a:hover, nav a.active {
			background-color: #E7F3FF;
			color: var(--facebook-blue);
		}

		nav a i {
			margin-right: 8px;
			width: 16px; /* To align text for links without icons */
		}

		.container {
			max-width: 1000px;
			margin: 20px auto;
			padding: 0 24px 40px;
		}

		.panel {
			background: var(--facebook-card);
			border: 1px solid var(--facebook-border);
			border-radius: 8px;
			padding: 20px;
			margin-bottom: 20px;
			box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
		}

		.panel h2,
		.panel h3 {
			color: var(--facebook-text);
			border-bottom: 1px solid var(--facebook-bg);
			padding-bottom: 10px;
			margin-top: 0;
		}

		footer {
			text-align: center;
			padding: 20px;
			font-size: 0.9rem;
			color: var(--facebook-text-secondary);
			background: var(--facebook-card);
			border-top: 1px solid var(--facebook-border);
		}
	</style>
</head>
<body>
	<header>
		<div class="logo-container">
			{{-- You can place an image tag here, e.g., <img src="{{ asset('images/logo.png') }}" alt="Logo"> --}}
		</div>
		<div class="header-content">
			<h1>Client Pages</h1>
			<nav>
				<a href="{{ route('client.index') }}" class="{{ request()->routeIs('client.index') ? 'active' : '' }}"><i class="fa-solid fa-hand-sparkles"></i>Greeting</a>
				<a href="{{ route('client.show', 'clientDashboard') }}" class="{{ request()->is('client/clientDashboard') ? 'active' : '' }}"><i class="fa-solid fa-table-columns"></i>Dashboard</a>
				<a href="{{ route('client.show', 'clientProfile') }}" class="{{ request()->is('client/clientProfile') ? 'active' : '' }}"><i class="fa-solid fa-user"></i>Profile</a>
				<a href="{{ route('client.show', 'clientAboutUs') }}" class="{{ request()->is('client/clientAboutUs') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i>About Us</a>
			</nav>
		</div>
	</header>

	<div class="container">
		@yield('content')
	</div>

	<footer>
		<p> @RAMOS, JAYSON BOGS {{ now()->format('F j, Y') }}</p>
	</footer>
</body>
</html>

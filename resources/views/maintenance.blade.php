<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #eef2ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
        }
        .image-column {
            flex-basis: 50%;
            text-align: center;
        }
        .image-column img {
            max-width: 100%;
            width: 450px;
            height: auto;
        }
        .text-column {
            flex-basis: 50%;
            padding-left: 60px;
        }
        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 110px;
            height: auto;
            margin-right: 20px;
        }
        .university-name {
            color: #041a73;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.2;
            font-family: 'Merriweather', serif;
        }
        h1 {
            color: #041a73;
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-top: 0;
            margin-bottom: 20px;
        }
        p {
            color: #374151;
            font-size: 1.15rem;
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 450px;
        }
        .back-button {
            display: inline-block;
            padding: 15px 40px;
            background-image: linear-gradient(to right, #0a2c9a, #041a73);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 10px 20px rgba(4, 26, 115, 0.2);
            transition: all 0.3s ease;
        }
        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px rgba(4, 26, 115, 0.25);
        }
        .footer-links {
            margin-top: 50px;
            color: #55627c;
        }
        .footer-links a {
            color: #55627c;
            text-decoration: none;
            margin: 0 10px;
            font-weight: 600;
        }
        .footer-links a:hover {
            color: #041a73;
        }

        @media (max-width: 992px) {
            .container {
                flex-direction: column;
                text-align: center;
            }
            .text-column {
                padding-left: 0;
                margin-top: 40px;
            }
            p {
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-column">
            <img src="{{ asset('images/monitoring.png') }}" alt="Maintenance Illustration">
        </div>
        <div class="text-column">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="logo">
                <div class="university-name">Pangasinan State University</div>
            </div>
            <h1>We're making things even better!</h1>
            <p>
                Our website is currently undergoing scheduled maintenance to improve your experience.
                We'll be back online shortly. Thank you for your patience!
            </p>
            <a href="{{ route('home') }}" class="back-button">Return to Homepage</a>
            <div class="footer-links">
                <span>Follow us for updates:</span>
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
            </div>
        </div>
    </div>
</body>
</html>

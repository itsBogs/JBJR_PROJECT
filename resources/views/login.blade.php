@extends('format.studentLayout')

@section('title', 'Login')

@push('styles')
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        width: 100vw;
        padding: 20px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 10000;
        margin: 0;
        background: #f1f3f7 url('{{ asset("images/midpic.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .login-container::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, rgba(10, 44, 168, 0.2) 0%, rgba(5, 20, 80, 0.8) 100%);
        z-index: 1;
    }
    .login-card {
        position: relative;
        z-index: 10;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        padding: 25px 30px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        width: 100%;
        max-width: 350px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        text-align: center;
    }
    .login-header {
        margin-bottom: 20px;
    }
    .logo-container {
        width: 110px;
        height: 110px;
        margin: 0 auto 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
    }
    .logo-container img {
        width: 100%;
        height: 100%;
        object-item: contain;
    }
    .login-header h2 {
        font-size: 1.6rem;
        font-weight: 800;
        color: #051a7d;
        margin: 0;
        letter-spacing: -0.5px;
    }
    .login-header p {
        color: #64748b;
        font-size: 0.85rem;
        margin: 4px 0 0;
    }
    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }
    .form-group label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #475569;
        margin-bottom: 5px;
        display: block;
        padding-left: 2px;
    }
    .input-wrapper {
        position: relative;
    }
    .input-wrapper i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.9rem;
    }
    .form-group input {
        width: 100%;
        padding: 10px 12px 10px 40px !important;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.9rem;
        background: #f8fafc;
        transition: all 0.2s;
    }
    .btn-login {
        width: 100%;
        padding: 12px;
        background: #0a2ca8;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        margin-top: 5px;
    }
    .login-footer {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }
    .social-links {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 8px;
    }
    .social-links a {
        width: 32px;
        height: 32px;
        font-size: 0.9rem;
        background: #f1f5f9;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        text-decoration: none;
    }
    .alert-danger {
        background: #fee2e2;
        border-left: 4px solid #dc2626;
        color: #b91c1c;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .error-msg {
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 6px;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="PSU Logo">
            </div>
            <h2>Welcome Back</h2>
            <p>Access your portal</p>
        </div>
        
        @if(session('error'))
            <div class="alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="login">Username or Email</label>
                <div class="input-wrapper">
                    <input type="text" id="login" name="login" value="{{ old('login') }}" placeholder="Enter username or email" required autofocus>
                    <i class="fa-solid fa-user"></i>
                </div>
                @error('login')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login" id="login-submit-btn">
                Sign In
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
        </form>
        <div class="login-footer">
            <p>Connect with PSU Official</p>
            <div class="social-links">
                <a href="https://www.facebook.com/PSU.Official" target="_blank" title="Facebook">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="https://twitter.com/PSU_Official" target="_blank" title="Twitter">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="https://www.psu.edu.ph" target="_blank" title="Website">
                    <i class="fa-solid fa-globe"></i>
                </a>
            </div>
        </div>    </div>
</div>

@if(session('lockout_seconds'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let timeLeft = {{ session('lockout_seconds') }};
    const btn = document.getElementById('login-submit-btn');
    const inputs = document.querySelectorAll('input');
    
   
    btn.disabled = true;
    inputs.forEach(i => i.disabled = true);
    btn.style.opacity = '0.5';
    btn.innerHTML = `<i class="fa-solid fa-lock"></i> Locked (<span id="countdown">${timeLeft}</span>s)`;

  
    Swal.fire({
        icon: 'warning',
        title: 'Too many attempts',
        html: `Please login later. You may try again in <b id="swal-timer">${timeLeft}</b> seconds.`,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        timer: timeLeft * 1000,
        timerProgressBar: true,
        didOpen: () => {
            const content = document.getElementById('swal-timer');
            timerInterval = setInterval(() => {
                timeLeft--;
                if(content) content.textContent = timeLeft;
                if(document.getElementById('countdown')) document.getElementById('countdown').textContent = timeLeft;
            }, 1000);
        },
        willClose: () => {
            clearInterval(timerInterval);
            btn.disabled = false;
            inputs.forEach(i => i.disabled = false);
            btn.style.opacity = '1';
            btn.innerHTML = `Sign In <i class="fa-solid fa-arrow-right-to-bracket"></i>`;
            
            // Optional: small toast when unlocked
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'You can now try to login again!',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
});
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Login Successful',
        text: '{{ session('success') }}',
        confirmButtonColor: '#0a2ca8',
        timer: 2000,
        showConfirmButton: false
    });
});
</script>
@endif
</script>
@endif
@endsection

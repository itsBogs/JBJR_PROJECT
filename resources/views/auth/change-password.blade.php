@extends('format.studentLayout')

@section('title', 'Change Password')

@section('content')
<div class="panel" style="max-width: 600px; margin: 0 auto;">
    <h2 style="margin-top:0;">Change Password</h2>
    <p style="color:#64748b; margin-bottom: 20px;">For security reasons, you must change your password before proceeding.</p>
    
    @if ($errors->any())
        <div style="margin-bottom: 20px; color: #dc2626; background: #fee2e2; border: 1px solid #fecaca; padding: 12px; border-radius: 8px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.change.update') }}" method="POST">
        @csrf
        <div class="form-group" style="margin-bottom: 15px;">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" id="current_password" required>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background:var(--psu-blue); color:white; border:none; padding:12px 24px; border-radius:8px; font-weight:700; cursor:pointer; flex: 1;">Update Password</button>
            <a href="{{ route('dashboard') }}" style="background:#e2e8f0; color:#0f172a; text-decoration:none; padding:12px 24px; border-radius:8px; font-weight:700; text-align:center;">Cancel</a>
        </div>
    </form>
</div>
@endsection

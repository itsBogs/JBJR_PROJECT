@extends('format.studentLayout')

@section('title', 'Users')

@section('content')
<div class="panel">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
        <div>
            <h2 style="margin:0;">User Management</h2>
            <p style="margin:6px 0 0;color:#475569;">Manage user accounts and profiles.</p>
        </div>
        <a href="{{ route('users.create') }}" style="background:#0f172a;color:#fff;padding:10px 14px;border-radius:8px;font-weight:700;text-decoration:none;">+ Add Teacher</a>
    </div>

    <div style="margin-top:20px;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users ?? [] as $user)
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">{{ $user->id }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">
                            @if($user->student)
                                {{ $user->student->first_name }} {{ $user->student->middle_name }} {{ $user->student->last_name }}
                            @else
                                {{ $user->username }} <span style="font-size: 0.8em; color:#94a3b8;">(Admin)</span>
                            @endif
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">{{ $user->email }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0; text-transform: capitalize;">{{ $user->role }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">
                            @if($user->is_active)
                                <span style="background: #dcfce3; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">Active</span>
                            @else
                                <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">Inactive</span>
                            @endif
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">
                            <div style="display:flex; gap: 8px;">
                                <a href="{{ route('users.edit', $user) }}" style="color:#2563eb; font-weight:600; text-decoration:none;">Edit</a>
                                @if(Auth::id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" data-confirm="Delete this user?" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:none; border:none; color:#dc2626; font-weight:600; cursor:pointer; padding:0;">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:#64748b;padding:20px;">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

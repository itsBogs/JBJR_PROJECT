@extends('format.studentLayout')

@section('title', 'Activity Logs')

@section('content')
<div class="panel" data-live-refresh="true" data-refresh-interval="4000">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
        <div>
            <h2 style="margin:0;">Activity Logs</h2>
            <p style="margin:6px 0 0;color:#475569;">History of edited and deleted records.</p>
        </div>
        <a href="{{ route('dashboard') }}" style="background:#0f172a;color:#fff;padding:10px 14px;border-radius:8px;font-weight:700;text-decoration:none;">Back to Dashboard</a>
    </div>

    @if ($logs->count() === 0)
        <p style="margin:16px 0 0;color:#64748b;">No activity logs yet.</p>
    @else
        <div style="overflow-x:auto;margin-top:14px;">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Type</th>
                        <th>Record ID</th>
                        <th>Description</th>
                        <th>Changes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->created_at?->format('M d, Y h:i A') }}</td>
                            <td style="text-transform:uppercase;font-weight:700;">{{ $log->action }}</td>
                            <td>{{ ucfirst($log->entity_type) }}</td>
                            <td>{{ $log->entity_id ?? '—' }}</td>
                            <td>{{ $log->description }}</td>
                            <td>
                                @if ($log->action === 'edit' && $log->old_values && $log->new_values)
                                    <details>
                                        <summary style="cursor:pointer;color:#2563eb;font-weight:700;">View</summary>
                                        <div style="margin-top:8px;display:grid;gap:8px;">
                                            <div>
                                                    @php
                                                        $old = $log->old_values ?? [];
                                                        $new = $log->new_values ?? [];
                                                        $changes = [];
                                                        foreach ($new as $key => $newValue) {
                                                            $oldValue = $old[$key] ?? null;
                                                            if ($oldValue != $newValue) {
                                                                $label = ucwords(str_replace(['_', '-'], ' ', $key));
                                                                $changes[] = $label . ' changed from "' . ($oldValue === null ? 'N/A' : $oldValue) . '" to "' . ($newValue === null ? 'N/A' : $newValue) . '"';
                                                            }
                                                        }
                                                    @endphp
                                                    @if (count($changes) > 0)
                                                        <ul style="margin:0 0 0 18px;padding:0;">
                                                            @foreach ($changes as $change)
                                                                <li>{{ $change }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span style="color:#64748b;">No changes detected.</span>
                                                    @endif
                                                </div>
                                        </div>
                                    </details>
                                @elseif ($log->old_values)
                                    <details>
                                        <summary style="cursor:pointer;color:#2563eb;font-weight:700;">View</summary>
                                        <pre style="margin-top:8px;background:#f8fafc;padding:8px;border-radius:8px;border:1px solid #e2e8f0;white-space:pre-wrap;">{{ json_encode($log->old_values, JSON_PRETTY_PRINT) }}</pre>
                                            @php
                                                $old = $log->old_values ?? [];
                                                $changes = [];
                                                foreach ($old as $key => $oldValue) {
                                                    $label = ucwords(str_replace(['_', '-'], ' ', $key));
                                                    $changes[] = $label . ': "' . ($oldValue === null ? 'N/A' : $oldValue) . '"';
                                                }
                                            @endphp
                                            @if (count($changes) > 0)
                                                <ul style="margin:0 0 0 18px;padding:0;">
                                                    @foreach ($changes as $change)
                                                        <li>{{ $change }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span style="color:#64748b;">No details available.</span>
                                            @endif
                                    </details>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top:14px;">
            {{ $logs->links() }}
        </div>
    @endif
</div>
@endsection

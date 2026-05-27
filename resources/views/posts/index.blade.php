@extends('format.studentLayout')

@section('title', 'Posts')

@section('content')
<div class="panel">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
        <div>
            <h2 style="margin:0;">Post Management</h2>
            <p style="margin:6px 0 0;color:#475569;">View and manage all student posts.</p>
        </div>
    </div>

    <div style="margin-top:20px;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts ?? [] as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->student->first_name ?? 'Unknown' }} {{ $post->student->middle_name ?? '' }} {{ $post->student->last_name ?? '' }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->content, 50) }}</td>
                        <td>{{ $post->created_at->format('M d, Y') }}</td>
                        <td>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" data-confirm="Delete this post?" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#dc2626; font-weight:600; cursor:pointer; padding:0;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:#64748b;padding:20px;">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

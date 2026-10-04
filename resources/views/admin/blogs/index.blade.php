@extends('admin.layouts.app')

@section('page-title', 'Blog Posts')

@section('content')
    <div class="page-header">
        <h1>Blog Posts Management</h1>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">+ Create New Post</a>
    </div>

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Title</th>
                    <th>Event Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr>
                        <td><strong>{{ $blog->client_name }}</strong></td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->event_date ? $blog->event_date->format('M d, Y') : 'Not set' }}</td>
                        <td>
                            <span class="badge {{ $blog->is_published ? 'badge-success' : 'badge-draft' }}">
                                {{ $blog->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn-edit">Edit</a>
                                <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" style="display: inline;"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        style="padding: 8px 16px; font-size: 13px;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px;">
                            <p class="no-data">No blog posts yet. <a href="{{ route('admin.blogs.create') }}">Create your first
                                    post →</a></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $blogs->links() }}
    </div>
@endsection

@push('styles')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: #1a1a2e;
        }
    </style>
@endpush
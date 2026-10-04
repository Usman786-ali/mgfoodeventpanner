@extends('admin.layouts.app')

@section('title', 'Manage Google Reviews')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Google Reviews</h1>
            <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New Review
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th width="80">Photo</th>
                                <th>Author Name</th>
                                <th width="120">Rating</th>
                                <th>Comment</th>
                                <th width="100">Status</th>
                                <th width="180">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                                <tr>
                                    <td style="font-weight: bold;">{{ $loop->iteration }}</td>
                                    <td>
                                        @if($review->author_photo)
                                            <img src="{{ asset($review->author_photo) }}" alt="{{ $review->author_name }}"
                                                style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                        @else
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #999;">
                                                {{ substr($review->author_name, 0, 1) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $review->author_name }}<br><small class="text-muted">{{ $review->review_date }}</small></td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill {{ $i <= $review->rating ? 'text-warning' : 'text-muted opacity-25' }}"></i>
                                        @endfor
                                    </td>
                                    <td>
                                        <div style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $review->text }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($review->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this review?');"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <p class="text-muted">No reviews found. Add your first Google review!</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

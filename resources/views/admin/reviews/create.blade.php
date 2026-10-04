@extends('admin.layouts.app')

@section('title', 'Add New Google Review')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-4">
            <h1 class="h3">Add New Review</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                    <li class="breadcrumb-item active">Add New</li>
                </ol>
            </nav>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Author Name</label>
                            <input type="text" name="author_name"
                                class="form-control @error('author_name') is-invalid @enderror"
                                value="{{ old('author_name') }}" required placeholder="e.g. Usman Ali">
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Author Photo (Optional)</label>
                            <input type="file" name="author_photo"
                                class="form-control @error('author_photo') is-invalid @enderror">
                            <small class="text-muted">Recommended: Square image (100x100px)</small>
                            @error('author_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Rating</label>
                            <select name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                <option value="5" selected>5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Review Date (Optional)</label>
                            <input type="text" name="review_date" class="form-control" value="{{ old('review_date') }}"
                                placeholder="e.g. 2 days ago, Dec 2024">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Review Text</label>
                        <textarea name="text" rows="5" class="form-control @error('text') is-invalid @enderror" required
                            placeholder="Copy the review text here...">{{ old('text') }}</textarea>
                        @error('text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Display Order</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                        </div>
                        <div class="col-md-6 d-flex align-items-center mt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                                <label class="form-check-label fw-bold" for="is_active">Show on Website</label>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-light border">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">Save Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
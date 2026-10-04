@extends('admin.layouts.app')

@section('title', 'Edit Google Review')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-4">
            <h1 class="h3">Edit Review</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Author Name</label>
                            <input type="text" name="author_name"
                                class="form-control @error('author_name') is-invalid @enderror"
                                value="{{ old('author_name', $review->author_name) }}" required>
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Author Photo (Optional)</label>
                            @if($review->author_photo)
                                <div class="mb-2">
                                    <img src="{{ asset($review->author_photo) }}" alt="Photo"
                                        style="width: 50px; height: 50px; border-radius: 50%;">
                                </div>
                            @endif
                            <input type="file" name="author_photo"
                                class="form-control @error('author_photo') is-invalid @enderror">
                            @error('author_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Rating</label>
                            <select name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>{{ $i }}
                                        Stars</option>
                                @endfor
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Review Date (Optional)</label>
                            <input type="text" name="review_date" class="form-control"
                                value="{{ old('review_date', $review->review_date) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Review Text</label>
                        <textarea name="text" rows="5" class="form-control @error('text') is-invalid @enderror"
                            required>{{ old('text', $review->text) }}</textarea>
                        @error('text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Display Order</label>
                            <input type="number" name="order" class="form-control"
                                value="{{ old('order', $review->order) }}">
                        </div>
                        <div class="col-md-6 d-flex align-items-center mt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $review->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_active">Show on Website</label>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary px-4">Update Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
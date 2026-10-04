@extends('admin.layouts.app')

@section('page-title', 'Create Blog Post')

@section('content')
    <div class="form-card">
        <h2 style="margin-bottom: 30px; font-size: 24px; font-weight: 700;">Create New Blog Post</h2>

        <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="client_name">Client Name *</label>
                <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}" 
                       placeholder="e.g., ABC Corporation, Mr. & Mrs. Ahmed" required>
            </div>

            <div class="form-group">
                <label for="excerpt">Excerpt *</label>
                <textarea id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt') }}</textarea>
            </div>

            <hr style="margin: 30px 0; border-color: #ddd;">
            <h3 style="margin-bottom: 20px; font-size: 18px;">Event Details</h3>

            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" id="event_date" name="event_date" value="{{ old('event_date') }}">
            </div>

            <div class="form-group">
                <label for="venue">Venue</label>
                <input type="text" id="venue" name="venue" value="{{ old('venue') }}" placeholder="e.g., Pearl Continental, Karachi">
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="has_food" value="1" {{ old('has_food') ? 'checked' : '' }}>
                    <span>Food Services Provided</span>
                </label>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="has_decor" value="1" {{ old('has_decor') ? 'checked' : '' }}>
                    <span>Decor Services Provided</span>
                </label>
            </div>

            <hr style="margin: 30px 0; border-color: #ddd;">

            <div class="form-group">
                <label for="content">Content *</label>
                <textarea id="content" name="content" rows="15" required>{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="featured_image">Thumbnail Image (Featured) *</label>
                <input type="file" id="featured_image" name="featured_image" accept="image/*" required>
                <small style="color: #666;">This will be shown on blog listing page</small>
            </div>

            <div class="form-group">
                <label for="gallery_images">Gallery Images (Max 9)</label>
                <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                <small style="color: #666;">These will be shown on blog detail page. You can select up to 9 images.</small>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                    <span>Publish Immediately</span>
                </label>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <span>Featured Post</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Blog Post</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['codeview']]
            ]
        });
    });
</script>
@endsection
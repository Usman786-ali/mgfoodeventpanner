@extends('admin.layouts.app')

@section('page-title', 'Edit Blog Post')

@section('content')
    <div class="form-card">
        <h2 style="margin-bottom: 30px; font-size: 24px; font-weight: 700;">Edit Blog Post</h2>

        <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                @error('title')
                    <span style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="client_name">Client Name *</label>
                <input type="text" id="client_name" name="client_name" value="{{ old('client_name', $blog->client_name) }}" 
                       placeholder="e.g., ABC Corporation, Mr. & Mrs. Ahmed" required>
                @error('client_name')
                    <span style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="excerpt">Excerpt *</label>
                <textarea id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                <small style="color: #666;">Short summary displayed on the blog list page</small>
                @error('excerpt')
                    <span style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <hr style="margin: 30px 0; border-color: #ddd;">
            <h3 style="margin-bottom: 20px; font-size: 18px;">Event Details</h3>

            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" id="event_date" name="event_date" value="{{ old('event_date', $blog->event_date ? $blog->event_date->format('Y-m-d') : '') }}">
                @error('event_date')
                    <span style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="venue">Venue</label>
                <input type="text" id="venue" name="venue" value="{{ old('venue', $blog->venue) }}" placeholder="e.g., Pearl Continental, Karachi">
                @error('venue')
                    <span style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="has_food" value="1" {{ old('has_food', $blog->has_food) ? 'checked' : '' }}>
                    <span>Food Services Provided</span>
                </label>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="has_decor" value="1" {{ old('has_decor', $blog->has_decor) ? 'checked' : '' }}>
                    <span>Decor Services Provided</span>
                </label>
            </div>

            <hr style="margin: 30px 0; border-color: #ddd;">

            <div class="form-group">
                <label for="content">Content *</label>
                <textarea id="content" name="content" rows="15">{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <span style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="featured_image">Thumbnail Image (Featured)</label>
                @if($blog->image)
                    <div style="margin-bottom: 12px;">
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Current featured image"
                            style="max-width: 200px; height: auto; border-radius: 8px; border: 1px solid #ddd;">
                        <p style="font-size: 12px; color: #666; margin-top: 4px;">Current image (leave file empty to keep)</p>
                    </div>
                @endif
                <input type="file" id="featured_image" name="featured_image" accept="image/*">
                <small style="color: #666; display: block; margin-top: 5px;">JPG, PNG, WEBP up to 10MB</small>
                @error('featured_image')
                    <span style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="gallery_images">Gallery Images (Max 9)</label>
                @if($blog->gallery_images && count($blog->gallery_images) > 0)
                    <div style="margin-bottom: 15px;">
                        <p style="font-size: 13px; color: #555; margin-bottom: 8px;">Existing gallery photos (select "Delete" to remove):</p>
                        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                            @foreach($blog->gallery_images as $index => $gImg)
                                <div style="position: relative; border: 1px solid #ddd; border-radius: 8px; padding: 6px; background: #fafafa; text-align: center;">
                                    <img src="{{ asset('storage/' . $gImg) }}" alt="Gallery"
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px; display: block;">
                                    <label style="font-size: 11px; color: #dc3545; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 4px; margin-top: 6px;">
                                        <input type="checkbox" name="delete_gallery_images[]" value="{{ $index }}"> Delete
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                <small style="color: #666; display: block; margin-top: 5px;">Upload new images to add to gallery. (JPG, PNG, WEBP up to 10MB each)</small>
                @error('gallery_images')
                    <span style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                    <span>Publish Immediately (Checked = visible on website)</span>
                </label>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
                    <span>Featured Post (Top highlighted post)</span>
                </label>
            </div>

            <div class="form-actions" style="margin-top: 30px;">
                <button type="submit" id="submitBtn" class="btn btn-primary" style="padding: 12px 28px; font-size: 16px;">Update Blog Post</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        if (typeof $.fn.summernote !== 'undefined') {
            $('#content').summernote({
                height: 300,
                placeholder: 'Write your blog post content here...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['codeview', 'help']]
                ]
            });
        }

        $('form').on('submit', function(e) {
            if (typeof $.fn.summernote !== 'undefined' && $('#content').data('summernote')) {
                var code = $('#content').summernote('code');
                if ($('#content').summernote('isEmpty')) {
                    $('#content').val('');
                } else {
                    $('#content').val(code);
                }
            }

            var textContent = $('#content').val().trim();
            if (!textContent) {
                e.preventDefault();
                alert('Please enter some content for the blog post.');
                if (typeof $.fn.summernote !== 'undefined' && $('#content').data('summernote')) {
                    $('#content').summernote('focus');
                } else {
                    $('#content').focus();
                }
                return false;
            }

            setTimeout(function() {
                $('#submitBtn').prop('disabled', true).text('Updating Blog Post...');
            }, 50);

            return true;
        });
    });
</script>
@endsection
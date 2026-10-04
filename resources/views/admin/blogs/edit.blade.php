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
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category *</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Wedding Planning" {{ old('category', $blog->category) == 'Wedding Planning' ? 'selected' : '' }}>Wedding Planning</option>
                    <option value="Corporate Events" {{ old('category', $blog->category) == 'Corporate Events' ? 'selected' : '' }}>Corporate Events</option>
                    <option value="Decor Trends" {{ old('category', $blog->category) == 'Decor Trends' ? 'selected' : '' }}>
                        Decor Trends</option>
                    <option value="Catering" {{ old('category', $blog->category) == 'Catering' ? 'selected' : '' }}>Catering
                    </option>
                    <option value="Budget Tips" {{ old('category', $blog->category) == 'Budget Tips' ? 'selected' : '' }}>
                        Budget Tips</option>
                    <option value="Venue Guide" {{ old('category', $blog->category) == 'Venue Guide' ? 'selected' : '' }}>
                        Venue Guide</option>
                    <option value="Planning Tips" {{ old('category', $blog->category) == 'Planning Tips' ? 'selected' : '' }}>
                        Planning Tips</option>
                </select>
                @error('category')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="excerpt">Excerpt *</label>
                <textarea id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                @error('excerpt')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content *</label>
                <textarea id="content" name="content" rows="15" required>{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                @if($blog->featured_image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Current"
                            style="max-width: 200px; border-radius: 8px;">
                        <p style="font-size: 13px; color: #666; margin-top: 5px;">Current image</p>
                    </div>
                @endif
                <input type="file" id="featured_image" name="featured_image" accept="image/*">
                @error('featured_image')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                    <span>Publish</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Blog Post</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
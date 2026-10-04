@extends('admin.layouts.app')

@section('page-title', 'Edit Venue')

@section('content')
    <div class="form-card">
        <h2 style="margin-bottom: 30px; font-size: 24px; font-weight: 700;">Edit Venue</h2>

        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Venue Name / Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required>
                @error('title')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" rows="4"
                    required>{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Venue Main Image</label>
                @if($service->image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="Current"
                            style="max-width: 200px; border-radius: 8px;">
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*">
                <small style="color: #666;">Leave empty to keep current image</small>
            </div>

            <div class="form-group"
                style="background: #fdfaf5; padding: 20px; border-radius: 12px; border: 1px solid #eee;">
                <label style="color: #D4A853; font-weight: 700; margin-bottom: 15px; display: block;">💰 Starting
                    Price</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="font-size: 13px;">Minimum Price</label>
                        <input type="text" name="features[]" value="{{ old('features.0', $service->features[0] ?? '') }}"
                            placeholder="e.g., Rs. 50,000">
                    </div>
                    <div>
                        <label style="font-size: 13px;">Maximum Price</label>
                        <input type="text" name="features[]" value="{{ old('features.1', $service->features[1] ?? '') }}"
                            placeholder="e.g., Rs. 75,000">
                    </div>
                </div>
            </div>

            <div class="form-group"
                style="background: #e8f4f8; padding: 20px; border-radius: 12px; border: 1px solid #d1e9f0; margin-top: 20px;">
                <label style="color: #2980b9; font-weight: 700; margin-bottom: 15px; display: block;">📍 Venue
                    Location</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="font-size: 13px;">Location Button Text</label>
                        <input type="text" id="button_text" name="button_text"
                            value="{{ old('button_text', $service->button_text ?? 'View Location') }}"
                            placeholder="e.g., View on Map">
                    </div>
                    <div>
                        <label style="font-size: 13px;">Google Maps Link</label>
                        <input type="text" id="button_link" name="button_link"
                            value="{{ old('button_link', $service->button_link) }}"
                            placeholder="Paste Google Maps URL here">
                    </div>
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', $service->order) }}" min="0">
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                    <span>Visible on Website</span>
                </label>
            </div>

            <div class="form-actions" style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 20px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 40px; border-radius: 30px;">Update
                    Venue</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary"
                    style="padding: 12px 40px; border-radius: 30px;">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description', {
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'RemoveFormat'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
                { name: 'links', items: ['Link', 'Unlink'] }
            ],
            height: 300
        });
    </script>
@endsection

@push('styles')
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endpush
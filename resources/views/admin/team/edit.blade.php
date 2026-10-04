@extends('admin.layouts.app')

@section('page-title', 'Edit Team Member')

@section('content')
    <div class="form-card">
        <h2 style="margin-bottom: 30px; font-size: 24px; font-weight: 700;">Edit Team Member</h2>

        <form method="POST" action="{{ route('admin.team.update', $team) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $team->name) }}" required>
                @error('name')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="designation">Designation *</label>
                <input type="text" id="designation" name="designation" value="{{ old('designation', $team->designation) }}"
                    required>
                @error('designation')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Photo</label>
                @if($team->image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $team->image) }}" alt="Current"
                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*">
                <small style="color: #666;">Leave empty to keep current photo</small>
            </div>

            <div class="form-group">
                <label for="bio">Bio (Optional)</label>
                <textarea id="bio" name="bio" rows="4">{{ old('bio', $team->bio) }}</textarea>
            </div>

            <div class="form-group">
                <label for="whatsapp">WhatsApp Number</label>
                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $team->whatsapp) }}"
                    placeholder="e.g., 923001234567">
                <small style="color: #666;">Enter number with country code (without +)</small>
            </div>

            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', $team->order) }}" min="0">
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $team->is_active) ? 'checked' : '' }}>
                    <span>Active (Show on website)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Team Member</button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
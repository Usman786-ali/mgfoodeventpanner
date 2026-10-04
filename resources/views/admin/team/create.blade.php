@extends('admin.layouts.app')

@section('page-title', 'Add Team Member')

@section('content')
    <div class="form-card">
        <h2 style="margin-bottom: 30px; font-size: 24px; font-weight: 700;">Add New Team Member</h2>

        <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g., John Doe">
                @error('name')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="designation">Designation *</label>
                <input type="text" id="designation" name="designation" value="{{ old('designation') }}" required
                    placeholder="e.g., CEO & Founder">
                @error('designation')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Photo *</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                <small style="color: #666;">Recommended: Square image (500x500px)</small>
                @error('image')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="bio">Bio (Optional)</label>
                <textarea id="bio" name="bio" rows="4">{{ old('bio') }}</textarea>
                <small style="color: #666;">Short description about the team member</small>
            </div>

            <div class="form-group">
                <label for="whatsapp">WhatsApp Number</label>
                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}"
                    placeholder="e.g., 923001234567">
                <small style="color: #666;">Enter number with country code (without +)</small>
            </div>

            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                <small style="color: #666;">Lower number appears first</small>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span>Active (Show on website)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add Team Member</button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
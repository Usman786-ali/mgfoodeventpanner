@extends('admin.layouts.app')

@section('page-title', 'Add New Event Type')

@section('content')
    <div class="page-header">
        <h1>Add New Event Type</h1>
        <a href="{{ route('admin.event-types.index') }}" class="btn btn-secondary">← Back to List</a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.event-types.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Event Type Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    placeholder="e.g., Wedding, Corporate Event, Birthday Party">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                <small style="color: #666;">Lower numbers appear first in the dropdown</small>
            </div>

            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span>Active (Show in contact form)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Event Type</button>
                <a href="{{ route('admin.event-types.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .checkbox-label input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }
    </style>
@endpush
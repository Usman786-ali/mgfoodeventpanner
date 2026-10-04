@extends('admin.layouts.app')

@section('page-title', 'Manage Event Types')

@section('content')
    <div class="page-header">
        <h1>Manage Event Types</h1>
        <a href="{{ route('admin.contact-form.index') }}" class="btn btn-secondary">← Back to Submissions</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div
        style="background: #e8f4f8; padding: 20px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #3498db;">
        <p style="margin: 0; color: #2c3e50;">
            <strong>💡 Info:</strong> Event types appear in the contact form dropdown. You can add, edit, or remove them
            here.
        </p>
    </div>

    <!-- Add New Event Type Form -->
    <div class="form-card" style="margin-bottom: 30px;">
        <h3 style="margin: 0 0 20px; color: #2c3e50;">➕ Add New Event Type</h3>
        <form action="{{ route('admin.contact-form.event-types.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 15px; align-items: end;">
                <div class="form-group">
                    <label for="name">Event Type Name *</label>
                    <input type="text" id="name" name="name" required placeholder="e.g., Wedding, Corporate Event">
                </div>
                <div class="form-group">
                    <label for="order">Order</label>
                    <input type="number" id="order" name="order" value="0" min="0">
                </div>
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>

    <!-- Existing Event Types List -->
    <div class="table-card">
        <h3 style="margin: 0 0 20px; color: #2c3e50;">📋 Existing Event Types</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 60px;">Order</th>
                    <th>Event Type Name</th>
                    <th style="width: 100px;">Status</th>
                    <th style="width: 200px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eventTypes as $type)
                    <tr>
                        <td>{{ $type->order }}</td>
                        <td>
                            <form action="{{ route('admin.contact-form.event-types.update', $type) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $type->name }}"
                                    style="border: 1px solid #ddd; padding: 8px; border-radius: 6px; width: 100%;"
                                    onchange="this.form.submit()">
                                <input type="hidden" name="order" value="{{ $type->order }}">
                                <input type="hidden" name="is_active" value="{{ $type->is_active ? '1' : '0' }}">
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.contact-form.event-types.update', $type) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" value="{{ $type->name }}">
                                <input type="hidden" name="order" value="{{ $type->order }}">
                                <label class="checkbox-label" style="margin: 0;">
                                    <input type="checkbox" name="is_active" value="1" {{ $type->is_active ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    <span>Active</span>
                                </label>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons">
                                <form action="{{ route('admin.contact-form.event-types.update', $type) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name" value="{{ $type->name }}">
                                    <input type="number" name="order" value="{{ $type->order }}"
                                        style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;"
                                        onchange="this.form.submit()">
                                    <input type="hidden" name="is_active" value="{{ $type->is_active ? '1' : '0' }}">
                                </form>
                                <form action="{{ route('admin.contact-form.event-types.destroy', $type) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this event type?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Delete">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px; color: #999;">
                            No event types found. Add one using the form above.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('styles')
    <style>
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .checkbox-label input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            align-items: center;
        }

        .btn-icon {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .btn-icon:hover {
            background: #f0f0f0;
        }

        .btn-delete:hover {
            background: #ffe6e6;
        }
    </style>
@endpush
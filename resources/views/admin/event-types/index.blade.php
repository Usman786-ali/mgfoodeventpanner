@extends('admin.layouts.app')

@section('page-title', 'Event Types')

@section('content')
    <div class="page-header">
        <h1>Event Types Management</h1>
        <a href="{{ route('admin.event-types.create') }}" class="btn btn-primary">
            <span style="font-size: 18px;">+</span> Add New Event Type
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-card">
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
                        <td><strong>{{ $type->name }}</strong></td>
                        <td>
                            @if($type->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons">
                                <a href="{{ route('admin.event-types.edit', $type) }}" class="btn-icon btn-edit" title="Edit">
                                    ✏️
                                </a>
                                <form action="{{ route('admin.event-types.destroy', $type) }}" method="POST"
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
                            No event types found. Click "Add New Event Type" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="background: #e8f4f8; padding: 20px; border-radius: 12px; margin-top: 30px; border-left: 4px solid #3498db;">
        <p style="margin: 0; color: #2c3e50;">
            <strong>💡 Tip:</strong> Event types appear in the contact form dropdown. You can reorder them by changing the
            "Order" value.
        </p>
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

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
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
@extends('admin.layouts.app')

@section('page-title', 'Contact Form Submissions')

@section('content')
    <div class="page-header">
        <h1>Contact Form Submissions</h1>
        <a href="{{ route('admin.contact-form.event-types') }}" class="btn btn-secondary">
            📋 Manage Event Types
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div style="margin-bottom: 30px; max-width: 600px;">
        <!-- Notification Settings -->
        <div class="table-card" style="padding: 20px; background: #fff8f0; border-left: 4px solid #f39c12; margin: 0;">
            <h3 style="margin: 0 0 15px; color: #d35400; font-size: 18px;">📧 Notification Settings</h3>

            <!-- Recipient Email -->
            <form action="{{ route('admin.contact-form.update-email') }}" method="POST">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Notification Email
                        (Record copy)</label>
                    <input type="email" name="contact_form_email"
                        value="{{ \App\Models\SiteSetting::where('key', 'contact_form_email')->first()->value ?? '' }}"
                        required placeholder="e.g., info@mgfoodevent.com"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Update Email</button>
            </form>

            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

            <!-- WhatsApp Configuration -->
            <form action="{{ route('admin.contact-form.update-smtp') }}" method="POST">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">WhatsApp Number
                        (Format: 923001234567)</label>
                    <input type="text" name="admin_whatsapp_number"
                        value="{{ \App\Models\SiteSetting::where('key', 'admin_whatsapp_number')->first()->value ?? '' }}"
                        required placeholder="923001234567"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                <button type="submit" class="btn btn-success"
                    style="width: 100%; background: #25d366; border-color: #25d366; color: white; padding: 10px; border-radius: 8px; font-weight: 600; border: none; cursor: pointer;">Update
                    WhatsApp Number</button>
            </form>
        </div>
    </div>

    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card"
            style="background: #e3f2fd; padding: 20px; border-radius: 12px; border-left: 4px solid #2196f3;">
            <h3 style="margin: 0; color: #1976d2; font-size: 32px;">{{ $submissions->total() }}</h3>
            <p style="margin: 5px 0 0; color: #666;">Total Submissions</p>
        </div>
        <div class="stat-card"
            style="background: #fff3e0; padding: 20px; border-radius: 12px; border-left: 4px solid #ff9800;">
            <h3 style="margin: 0; color: #f57c00; font-size: 32px;">{{ $submissions->where('status', 'new')->count() }}</h3>
            <p style="margin: 5px 0 0; color: #666;">New/Unread</p>
        </div>
        <div class="stat-card"
            style="background: #e8f5e9; padding: 20px; border-radius: 12px; border-left: 4px solid #4caf50;">
            <h3 style="margin: 0; color: #388e3c; font-size: 32px;">{{ $submissions->where('status', 'read')->count() }}
            </h3>
            <p style="margin: 5px 0 0; color: #666;">Read</p>
        </div>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 80px;">Status</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Event Type</th>
                    <th>Event Date</th>
                    <th style="width: 150px;">Submitted</th>
                    <th style="width: 150px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $submission)
                    <tr style="{{ $submission->status === 'new' ? 'background: #fff9e6;' : '' }}">
                        <td>
                            @if($submission->status === 'new')
                                <span class="badge badge-new">New</span>
                            @else
                                <span class="badge badge-read">Read</span>
                            @endif
                        </td>
                        <td><strong>{{ $submission->name }}</strong></td>
                        <td>{{ $submission->email }}</td>
                        <td>{{ $submission->phone ?? '-' }}</td>
                        <td>{{ $submission->event_type ?? '-' }}</td>
                        <td>{{ $submission->event_date ? $submission->event_date->format('M d, Y') : '-' }}</td>
                        <td style="font-size: 13px; color: #666;">{{ $submission->created_at->diffForHumans() }}</td>
                        <td style="text-align: right;">
                            <div class="action-buttons">
                                <a href="{{ route('admin.contact-form.show', $submission) }}" class="btn-icon btn-view"
                                    title="View Details">
                                    👁️
                                </a>
                                <form action="{{ route('admin.contact-form.destroy', $submission) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this submission?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Delete">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #999;">
                            No submissions yet. Submissions will appear here when users fill the contact form.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($submissions->hasPages())
        <div style="margin-top: 20px;">
            {{ $submissions->links() }}
        </div>
    @endif
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

        .badge-new {
            background: #fff3cd;
            color: #856404;
        }

        .badge-read {
            background: #d4edda;
            color: #155724;
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

        .btn-view:hover {
            background: #e3f2fd;
        }
    </style>
@endpush
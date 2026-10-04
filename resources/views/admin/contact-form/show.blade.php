@extends('admin.layouts.app')

@section('page-title', 'Submission Details')

@section('content')
    <div class="page-header">
        <h1>Submission Details</h1>
        <a href="{{ route('admin.contact-form.index') }}" class="btn btn-secondary">← Back to List</a>
    </div>

    <div class="form-card">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
            <div>
                <h3 style="margin: 0 0 20px; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px;">
                    Contact Information
                </h3>

                <div class="info-row">
                    <label>Full Name:</label>
                    <strong>{{ $submission->name }}</strong>
                </div>

                <div class="info-row">
                    <label>Email Address:</label>
                    <strong><a href="mailto:{{ $submission->email }}"
                            style="color: #3498db;">{{ $submission->email }}</a></strong>
                </div>

                <div class="info-row">
                    <label>Phone Number:</label>
                    <strong>{{ $submission->phone ?? 'Not provided' }}</strong>
                </div>

                <div class="info-row">
                    <label>Status:</label>
                    @if($submission->status === 'new')
                        <span class="badge badge-new">New</span>
                    @else
                        <span class="badge badge-read">Read</span>
                    @endif
                </div>
            </div>

            <div>
                <h3 style="margin: 0 0 20px; color: #2c3e50; border-bottom: 2px solid #e67e22; padding-bottom: 10px;">
                    Event Details
                </h3>

                <div class="info-row">
                    <label>Event Type:</label>
                    <strong>{{ $submission->event_type ?? 'Not specified' }}</strong>
                </div>

                <div class="info-row">
                    <label>Event Date:</label>
                    <strong>{{ $submission->event_date ? $submission->event_date->format('F d, Y') : 'Not specified' }}</strong>
                </div>

                <div class="info-row">
                    <label>Budget Range:</label>
                    <strong>{{ $submission->budget ?? 'Not specified' }}</strong>
                </div>

                <div class="info-row">
                    <label>Submitted:</label>
                    <strong>{{ $submission->created_at->format('M d, Y h:i A') }}</strong>
                    <small style="color: #666;">({{ $submission->created_at->diffForHumans() }})</small>
                </div>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <h3 style="margin: 0 0 15px; color: #2c3e50; border-bottom: 2px solid #27ae60; padding-bottom: 10px;">
                Event Vision & Details
            </h3>
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #27ae60;">
                <p style="margin: 0; white-space: pre-wrap; line-height: 1.6;">
                    {{ $submission->message ?? 'No message provided.' }}</p>
            </div>
        </div>

        <div class="form-actions" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            <a href="mailto:{{ $submission->email }}?subject=Re: Your Event Inquiry" class="btn btn-primary">
                📧 Reply via Email
            </a>
            <form action="{{ route('admin.contact-form.destroy', $submission) }}" method="POST" style="display: inline;"
                onsubmit="return confirm('Are you sure you want to delete this submission?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete Submission</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .info-row {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .info-row label {
            display: block;
            color: #666;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .info-row strong {
            color: #2c3e50;
            font-size: 15px;
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

        .btn-danger {
            background: #dc3545;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-danger:hover {
            background: #c82333;
        }
    </style>
@endpush
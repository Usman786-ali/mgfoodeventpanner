@extends('admin.layouts.app')

@section('page-title', isset($type) && $type ? 'Edit Type' : 'Add Type')

@section('content')
    <div class="page-header">
        <h1>{{ isset($type) && $type ? 'Edit Type: '.$type->name : 'Add New Type' }}</h1>
        <a href="{{ route('admin.estimator.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="form-card">
        <form method="POST"
              action="{{ isset($type) && $type ? route('admin.estimator.type.update', $type) : route('admin.estimator.type.store') }}">
            @csrf
            @if(isset($type) && $type) @method('PUT') @endif

            <div class="form-group">
                <label>Type Name <span class="req">*</span></label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $type->name ?? '') }}" placeholder="e.g. Decor" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Icon (emoji)</label>
                    <input type="text" name="icon" class="form-control"
                           value="{{ old('icon', $type->icon ?? '') }}" placeholder="e.g. 🎨">
                </div>
                <div class="form-group">
                    <label>Base Price (PKR) <span class="req">*</span></label>
                    <input type="number" name="base_price" class="form-control"
                           value="{{ old('base_price', $type->base_price ?? 0) }}" min="0" required>
                </div>
                <div class="form-group">
                    <label>Order</label>
                    <input type="number" name="order" class="form-control"
                           value="{{ old('order', $type->order ?? 0) }}">
                </div>
            </div>

            <div class="form-group">
                <label class="toggle-label">
                    <input type="checkbox" name="is_active"
                           {{ old('is_active', $type->is_active ?? true) ? 'checked' : '' }}>
                    <span>Active (show on website)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    {{ isset($type) && $type ? 'Update Type' : 'Create Type' }}
                </button>
                <a href="{{ route('admin.estimator.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('styles')
<style>
    .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; }
    .page-header h1 { font-size:24px; font-weight:800; color:#1a1a2e; }
    .form-card { background:#fff; border:1px solid #e8e8e8; border-radius:12px; padding:30px; max-width:700px; }
    .form-group { margin-bottom:20px; }
    .form-group label { display:block; font-weight:600; margin-bottom:6px; color:#333; font-size:14px; }
    .form-row { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; }
    .form-control { width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:14px; box-sizing:border-box; }
    .form-control:focus { outline:none; border-color:#D4A853; }
    .req { color:#e74c3c; }
    .toggle-label { display:flex; align-items:center; gap:10px; cursor:pointer; font-weight:600; }
    .form-actions { display:flex; gap:12px; margin-top:24px; }
    .btn-secondary { background:#f0f0f0; color:#333; padding:10px 22px; border-radius:8px; text-decoration:none; font-weight:600; }
</style>
@endpush

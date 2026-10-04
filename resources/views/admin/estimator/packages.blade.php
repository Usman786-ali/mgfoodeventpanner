@extends('admin.layouts.app')

@section('page-title', $type->name . ' – Packages')

@section('content')
    <div class="page-header">
        <h1>{{ $type->icon }} {{ $type->name }} — Packages</h1>
        <a href="{{ route('admin.estimator.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Existing packages --}}
    @forelse($packages as $pkg)
        <div class="pkg-card">
            <form method="POST" action="{{ route('admin.estimator.package.update', [$type, $pkg]) }}">
                @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $pkg->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>Price (PKR)</label>
                        <input type="number" name="price" class="form-control" value="{{ $pkg->price }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $pkg->order }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" value="{{ $pkg->description }}">
                </div>
                <div class="form-row-actions">
                    <label class="toggle-label">
                        <input type="checkbox" name="per_head" {{ $pkg->per_head ? 'checked' : '' }}>
                        <span>Per Head (uncheck = Fixed)</span>
                    </label>
                    <div style="display:flex;gap:10px;">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                </div>
            </form>
            <form method="POST" action="{{ route('admin.estimator.package.destroy', [$type, $pkg]) }}"
                  style="display:inline;" onsubmit="return confirm('Delete this package?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    @empty
        <p style="color:#888;margin-bottom:20px;">No packages yet. Add one below.</p>
    @endforelse

    {{-- Add new package --}}
    <div class="pkg-card" style="border:2px dashed #D4A853;">
        <h3 style="margin-bottom:16px;color:#D4A853;">+ Add New Package</h3>
        <form method="POST" action="{{ route('admin.estimator.package.store', $type) }}">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Name <span class="req">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Basic Decor" required>
                </div>
                <div class="form-group">
                    <label>Price (PKR) <span class="req">*</span></label>
                    <input type="number" name="price" class="form-control" placeholder="e.g. 1200" min="0" required>
                </div>
                <div class="form-group">
                    <label>Order</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" placeholder="Short description">
            </div>
            <div class="form-row-actions">
                <label class="toggle-label">
                    <input type="checkbox" name="per_head" checked>
                    <span>Per Head (uncheck = Fixed)</span>
                </label>
                <button type="submit" class="btn btn-primary">Add Package</button>
            </div>
        </form>
    </div>
@endsection

@section('styles')
<style>
    .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
    .page-header h1 { font-size:22px; font-weight:800; color:#1a1a2e; }
    .pkg-card { background:#fff; border:1px solid #e8e8e8; border-radius:12px; padding:20px 24px; margin-bottom:16px; }
    .form-row { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; }
    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-weight:600; margin-bottom:5px; font-size:13px; color:#444; }
    .form-control { width:100%; padding:9px 12px; border:1px solid #ddd; border-radius:8px; font-size:14px; box-sizing:border-box; }
    .form-control:focus { outline:none; border-color:#D4A853; }
    .form-row-actions { display:flex; justify-content:space-between; align-items:center; margin-top:8px; }
    .toggle-label { display:flex; align-items:center; gap:8px; font-size:13px; cursor:pointer; }
    .btn-sm { padding:7px 16px; font-size:13px; }
    .req { color:#e74c3c; }
    .btn-secondary { background:#f0f0f0; color:#333; padding:9px 20px; border-radius:8px; text-decoration:none; font-weight:600; font-size:14px; }
</style>
@endsection

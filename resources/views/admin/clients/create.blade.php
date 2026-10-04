@extends('admin.layouts.app')

@section('title', 'Add New Client')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Add New Client Logo</h1>
        <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Clients
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Client Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Client Logo <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo" accept="image/*" required>
                            <small class="text-muted">Accepted formats: JPG, PNG, GIF, SVG (Max: 2MB)</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Logo Number / Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', 0) }}">
                            <small class="text-muted">Assigned number for logo sequence (e.g. 1, 2, 3...)</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" 
                                   name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (Display on website)
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Save Client
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-info-circle"></i> Tips
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Use PNG format with transparent background</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Recommended size: 200x100px</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Keep file size under 500KB</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Use high-quality logos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

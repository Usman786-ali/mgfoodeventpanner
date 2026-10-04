@extends('admin.layouts.app')

@section('title', 'Edit Client')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Client Logo</h1>
        <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Clients
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.clients.update', $client) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Client Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $client->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Client Logo</label>
                            <div class="mb-2">
                                <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" 
                                     style="max-width: 200px; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            </div>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo" accept="image/*">
                            <small class="text-muted">Leave empty to keep current logo</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Logo Number / Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', $client->order) }}">
                            <small class="text-muted">Assigned number for logo sequence (e.g. 1, 2, 3...)</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" 
                                   name="is_active" {{ old('is_active', $client->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (Display on website)
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Client
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-info-circle"></i> Current Details
                </div>
                <div class="card-body">
                    <p><strong>Created:</strong> {{ $client->created_at->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ $client->updated_at->format('M d, Y') }}</p>
                    <p><strong>Status:</strong>  
                        @if($client->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Manage Clients')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Client Logos</h1>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New Client
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th width="120">Logo</th>
                                <th>Client Name</th>
                                <th width="100">Status</th>
                                <th width="180">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $index => $client)
                                <tr>
                                    <td style="font-weight: bold; color: #1a1a2e;">{{ $loop->iteration }}</td>
                                    <td>
                                        <div
                                            style="background: #f8f9fa; padding: 10px; border-radius: 8px; border: 1px solid #eee; display: inline-block;">
                                            <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}"
                                                style="max-width: 80px; height: auto; display: block;">
                                        </div>
                                    </td>
                                    <td>{{ $client->name }}</td>
                                    <td>
                                        @if($client->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.clients.destroy', $client) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this client?');"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <p class="text-muted">No clients found. Add your first client logo!</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
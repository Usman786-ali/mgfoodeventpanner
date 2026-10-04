@extends('admin.layouts.app')

@section('page-title', 'Venues Management')

@section('content')
    <div class="page-header">
        <h1>Venues Management</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Create New Venue</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr>
                        <td>{{ $service->order }}</td>
                        <td><strong>{{ $service->title }}</strong></td>
                        <td>
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                    style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $service->is_active ? 'badge-success' : 'badge-draft' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn-edit">Edit</a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                    style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        style="padding: 8px 16px; font-size: 13px;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px;">
                            <p class="no-data">No venues yet. <a href="{{ route('admin.services.create') }}">Create your first
                                    venue →</a></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $services->links() }}
    </div>
@endsection

@push('styles')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: #1a1a2e;
        }
    </style>
@endpush
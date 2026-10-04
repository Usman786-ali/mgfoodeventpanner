@extends('admin.layouts.app')

@section('page-title', 'Portfolio Items')

@section('content')
    <div class="page-header">
        <h1>Portfolio Management</h1>
        <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary">+ Add Portfolio Item</a>
    </div>

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                        </td>
                        <td><strong>{{ $item->title }}</strong></td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->order }}</td>
                        <td>
                            <span class="badge {{ $item->is_active ? 'badge-success' : 'badge-draft' }}">
                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.portfolio.edit', $item) }}" class="btn-edit">Edit</a>
                                <form method="POST" action="{{ route('admin.portfolio.destroy', $item) }}"
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
                        <td colspan="6" style="text-align: center; padding: 40px;">
                            <p class="no-data">No portfolio items yet. <a href="{{ route('admin.portfolio.create') }}">Add your
                                    first item →</a></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $items->links() }}
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
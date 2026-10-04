@extends('admin.layouts.app')

@section('page-title', 'Team Members')

@section('content')
    <div class="page-header">
        <h1>Team Members Management</h1>
        <a href="{{ route('admin.team.create') }}" class="btn btn-primary">+ Add Team Member</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teamMembers as $member)
                    <tr>
                        <td>{{ $member->order }}</td>
                        <td>
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            @endif
                        </td>
                        <td><strong>{{ $member->name }}</strong></td>
                        <td>{{ $member->designation }}</td>
                        <td>
                            <span class="badge {{ $member->is_active ? 'badge-success' : 'badge-draft' }}">
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.team.edit', $member) }}" class="btn-edit">Edit</a>
                                <form method="POST" action="{{ route('admin.team.destroy', $member) }}" style="display: inline;"
                                    onsubmit="return confirm('Are you sure?')">
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
                            <p class="no-data">No team members yet. <a href="{{ route('admin.team.create') }}">Add your first
                                    team member →</a></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $teamMembers->links() }}
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

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
@endpush
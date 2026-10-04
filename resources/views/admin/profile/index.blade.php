@extends('admin.layouts.app')

@section('page-title', 'Profile Settings')

@section('content')
    <div class="page-header">
        <h1>👤 Profile Settings</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success"
            style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger"
            style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
            <ul style="margin: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="max-width: 800px;">
        <div class="table-card"
            style="padding: 30px; background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 25px;">
                    <h3 style="margin: 0 0 15px; font-size: 18px; color: #333;">Personal Information</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                        </div>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email Address
                                (Username)</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                        </div>
                    </div>
                </div>

                <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

                <div style="margin-bottom: 25px;">
                    <h3 style="margin: 0 0 15px; font-size: 18px; color: #d35400;">🔐 Change Password</h3>
                    <p style="font-size: 13px; color: #666; margin-bottom: 15px;">Leave empty if you don't want to change
                        it.</p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">New Password</label>
                            <input type="password" name="password" placeholder="At least 8 characters"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                        </div>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Confirm New
                                Password</label>
                            <input type="password" name="password_confirmation" placeholder="Repeat new password"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                        </div>
                    </div>
                </div>

                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary"
                        style="padding: 12px 30px; font-weight: 600; font-size: 16px;">
                        💾 Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
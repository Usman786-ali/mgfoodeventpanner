@extends('admin.layouts.app')
@section('page-title', 'Add New Reel')

@section('content')
    <div style="max-width:700px; margin:0 auto;">
        <div style="background:#fff; border-radius:20px; padding:40px; box-shadow:0 4px 30px rgba(0,0,0,0.08);">
            <h2 style="margin:0 0 30px; color:#1a1a2e;">🎬 Add New Reel</h2>

            <form action="{{ route('admin.reels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom:22px;">
                    <label style="display:block; font-weight:600; color:#333; margin-bottom:8px;">Video Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        placeholder="e.g. Wedding Ceremony Highlights"
                        style="width:100%; padding:12px 16px; border:2px solid #e0e0e0; border-radius:12px; font-size:15px; outline:none; box-sizing:border-box;"
                        required>
                    @error('title') <p style="color:red; font-size:13px; margin-top:5px;">{{ $message }}</p> @enderror
                </div>

                <input type="hidden" name="type" value="link">
                <input type="hidden" name="platform" value="youtube">

                <div style="margin-bottom:22px;">
                    <label style="display:block; font-weight:600; color:#333; margin-bottom:8px;">YouTube Video URL
                        *</label>
                    <input type="text" name="embed_url" id="embed_url_input" value="{{ old('embed_url') }}"
                        placeholder="Paste YouTube or Shorts link here..."
                        style="width:100%; padding:12px 16px; border:2px solid #e0e0e0; border-radius:12px; font-size:15px; outline:none; box-sizing:border-box;"
                        required>
                    <p style="color:#888; font-size:12px; mt-2px;">💡 Example: https://www.youtube.com/watch?v=... or
                        https://youtube.com/shorts/...</p>
                    @error('embed_url') <p style="color:red; font-size:13px; margin-top:5px;">{{ $message }}</p> @enderror
                </div>

                <div style="margin-bottom:22px;">
                    <label style="display:block; font-weight:600; color:#333; margin-bottom:8px;">Video Thumbnail
                        (Image)</label>
                    <input type="file" name="thumbnail" accept="image/*"
                        style="width:100%; padding:10px; border:2px solid #e0e0e0; border-radius:12px; box-sizing:border-box;">
                    <p style="color:#888; font-size:12px; margin-top:6px;">💡 This image will show as the cover before the
                        video plays.</p>
                    @error('thumbnail') <p style="color:red; font-size:13px; margin-top:5px;">{{ $message }}</p> @enderror
                </div>

                <div style="margin-bottom:22px;">
                    <label style="display:block; font-weight:600; color:#333; margin-bottom:8px;">Display Order</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}"
                        style="width:120px; padding:12px 16px; border:2px solid #e0e0e0; border-radius:12px; font-size:15px; outline:none;">
                    <span style="color:#888; font-size:13px; margin-left:10px;">Chota number = pehle dikhaye ga</span>
                </div>

                <div style="margin-bottom:30px; display:flex; align-items:center; gap:12px;">
                    <input type="checkbox" name="is_active" id="is_active" checked
                        style="width:20px; height:20px; cursor:pointer; accent-color:#D4A853;">
                    <label for="is_active" style="font-weight:600; color:#333; cursor:pointer;">Active (Website par
                        dikhayein)</label>
                </div>

                <div style="display:flex; gap:14px;">
                    <button type="submit"
                        style="flex:1; background:#D4A853; color:#000; padding:14px; border:none; border-radius:12px; font-size:16px; font-weight:700; cursor:pointer;">
                        ✅ Save Reel
                    </button>
                    <a href="{{ route('admin.reels.index') }}"
                        style="flex:1; text-align:center; background:#f0f0f0; color:#333; padding:14px; border-radius:12px; text-decoration:none; font-size:16px; font-weight:600;">
                        ← Back
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
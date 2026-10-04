@extends('admin.layouts.app')
@section('page-title', 'Reels / Videos')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
        <h2 style="margin:0; color:#1a1a2e;">🎬 Manage Reels</h2>
        <a href="{{ route('admin.reels.create') }}"
            style="background:#D4A853; color:#000; padding:10px 24px; border-radius:50px; text-decoration:none; font-weight:700; display:inline-flex; align-items:center; gap:8px;">
            ➕ Add New Reel
        </a>
    </div>

    @if($reels->isEmpty())
        <div style="text-align:center; padding:80px 20px; background:#f9f9f9; border-radius:16px; border:2px dashed #ddd;">
            <div style="font-size:60px; margin-bottom:20px;">🎬</div>
            <h3 style="color:#666;">No Reels Added Yet</h3>
            <p style="color:#999;">Add your YouTube / Instagram reels to display on the website.</p>
            <a href="{{ route('admin.reels.create') }}"
                style="background:#D4A853; color:#000; padding:12px 30px; border-radius:50px; text-decoration:none; font-weight:700; margin-top:20px; display:inline-block;">
                ➕ Add First Reel
            </a>
        </div>
    @else
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap:24px;">
            @foreach($reels as $reel)
                <div
                    style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08); border:1px solid #f0f0f0;">
                    <div style="position:relative; padding-bottom:177.7%; height:0; overflow:hidden; background:#000;">
                        <iframe src="{{ $reel->embed_url }}"
                            style="position:absolute; top:0; left:0; width:100%; height:100%; border:none;"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    <div style="padding:16px;">
                        <h4 style="margin:0 0 8px; color:#1a1a2e; font-size:15px;">{{ $reel->title }}</h4>
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <span
                                style="background:{{ $reel->is_active ? '#d4edda' : '#f8d7da' }}; color:{{ $reel->is_active ? '#155724' : '#721c24' }}; padding:4px 12px; border-radius:50px; font-size:12px; font-weight:600;">
                                {{ $reel->is_active ? '✅ Active' : '❌ Hidden' }}
                            </span>
                            <span
                                style="background:#e8f4fd; color:#0066cc; padding:4px 12px; border-radius:50px; font-size:12px; font-weight:600; text-transform:uppercase;">
                                {{ $reel->platform }}
                            </span>
                        </div>
                        <div style="display:flex; gap:10px; margin-top:14px;">
                            <a href="{{ route('admin.reels.edit', $reel) }}"
                                style="flex:1; text-align:center; background:#1a1a2e; color:#fff; padding:9px; border-radius:10px; text-decoration:none; font-size:14px; font-weight:600;">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.reels.destroy', $reel) }}" method="POST" style="flex:1;"
                                onsubmit="return confirm('Delete this reel?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    style="width:100%; background:#dc3545; color:#fff; padding:9px; border:none; border-radius:10px; font-size:14px; font-weight:600; cursor:pointer;">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
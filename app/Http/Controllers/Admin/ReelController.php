<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReelController extends Controller
{
    public function index()
    {
        $reels = Reel::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.reels.index', compact('reels'));
    }

    public function create()
    {
        return view('admin.reels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:link,file',
            'platform' => 'required_if:type,link',
            'embed_url' => 'required_if:type,link',
            'video_file' => 'required_if:type,file|file|mimes:mp4,mov,ogg,qt|max:50000',
            'thumbnail' => 'nullable|image|max:5000',
            'order' => 'nullable|integer',
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('reels/thumbs', 'public');
        }

        if ($request->type === 'link') {
            $data['platform'] = $request->platform;
            $data['embed_url'] = Reel::convertToEmbedUrl($request->embed_url);
            $data['video_path'] = null;
        } else {
            if ($request->hasFile('video_file')) {
                $path = $request->file('video_file')->store('reels', 'public');
                $data['video_path'] = $path;
                $data['platform'] = 'local';
                $data['embed_url'] = null;
            }
        }

        Reel::create($data);

        return redirect()->route('admin.reels.index')->with('success', 'Reel added successfully!');
    }

    public function edit(Reel $reel)
    {
        return view('admin.reels.edit', compact('reel'));
    }

    public function update(Request $request, Reel $reel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:link,file',
            'platform' => 'required_if:type,link',
            'embed_url' => 'required_if:type,link',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:50000',
            'thumbnail' => 'nullable|image|max:5000',
            'order' => 'nullable|integer',
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('thumbnail')) {
            if ($reel->thumbnail) {
                Storage::disk('public')->delete($reel->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('reels/thumbs', 'public');
        }

        if ($request->type === 'link') {
            $data['platform'] = $request->platform;
            $data['embed_url'] = Reel::convertToEmbedUrl($request->embed_url);

            // Delete old file if switched to link
            if ($reel->video_path) {
                Storage::disk('public')->delete($reel->video_path);
                $data['video_path'] = null;
            }
        } else {
            $data['platform'] = 'local';
            $data['embed_url'] = null;

            if ($request->hasFile('video_file')) {
                // Delete old file
                if ($reel->video_path) {
                    Storage::disk('public')->delete($reel->video_path);
                }
                $path = $request->file('video_file')->store('reels', 'public');
                $data['video_path'] = $path;
            }
        }

        $reel->update($data);

        return redirect()->route('admin.reels.index')->with('success', 'Reel updated successfully!');
    }

    public function destroy(Reel $reel)
    {
        if ($reel->video_path) {
            Storage::disk('public')->delete($reel->video_path);
        }
        $reel->delete();
        return redirect()->route('admin.reels.index')->with('success', 'Reel deleted successfully!');
    }
}

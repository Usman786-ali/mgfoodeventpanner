<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(20);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            'event_date' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
        ];

        // Validate gallery images only if valid files were actually uploaded
        if ($request->hasFile('gallery_images')) {
            $rules['gallery_images'] = 'array|max:9';
            $rules['gallery_images.*'] = 'image|mimes:jpeg,png,jpg,webp,gif|max:10240';
        }

        $validated = $request->validate($rules);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog-images', 'public');
            $validated['image'] = $path;
            unset($validated['featured_image']);
        }

        // Handle gallery images upload (max 9)
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            $files = array_slice($request->file('gallery_images'), 0, 9);

            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('blog-gallery', 'public');
                    $galleryPaths[] = $path;
                }
            }

            $validated['gallery_images'] = !empty($galleryPaths) ? $galleryPaths : null;
        } else {
            $validated['gallery_images'] = null;
        }

        // Handle checkboxes
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['has_food'] = $request->has('has_food') ? 1 : 0;
        $validated['has_decor'] = $request->has('has_decor') ? 1 : 0;

        // Set category to client_name
        $validated['category'] = $validated['client_name'];

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully!');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'event_date' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
        ];

        // Validate featured image only if a new file is uploaded
        if ($request->hasFile('featured_image')) {
            $rules['featured_image'] = 'image|mimes:jpeg,png,jpg,webp,gif|max:10240';
        }

        // Validate gallery images only if new files are uploaded
        if ($request->hasFile('gallery_images')) {
            $rules['gallery_images'] = 'array|max:9';
            $rules['gallery_images.*'] = 'image|mimes:jpeg,png,jpg,webp,gif|max:10240';
        }

        $validated = $request->validate($rules);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if it exists in public storage
            if ($blog->image && file_exists(public_path('storage/' . $blog->image))) {
                @unlink(public_path('storage/' . $blog->image));
            }

            $path = $request->file('featured_image')->store('blog-images', 'public');
            $validated['image'] = $path;
            unset($validated['featured_image']);
        }

        // Handle gallery images
        $galleryPaths = $blog->gallery_images ?? [];

        // Handle deleted gallery images
        if ($request->has('delete_gallery_images')) {
            $deleteIndices = (array) $request->input('delete_gallery_images');
            $remainingGallery = [];
            foreach ($galleryPaths as $idx => $gPath) {
                if (in_array((string) $idx, $deleteIndices, true)) {
                    if (file_exists(public_path('storage/' . $gPath))) {
                        @unlink(public_path('storage/' . $gPath));
                    }
                } else {
                    $remainingGallery[] = $gPath;
                }
            }
            $galleryPaths = $remainingGallery;
        }

        // Add newly uploaded gallery images
        if ($request->hasFile('gallery_images')) {
            $files = $request->file('gallery_images');
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('blog-gallery', 'public');
                    $galleryPaths[] = $path;
                }
            }
        }

        // Keep at most 9 gallery images
        $validated['gallery_images'] = !empty($galleryPaths) ? array_values(array_slice($galleryPaths, -9)) : null;

        // Handle checkboxes
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['has_food'] = $request->has('has_food') ? 1 : 0;
        $validated['has_decor'] = $request->has('has_decor') ? 1 : 0;

        // Set category to client_name
        $validated['category'] = $validated['client_name'];

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        // Delete featured image
        if ($blog->image && file_exists(public_path('storage/' . $blog->image))) {
            @unlink(public_path('storage/' . $blog->image));
        }

        // Delete gallery images
        if ($blog->gallery_images) {
            foreach ($blog->gallery_images as $image) {
                if (file_exists(public_path('storage/' . $image))) {
                    @unlink(public_path('storage/' . $image));
                }
            }
        }

        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully!');
    }
}

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
        $validated = $request->validate([
            'title' => 'required|max:255',
            'client_name' => 'required|string|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'featured_image' => 'required|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
            'event_date' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog-images', 'public');
            $validated['image'] = $path;
            unset($validated['featured_image']);
        }

        // Handle gallery images upload (max 9)
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            $files = array_slice($request->file('gallery_images'), 0, 9); // Max 9 images

            foreach ($files as $file) {
                $path = $file->store('blog-gallery', 'public');
                $galleryPaths[] = $path;
            }

            $validated['gallery_images'] = $galleryPaths;
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
        $validated = $request->validate([
            'title' => 'required|max:255',
            'client_name' => 'required|string|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
            'event_date' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog-images', 'public');
            $validated['image'] = $path;
            unset($validated['featured_image']);
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = $blog->gallery_images ?? [];
            $files = array_slice($request->file('gallery_images'), 0, 9);

            foreach ($files as $file) {
                $path = $file->store('blog-gallery', 'public');
                $galleryPaths[] = $path;
            }

            // Keep only last 9 images
            $validated['gallery_images'] = array_slice($galleryPaths, -9);
        }

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
            unlink(public_path('storage/' . $blog->image));
        }

        // Delete gallery images
        if ($blog->gallery_images) {
            foreach ($blog->gallery_images as $image) {
                if (file_exists(public_path('storage/' . $image))) {
                    unlink(public_path('storage/' . $image));
                }
            }
        }

        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully!');
    }
}

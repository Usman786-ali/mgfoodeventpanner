<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoogleReview;
use Illuminate\Http\Request;

class GoogleReviewController extends Controller
{
    public function index()
    {
        $reviews = GoogleReview::ordered()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'review_date' => 'nullable|string|max:255',
            'author_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('author_photo')) {
            $file = $request->file('author_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/reviews'), $filename);
            $data['author_photo'] = 'uploads/reviews/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->order ?? 0;

        GoogleReview::create($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review added successfully!');
    }

    public function edit(GoogleReview $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, GoogleReview $review)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'review_date' => 'nullable|string|max:255',
            'author_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('author_photo')) {
            // Delete old photo
            if ($review->author_photo && file_exists(public_path($review->author_photo))) {
                unlink(public_path($review->author_photo));
            }

            $file = $request->file('author_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/reviews'), $filename);
            $data['author_photo'] = 'uploads/reviews/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->order ?? 0;

        $review->update($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review updated successfully!');
    }

    public function destroy(GoogleReview $review)
    {
        if ($review->author_photo && file_exists(public_path($review->author_photo))) {
            unlink(public_path($review->author_photo));
        }

        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $aboutSettings = AboutSetting::first();

        return view('admin.about.index', compact('aboutSettings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'vision_title' => 'nullable|string|max:255',
            'vision_description' => 'nullable|string',
            'vision_description2' => 'nullable|string',
            'mission_title' => 'nullable|string|max:100',
            'mission_text' => 'nullable|string',
            'value_title' => 'nullable|string|max:100',
            'value_text' => 'nullable|string',
            'stats_number' => 'nullable|string|max:50',
            'stats_label' => 'nullable|string|max:100',
            'vision_image' => 'nullable|image|max:5120',
            'decorate_title' => 'nullable|string|max:100',
            'decorate_text' => 'nullable|string',
            'food_title' => 'nullable|string|max:100',
            'food_text' => 'nullable|string',
            'venue_title' => 'nullable|string|max:100',
            'venue_text' => 'nullable|string',
        ]);

        $aboutSettings = AboutSetting::first();
        if (!$aboutSettings) {
            $aboutSettings = new AboutSetting();
        }

        // Handle image upload separately
        if ($request->hasFile('vision_image')) {
            $path = $request->file('vision_image')->store('about', 'public');
            $aboutSettings->vision_image = $path;
        }

        // Use validated data for other fields
        $aboutSettings->fill(collect($validated)->except('vision_image')->toArray());
        $aboutSettings->save();

        return redirect()->route('admin.about.index')->with('success', 'About page updated successfully!');
    }
}

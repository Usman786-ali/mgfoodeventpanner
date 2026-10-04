<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $items = PortfolioItem::ordered()->paginate(20);
        return view('admin.portfolio.index', compact('items'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'nullable',
            'image' => 'required|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolio', 'public');
            $validated['image'] = $path;
        }

        PortfolioItem::create($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio item created successfully!');
    }

    public function edit(PortfolioItem $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, PortfolioItem $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolio', 'public');
            $validated['image'] = $path;
        }

        $portfolio->update($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio item updated successfully!');
    }

    public function destroy(PortfolioItem $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio item deleted successfully!');
    }
}

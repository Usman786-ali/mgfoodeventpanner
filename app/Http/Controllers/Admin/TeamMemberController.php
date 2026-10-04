<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('order')->paginate(20);
        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'image' => 'required|image|max:2048',
            'bio' => 'nullable|string',
            'whatsapp' => 'nullable|string|max:20',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully!');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'image' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'whatsapp' => 'nullable|string|max:20',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully!');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->image && file_exists(public_path('storage/' . $team->image))) {
            unlink(public_path('storage/' . $team->image));
        }

        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully!');
    }
}

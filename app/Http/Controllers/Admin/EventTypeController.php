<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public function index()
    {
        $eventTypes = EventType::orderBy('order')->get();
        return view('admin.event-types.index', compact('eventTypes'));
    }

    public function create()
    {
        return view('admin.event-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:event_types,name',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? EventType::max('order') + 1;

        EventType::create($validated);

        return redirect()->route('admin.event-types.index')
            ->with('success', 'Event type created successfully!');
    }

    public function edit(EventType $eventType)
    {
        return view('admin.event-types.edit', compact('eventType'));
    }

    public function update(Request $request, EventType $eventType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:event_types,name,' . $eventType->id,
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $eventType->update($validated);

        return redirect()->route('admin.event-types.index')
            ->with('success', 'Event type updated successfully!');
    }

    public function destroy(EventType $eventType)
    {
        $eventType->delete();

        return redirect()->route('admin.event-types.index')
            ->with('success', 'Event type deleted successfully!');
    }
}

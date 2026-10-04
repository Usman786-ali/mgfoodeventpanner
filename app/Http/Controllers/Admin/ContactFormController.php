<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\EventType;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::latest()->paginate(20);
        $eventTypes = EventType::orderBy('order')->get();

        return view('admin.contact-form.index', compact('submissions', 'eventTypes'));
    }

    public function show(ContactSubmission $submission)
    {
        // Mark as read
        if ($submission->status === 'new') {
            $submission->update(['status' => 'read']);
        }

        return view('admin.contact-form.show', compact('submission'));
    }

    public function destroy(ContactSubmission $submission)
    {
        $submission->delete();
        return redirect()->route('admin.contact-form.index')
            ->with('success', 'Submission deleted successfully!');
    }

    // Event Types Management
    public function eventTypes()
    {
        $eventTypes = EventType::orderBy('order')->get();
        return view('admin.contact-form.event-types', compact('eventTypes'));
    }

    public function storeEventType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:event_types,name',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? EventType::max('order') + 1;

        EventType::create($validated);

        return redirect()->route('admin.contact-form.event-types')
            ->with('success', 'Event type created successfully!');
    }

    public function updateEventType(Request $request, EventType $eventType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:event_types,name,' . $eventType->id,
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $eventType->update($validated);

        return redirect()->route('admin.contact-form.event-types')
            ->with('success', 'Event type updated successfully!');
    }

    public function destroyEventType(EventType $eventType)
    {
        $eventType->delete();
        return redirect()->route('admin.contact-form.event-types')
            ->with('success', 'Event type deleted successfully!');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'contact_form_email' => 'required|email|max:255'
        ]);

        \App\Models\SiteSetting::updateOrCreate(
            ['key' => 'contact_form_email'],
            [
                'value' => $request->contact_form_email,
                'group' => 'contact',
                'type' => 'text'
            ]
        );

        return redirect()->back()->with('success', 'Notification email updated successfully!');
    }

    public function updateSmtp(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            \App\Models\SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value ?? '',
                    'group' => 'mail',
                    'type' => 'text'
                ]
            );
        }

        return redirect()->back()->with('success', 'SMTP Settings updated successfully!');
    }
}

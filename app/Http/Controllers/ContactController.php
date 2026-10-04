<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'event_type' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'budget' => 'nullable|string|max:255',
            'message' => 'nullable|string'
        ]);

        // Save to database
        $submission = ContactSubmission::create($validated);

        // Get Settings - including WhatsApp number
        $settings = \App\Models\SiteSetting::whereIn('key', ['admin_whatsapp_number', 'contact_form_email'])->get()->pluck('value', 'key');
        $whatsappNumber = $settings['admin_whatsapp_number'] ?? '923000000000';

        // Prepare WhatsApp Message
        $message = "*🎉 New Booking Inquiry - MG Food & Event*\n\n";
        $message .= "*👤 Name:* " . $submission->name . "\n";
        $message .= "*📞 Phone:* " . ($submission->phone ?? 'N/A') . "\n";

        if ($submission->email) {
            $message .= "*📧 Email:* " . $submission->email . "\n";
        }

        $message .= "*🎊 Event:* " . ($submission->event_type ?? 'N/A') . "\n";
        if ($submission->budget) {
            $message .= "*💰 Budget:* " . $submission->budget . "\n";
        }

        if ($submission->event_date) {
            $message .= "*📅 Date:* " . $submission->event_date->format('F d, Y') . "\n";
        }

        if ($submission->message) {
            $message .= "*💬 Message:* " . $submission->message;
        }

        $whatsappUrl = "https://wa.me/" . $whatsappNumber . "?text=" . urlencode($message);

        // Optional: Keep email as background if needed (silent)
        try {
            // ... silent email logic if needed
        } catch (\Exception $e) {
        }

        // Redirect user to WhatsApp
        return redirect()->away($whatsappUrl);
    }
}

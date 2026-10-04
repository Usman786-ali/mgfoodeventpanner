<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');

        // Ensure all groups exist
        if (!isset($settings['homepage']))
            $settings['homepage'] = collect([]);
        if (!isset($settings['contact']))
            $settings['contact'] = collect([]);
        if (!isset($settings['social']))
            $settings['social'] = collect([]);

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        set_time_limit(300); // 5 minutes limit for large files
        $homepageFields = [
            'hero_badge',
            'hero_title',
            'hero_highlight',
            'hero_description',
            'hero_btn1_text',
            'hero_btn1_link',
            'hero_btn2_text',
            'hero_btn2_link',
            'home_about_badge',
            'home_about_title',
            'home_about_description',
            'home_about_btn_text',
            'home_about_btn_link',
            'stat1_number',
            'stat1_label',
            'stat2_number',
            'stat2_label',
            'stat3_number',
            'stat3_label',
            'stat4_number',
            'stat4_label',
            'cta_title',
            'cta_description',
            'cta_btn_text',
            'cta_btn_link',
            // Home Media Fields
            'hero_video',
            'ceo_image',
            'director_image',
            'team_photo',
            'venue_hall_image',
            'event_setup_image',
            'wedding_feature_video'
        ];

        $contactFields = ['contact_phone', 'contact_whatsapp', 'contact_email', 'contact_address', 'contact_map_office', 'contact_map_kitchen'];
        $socialFields = ['social_facebook', 'social_instagram', 'social_youtube', 'social_tiktok', 'google_review_code', 'google_verification', 'google_analytics'];

        // Handle all inputs including text and files
        foreach ($request->all() as $key => $value) {
            if (in_array($key, ['_token', '_method']))
                continue;

            $group = $this->getGroup($key, $homepageFields, $contactFields, $socialFields);

            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('settings', 'public');

                // Determine type based on extension
                $extension = strtolower($file->getClientOriginalExtension());
                $type = in_array($extension, ['mp4', 'mov', 'webm', 'ogg']) ? 'video' : 'image';

                SiteSetting::set($key, $path, $type, $group);
            } elseif (in_array($key, array_merge($homepageFields, $contactFields, $socialFields))) {
                // Extract src if value contains iframe tag (useful if user pastes the whole embed code)
                if (!in_array($key, ['google_review_code', 'google_analytics']) && is_string($value) && str_contains($value, '<iframe')) {
                    preg_match('/src="([^"]+)"/', $value, $matches);
                    if (!empty($matches[1])) {
                        $value = $matches[1];
                    }
                }

                // Only save text value if it's a known field
                SiteSetting::set($key, $value, 'text', $group);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully!');
    }

    private function getGroup($key, $homepageFields, $contactFields, $socialFields)
    {
        if (in_array($key, $homepageFields))
            return 'homepage';
        if (in_array($key, $contactFields))
            return 'contact';
        if (in_array($key, $socialFields))
            return 'social';
        return 'general';
    }
}

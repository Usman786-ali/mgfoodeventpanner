<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\Client;
use App\Models\PortfolioItem;
use App\Models\Blog;
use App\Models\TeamMember;
use App\Models\AboutSetting;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Site Settings (Home Page)
        $settings = [
            // Hero Section
            ['key' => 'hero_badge', 'value' => '✨ Best Event Planner In Karachi', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_title', 'value' => 'Turning Special Moments Into Lasting Memories', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_highlight', 'value' => 'Lasting Memories', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_description', 'value' => "Experience elegance, taste, and perfection with MG Food & Event Planners, crafting moments you'll cherish forever.", 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_btn1_text', 'value' => 'Start Planning Now', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_btn1_link', 'value' => '/contact', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_btn2_text', 'value' => 'View Our Work', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_btn2_link', 'value' => '/portfolio', 'type' => 'text', 'group' => 'homepage'],

            // About Section
            ['key' => 'home_about_badge', 'value' => 'Who We Are', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'home_about_title', 'value' => "Pakistan's Premier Event Architects", 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'home_about_description', 'value' => "MG Food & Event Planner is a trusted and award-winning event management company in Pakistan, delivering exceptional events for over 15 years.\n\nWe specialize in wedding planning, corporate events, and luxury celebrations, creating flawless experiences that leave a lasting impression.", 'type' => 'textarea', 'group' => 'homepage'],
            ['key' => 'home_about_btn_text', 'value' => 'Discover Our Journey', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'home_about_btn_link', 'value' => '/about', 'type' => 'text', 'group' => 'homepage'],

            // Stats
            ['key' => 'stat1_number', 'value' => '500+', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'stat1_label', 'value' => 'Events Completed', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'stat2_number', 'value' => '15+', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'stat2_label', 'value' => 'Years Experience', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'stat3_number', 'value' => '50+', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'stat3_label', 'value' => 'Expert Team', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'stat4_number', 'value' => '100%', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'stat4_label', 'value' => 'Client Satisfaction', 'type' => 'text', 'group' => 'homepage'],

            // CTA Section
            ['key' => 'cta_title', 'value' => 'Make Your Event Unforgettable with <br><b>MG Food & Event Planner</b>', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'cta_description', 'value' => 'Book your consultation today and let us bring your vision to life!', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'cta_btn_text', 'value' => 'Book Your Event Now', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'cta_btn_link', 'value' => '/contact', 'type' => 'text', 'group' => 'homepage'],

            // Contact Info
            ['key' => 'contact_phone', 'value' => '+92 300 8849180', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '923008849180', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'info@mgfoodevent.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Office No. 1, Mezzanine Floor, Building No. 19-C, Phase 2 Extension, DHA, Karachi', 'type' => 'text', 'group' => 'contact'],

            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/mgfoodevent', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/mgfoodevent', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@mgfoodevent', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => 'https://tiktok.com/@mgfoodevent', 'type' => 'text', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        // Services
        $services = [
            [
                'title' => 'Corporate Events',
                'description' => 'Professional corporate event planning services including conferences, seminars, product launches, and team building activities. We ensure your corporate events reflect your brand excellence.',
                'image' => null,
                'features' => json_encode([
                    'Conference Management',
                    'Product Launches',
                    'Team Building Events',
                    'Brand Activations',
                    'Corporate Dinners'
                ]),
                'button_text' => 'Learn More',
                'button_link' => '/contact',
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Wedding Planning',
                'description' => 'Complete wedding planning services from engagement to reception. We handle everything - venue, catering, decoration, photography, and coordination to make your special day perfect.',
                'image' => null,
                'features' => json_encode([
                    'Complete Wedding Planning',
                    'Venue Selection & Booking',
                    'Catering Services',
                    'Decoration & Themes',
                    'Photography & Videography'
                ]),
                'button_text' => 'Plan Your Wedding',
                'button_link' => '/contact',
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Catering Services',
                'description' => 'Premium catering services with diverse menu options. From traditional Pakistani cuisine to international dishes, we serve delicious food that your guests will remember.',
                'image' => null,
                'features' => json_encode([
                    'Traditional Pakistani Cuisine',
                    'International Menu Options',
                    'Live Cooking Stations',
                    'Custom Menu Planning',
                    'Professional Service Staff'
                ]),
                'button_text' => 'View Menu',
                'button_link' => '/contact',
                'order' => 3,
                'is_active' => true
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // About Settings
        AboutSetting::create([
            'vision_title' => 'Creating Unforgettable Experiences',
            'vision_description' => "At MG Food & Event Planner, we believe every event tells a story. Our vision is to be Pakistan's most trusted event management company, known for creativity, excellence, and flawless execution.",
            'vision_description2' => "With over 15 years of experience, we've successfully delivered hundreds of events, from intimate gatherings to grand celebrations.",
            'mission_title' => 'Our Mission',
            'mission_text' => 'To deliver exceptional event experiences that exceed client expectations through innovation, creativity, and meticulous attention to detail.',
            'value_title' => 'Our Values',
            'value_text' => 'Excellence, Integrity, Creativity, and Client Satisfaction drive everything we do.',
            'stats_number' => '500+',
            'stats_label' => 'Successful Events'
        ]);

        echo "✅ Sample data seeded successfully!\n";
    }
}

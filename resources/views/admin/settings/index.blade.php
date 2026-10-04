@extends('admin.layouts.app')

@section('page-title', 'Site Settings')

@section('content')
    <div class="form-card">
        <h2 style="margin-bottom: 30px; font-size: 24px; font-weight: 700;">Site Settings & Home Page</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Loading Overlay -->
        <div id="uploadLoader"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 10000; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
            <div class="spinner"
                style="width: 50px; height: 50px; border: 5px solid #f3f3f3; border-top: 5px solid #3498db; border-radius: 50%; animation: spin 1s linear infinite; margin-bottom: 20px;">
            </div>
            <h3 style="color: #2980b9;">Uploading & Saving Settings...</h3>
            <p style="color: #666;">This may take a few minutes for large videos. Please do not close or refresh the page.
            </p>
        </div>

        <form id="settingsForm" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- HERO SECTION -->
            <div class="admin-section-box"
                style="background: #e8f4f8; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #3498db;">
                <h3 style="margin: 0 0 25px; color: #2980b9; font-size: 20px;">
                    🏠 Hero Section (Main Banner)
                </h3>

                <div class="form-group">
                    <label for="hero_badge">Hero Badge Text</label>
                    <input type="text" id="hero_badge" name="hero_badge"
                        value="{{ $settings['homepage']->where('key', 'hero_badge')->first()->value ?? 'Premium Event Management' }}">
                </div>

                <div class="form-group">
                    <label for="hero_title">Hero Title</label>
                    <input type="text" id="hero_title" name="hero_title"
                        value="{{ $settings['homepage']->where('key', 'hero_title')->first()->value ?? 'Crafting Unforgettable Moments' }}">
                </div>

                <div class="form-group">
                    <label for="hero_highlight">Hero Title Highlight Text</label>
                    <input type="text" id="hero_highlight" name="hero_highlight"
                        value="{{ $settings['homepage']->where('key', 'hero_highlight')->first()->value ?? 'Unforgettable Moments' }}">
                    <small style="color: #666;">This text will be highlighted in gold color</small>
                </div>

                <div class="form-group">
                    <label for="hero_description">Hero Description</label>
                    <textarea id="hero_description" name="hero_description"
                        rows="3">{{ $settings['homepage']->where('key', 'hero_description')->first()->value ?? '' }}</textarea>
                </div>

                <h4 style="margin: 25px 0 15px; color: #555; border-top: 1px solid #ddd; padding-top: 20px;">Hero Buttons
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="hero_btn1_text">Button 1 Text</label>
                        <input type="text" id="hero_btn1_text" name="hero_btn1_text"
                            value="{{ $settings['homepage']->where('key', 'hero_btn1_text')->first()->value ?? 'Plan Your Event' }}">
                    </div>
                    <div class="form-group">
                        <label for="hero_btn1_link">Button 1 Link</label>
                        <input type="text" id="hero_btn1_link" name="hero_btn1_link"
                            value="{{ $settings['homepage']->where('key', 'hero_btn1_link')->first()->value ?? '/contact' }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="hero_btn2_text">Button 2 Text</label>
                        <input type="text" id="hero_btn2_text" name="hero_btn2_text"
                            value="{{ $settings['homepage']->where('key', 'hero_btn2_text')->first()->value ?? 'View Our Work' }}">
                    </div>
                    <div class="form-group">
                        <label for="hero_btn2_link">Button 2 Link</label>
                        <input type="text" id="hero_btn2_link" name="hero_btn2_link"
                            value="{{ $settings['homepage']->where('key', 'hero_btn2_link')->first()->value ?? '/portfolio' }}">
                    </div>
                </div>
            </div>

            <!-- ABOUT SECTION ON HOME -->
            <div class="admin-section-box"
                style="background: #f0f9f0; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #27ae60;">
                <h3 style="margin: 0 0 25px; color: #27ae60; font-size: 20px;">
                    📝 About Section (Home Page)
                </h3>

                <div class="form-group">
                    <label for="home_about_badge">Section Badge</label>
                    <input type="text" id="home_about_badge" name="home_about_badge"
                        value="{{ $settings['homepage']->where('key', 'home_about_badge')->first()->value ?? 'Who We Are' }}">
                </div>

                <div class="form-group">
                    <label for="home_about_title">Section Title</label>
                    <input type="text" id="home_about_title" name="home_about_title"
                        value="{{ $settings['homepage']->where('key', 'home_about_title')->first()->value ?? 'Pakistan\'s Premier Event Architects' }}">
                </div>

                <div class="form-group">
                    <label for="home_about_description">Description</label>
                    <textarea id="home_about_description" name="home_about_description"
                        rows="4">{{ $settings['homepage']->where('key', 'home_about_description')->first()->value ?? '' }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="home_about_btn_text">Button Text</label>
                        <input type="text" id="home_about_btn_text" name="home_about_btn_text"
                            value="{{ $settings['homepage']->where('key', 'home_about_btn_text')->first()->value ?? 'Discover Our Journey' }}">
                    </div>
                    <div class="form-group">
                        <label for="home_about_btn_link">Button Link</label>
                        <input type="text" id="home_about_btn_link" name="home_about_btn_link"
                            value="{{ $settings['homepage']->where('key', 'home_about_btn_link')->first()->value ?? '/about' }}">
                    </div>
                </div>
            </div>

            <!-- STATS SECTION -->
            <div class="admin-section-box"
                style="background: #fef9e7; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #f39c12;">
                <h3 style="margin: 0 0 25px; color: #f39c12; font-size: 20px;">
                    📊 Stats/Counter Section
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="stat1_number">Stat 1 Number</label>
                        <input type="text" id="stat1_number" name="stat1_number"
                            value="{{ $settings['homepage']->where('key', 'stat1_number')->first()->value ?? '500+' }}">
                    </div>
                    <div class="form-group">
                        <label for="stat1_label">Stat 1 Label</label>
                        <input type="text" id="stat1_label" name="stat1_label"
                            value="{{ $settings['homepage']->where('key', 'stat1_label')->first()->value ?? 'Events Completed' }}">
                    </div>
                    <div class="form-group">
                        <label for="stat2_number">Stat 2 Number</label>
                        <input type="text" id="stat2_number" name="stat2_number"
                            value="{{ $settings['homepage']->where('key', 'stat2_number')->first()->value ?? '15+' }}">
                    </div>
                    <div class="form-group">
                        <label for="stat2_label">Stat 2 Label</label>
                        <input type="text" id="stat2_label" name="stat2_label"
                            value="{{ $settings['homepage']->where('key', 'stat2_label')->first()->value ?? 'Years Experience' }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="stat3_number">Stat 3 Number</label>
                        <input type="text" id="stat3_number" name="stat3_number"
                            value="{{ $settings['homepage']->where('key', 'stat3_number')->first()->value ?? '50+' }}">
                    </div>
                    <div class="form-group">
                        <label for="stat3_label">Stat 3 Label</label>
                        <input type="text" id="stat3_label" name="stat3_label"
                            value="{{ $settings['homepage']->where('key', 'stat3_label')->first()->value ?? 'Expert Team' }}">
                    </div>
                    <div class="form-group">
                        <label for="stat4_number">Stat 4 Number</label>
                        <input type="text" id="stat4_number" name="stat4_number"
                            value="{{ $settings['homepage']->where('key', 'stat4_number')->first()->value ?? '100%' }}">
                    </div>
                    <div class="form-group">
                        <label for="stat4_label">Stat 4 Label</label>
                        <input type="text" id="stat4_label" name="stat4_label"
                            value="{{ $settings['homepage']->where('key', 'stat4_label')->first()->value ?? 'Client Satisfaction' }}">
                    </div>
                </div>
            </div>

            <!-- CTA SECTION -->
            <div class="admin-section-box"
                style="background: #fdeaea; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #e74c3c;">
                <h3 style="margin: 0 0 25px; color: #e74c3c; font-size: 20px;">
                    📣 Call-to-Action Section
                </h3>

                <div class="form-group">
                    <label for="cta_title">CTA Title</label>
                    <input type="text" id="cta_title" name="cta_title"
                        value="{{ $settings['homepage']->where('key', 'cta_title')->first()->value ?? 'Ready to Create Something Amazing?' }}">
                </div>

                <div class="form-group">
                    <label for="cta_description">CTA Description</label>
                    <textarea id="cta_description" name="cta_description"
                        rows="2">{{ $settings['homepage']->where('key', 'cta_description')->first()->value ?? '' }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="cta_btn_text">CTA Button Text</label>
                        <input type="text" id="cta_btn_text" name="cta_btn_text"
                            value="{{ $settings['homepage']->where('key', 'cta_btn_text')->first()->value ?? 'Get Free Consultation' }}">
                    </div>
                    <div class="form-group">
                        <label for="cta_btn_link">CTA Button Link</label>
                        <input type="text" id="cta_btn_link" name="cta_btn_link"
                            value="{{ $settings['homepage']->where('key', 'cta_btn_link')->first()->value ?? '/contact' }}">
                    </div>
                </div>
            </div>

            <!-- HOME MEDIA MANAGEMENT -->
            <div class="admin-section-box"
                style="background: #fff3e0; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #ff9800;">
                <h3 style="margin: 0 0 25px; color: #ff9800; font-size: 20px;">
                    🎬 Home Page Media (Images & Videos)
                </h3>

                <h4 style="margin: 20px 0 15px; color: #555; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                    📹 Videos
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="hero_video">Hero Section Background Video</label>
                        <input type="file" id="hero_video" name="hero_video" accept="video/*">
                        <small style="color: #666;">Current:
                            {{ $settings['homepage']->where('key', 'hero_video')->first()->value ?? 'Video/Untitled design (6).mp4' }}</small>
                    </div>
                    <div class="form-group">
                        <label for="wedding_feature_video">Wedding Feature Section Video</label>
                        <input type="file" id="wedding_feature_video" name="wedding_feature_video" accept="video/*">
                        <small style="color: #666;">Current:
                            {{ $settings['homepage']->where('key', 'wedding_feature_video')->first()->value ?? 'Video/marena club.mp4' }}</small>
                    </div>
                </div>

                <h4 style="margin: 30px 0 15px; color: #555; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                    👥 Board Members Photos
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="ceo_image">CEO Photo</label>
                        <input type="file" id="ceo_image" name="ceo_image" accept="image/*">
                        <small style="color: #666;">Current:
                            {{ $settings['homepage']->where('key', 'ceo_image')->first()->value ?? 'images/CEO.jpg' }}</small>
                        @if($settings['homepage']->where('key', 'ceo_image')->first())
                            <img src="{{ asset('storage/' . $settings['homepage']->where('key', 'ceo_image')->first()->value) }}"
                                style="max-width: 200px; margin-top: 10px; border-radius: 8px;">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="director_image">Director Photo</label>
                        <input type="file" id="director_image" name="director_image" accept="image/*">
                        <small style="color: #666;">Current:
                            {{ $settings['homepage']->where('key', 'director_image')->first()->value ?? 'images/Director.jpg' }}</small>
                        @if($settings['homepage']->where('key', 'director_image')->first())
                            <img src="{{ asset('storage/' . $settings['homepage']->where('key', 'director_image')->first()->value) }}"
                                style="max-width: 200px; margin-top: 10px; border-radius: 8px;">
                        @endif
                    </div>
                </div>

                <h4 style="margin: 30px 0 15px; color: #555; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                    🏢 About & Premium Info Images
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="team_photo">Team Photo</label>
                        <input type="file" id="team_photo" name="team_photo" accept="image/*">
                        <small style="color: #666;">Current:
                            {{ $settings['homepage']->where('key', 'team_photo')->first()->value ?? 'images/team-photo.jpg.JPG' }}</small>
                        @if($settings['homepage']->where('key', 'team_photo')->first())
                            <img src="{{ asset('storage/' . $settings['homepage']->where('key', 'team_photo')->first()->value) }}"
                                style="max-width: 150px; margin-top: 10px; border-radius: 8px;">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="venue_hall_image">Venue Hall Image</label>
                        <input type="file" id="venue_hall_image" name="venue_hall_image" accept="image/*">
                        <small style="color: #666;">Current:
                            {{ $settings['homepage']->where('key', 'venue_hall_image')->first()->value ?? 'images/venue-hall.JPG' }}</small>
                        @if($settings['homepage']->where('key', 'venue_hall_image')->first())
                            <img src="{{ asset('storage/' . $settings['homepage']->where('key', 'venue_hall_image')->first()->value) }}"
                                style="max-width: 150px; margin-top: 10px; border-radius: 8px;">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="event_setup_image">Event Setup Image</label>
                        <input type="file" id="event_setup_image" name="event_setup_image" accept="image/*">
                        <small style="color: #666;">Current:
                            {{ $settings['homepage']->where('key', 'event_setup_image')->first()->value ?? 'images/event-setup.JPG' }}</small>
                        @if($settings['homepage']->where('key', 'event_setup_image')->first())
                            <img src="{{ asset('storage/' . $settings['homepage']->where('key', 'event_setup_image')->first()->value) }}"
                                style="max-width: 150px; margin-top: 10px; border-radius: 8px;">
                        @endif
                    </div>
                </div>

                <div
                    style="background: #fff9e6; padding: 15px; border-radius: 8px; margin-top: 20px; border-left: 3px solid #ffa726;">
                    <p style="margin: 0; color: #666; font-size: 14px;">
                        <strong>📝 Note:</strong> Videos and images will be uploaded to <code>storage/settings/</code>
                        folder.
                        Make sure to run <code>php artisan storage:link</code> if you haven't already.
                    </p>
                </div>
            </div>


            <!-- CONTACT INFO -->
            <div class="admin-section-box"
                style="background: #f4ecf7; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #9b59b6;">
                <h3 style="margin: 0 0 25px; color: #9b59b6; font-size: 20px;">
                    📞 Contact Information
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="contact_phone">Phone Number</label>
                        <input type="text" id="contact_phone" name="contact_phone"
                            value="{{ $settings['contact']->where('key', 'contact_phone')->first()->value ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="contact_whatsapp">WhatsApp Number</label>
                        <input type="text" id="contact_whatsapp" name="contact_whatsapp"
                            value="{{ $settings['contact']->where('key', 'contact_whatsapp')->first()->value ?? '' }}"
                            placeholder="923001234567">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="contact_email">Email Address</label>
                        <input type="email" id="contact_email" name="contact_email"
                            value="{{ $settings['contact']->where('key', 'contact_email')->first()->value ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="contact_address">Address</label>
                        <input type="text" id="contact_address" name="contact_address"
                            value="{{ $settings['contact']->where('key', 'contact_address')->first()->value ?? '' }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                    <div class="form-group">
                        <label for="contact_map_office">Head Office Map Link (Google Maps Embed URL)</label>
                        <textarea id="contact_map_office" name="contact_map_office" rows="3"
                            placeholder="https://www.google.com/maps/embed?pb=...">{{ $settings['contact']->where('key', 'contact_map_office')->first()->value ?? '' }}</textarea>
                        <small style="color: #666; display: block; margin-top: 5px;">
                            <strong>How to get this:</strong> Search on Google Maps > Share > Embed a map > Copy the URL
                            inside <code>src="..."</code>
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="contact_map_kitchen">Central Kitchen Map Link (Google Maps Embed URL)</label>
                        <textarea id="contact_map_kitchen" name="contact_map_kitchen" rows="3"
                            placeholder="https://www.google.com/maps/embed?pb=...">{{ $settings['contact']->where('key', 'contact_map_kitchen')->first()->value ?? '' }}</textarea>
                        <small style="color: #666; display: block; margin-top: 5px;">
                            <strong>Note:</strong> Regular Google Maps links (e.g. <code>google.com/maps/place/...</code>)
                            will <strong>NOT</strong> work. You must use the Embed URL.
                        </small>
                    </div>
                </div>
            </div>

            <!-- SOCIAL LINKS -->
            <div class="admin-section-box"
                style="background: #eaf2f8; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #5dade2;">
                <h3 style="margin: 0 0 25px; color: #5dade2; font-size: 20px;">
                    🔗 Social Media Links
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="social_facebook">Facebook URL</label>
                        <input type="url" id="social_facebook" name="social_facebook"
                            value="{{ $settings['social']->where('key', 'social_facebook')->first()->value ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="social_instagram">Instagram URL</label>
                        <input type="url" id="social_instagram" name="social_instagram"
                            value="{{ $settings['social']->where('key', 'social_instagram')->first()->value ?? '' }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="social_youtube">YouTube URL</label>
                        <input type="url" id="social_youtube" name="social_youtube"
                            value="{{ $settings['social']->where('key', 'social_youtube')->first()->value ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="social_tiktok">TikTok URL</label>
                        <input type="url" id="social_tiktok" name="social_tiktok"
                            value="{{ $settings['social']->where('key', 'social_tiktok')->first()->value ?? '' }}">
                    </div>
                </div>

                <div style="margin-top: 30px; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 25px;">
                    <h4 style="margin: 0 0 15px; color: #5dade2; font-size: 16px;">
                        ⭐⭐ Google Business Reviews (Widget)
                    </h4>
                    <div class="form-group">
                        <label for="google_review_code">Google Review Widget Script / Embed Code</label>
                        <textarea id="google_review_code" name="google_review_code" rows="6"
                            placeholder="Paste your Google Review widget code here (e.g. from Trustindex, Elfsight, or Google)">{{ $settings['social']->where('key', 'google_review_code')->first()->value ?? '' }}</textarea>
                        <small style="color: #666; display: block; margin-top: 8px;">
                            <strong>Instructions:</strong> Use a service like <a href="https://www.trustindex.io/"
                                target="_blank">Trustindex</a> or <a href="https://elfsight.com/google-reviews-widget/"
                                target="_blank">Elfsight</a> to get your Google Reviews widget code. Paste the
                            <code>&lt;script&gt;</code> or <code>&lt;iframe&gt;</code> code here. This will automatically
                            sync your real Google Map reviews to the homepage.
                        </small>
                    </div>
                </div>
            </div>

            <!-- SEO & VERIFICATION -->
            <div class="admin-section-box"
                style="background: #fdf2f2; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #e74c3c;">
                <h3 style="margin: 0 0 25px; color: #e74c3c; font-size: 20px;">
                    🔍 SEO & Webmaster Verification
                </h3>
                <div class="form-group">
                    <label for="google_verification">Google Search Console Verification Tag</label>
                    <input type="text" id="google_verification" name="google_verification"
                        value="{{ $settings['social']->where('key', 'google_verification')->first()->value ?? '' }}"
                        placeholder='<meta name="google-site-verification" content="..." />'>
                    <small style="color: #666; display: block; margin-top: 8px;">
                        <strong>Step:</strong> Copy the HTML meta tag from Google Search Console and paste it here. It
                        usually looks like <code>&lt;meta name="google-site-verification" content="..." /&gt;</code>.
                    </small>
                </div>
                <div class="form-group"
                    style="margin-top: 25px; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 20px;">
                    <label for="google_analytics">Google Analytics Tracking Code (Global Site Tag)</label>
                    <textarea id="google_analytics" name="google_analytics" rows="5"
                        placeholder="Paste your gtag.js or analytics.js code here">{{ $settings['social']->where('key', 'google_analytics')->first()->value ?? '' }}</textarea>
                    <small style="color: #666; display: block; margin-top: 8px;">
                        <strong>Step:</strong> Copy the full <code>&lt;script&gt;</code> block from Google Analytics and
                        paste it here. This will help you track visitors on your website.
                    </small>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save All Settings</button>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary">Preview Home Page</a>
            </div>
        </form>
    </div>
@endsection

@section('styles')
    <style>
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('settingsForm');
            if (form) {
                form.addEventListener('submit', function () {
                    document.getElementById('uploadLoader').style.display = 'flex';
                });
            }
        });
    </script>
@endsection
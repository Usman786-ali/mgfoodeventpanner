@extends('layouts.app')

@section('title', 'Get in Touch - MG Food & Event Planners')

@section('content')
    <!-- Hero Section -->
    <section class="hero"
        style="min-height: 60vh; padding-top: 160px; background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/Blog-Background.jpeg') }}') center/cover;">
        <div class="container hero-container">
            <div class="hero-content">
                <span class="hero-badge" data-aos="fade-up">Contact Us</span>
                <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">
                    Let's Start <span class="highlight">Planning</span>
                </h1>
                <p class="hero-description" data-aos="fade-up" data-aos-delay="200">
                    Whether you have a specific date in mind or just want to explore possibilities, our consultants are
                    ready to help.
                </p>
            </div>
        </div>
    </section>

    <!-- Detailed Office Locations -->
    <section style="padding: 100px 0; background: #fff;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Our Key Locations</h2>
                <p class="section-description">Visit our office for consultations or reach out to our central kitchen for
                    catering inquiries.</p>
            </div>
            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 30px;">
                <!-- Karachi Office -->
                <div class="service-card"
                    style="text-align: left; padding: 40px; border: 1px solid #eee; background: #fff; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
                    <h3 style="color: var(--dark); margin-bottom: 15px;">Karachi Head Office</h3>
                    <p style="color: #666; margin-bottom: 20px;">Plot # 15-C, Mezzanine Floor, 4th Zamzama Commercial Lane,
                        Phase 5, DHA, Karachi.</p>
                    <p style="font-weight: 600; font-size: 18px; color: var(--primary);">+92 21 35301807</p>
                    <p style="color: #888; margin-top: 10px;">Consultation Hours: 10:00 AM - 8:00 PM</p>
                </div>
                <!-- Karachi Kitchen -->
                <div class="service-card"
                    style="text-align: left; padding: 40px; border: 1px solid #eee; background: #fff; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
                    <h3 style="color: var(--dark); margin-bottom: 15px;">Our Central Kitchen</h3>
                    <p style="color: #666; margin-bottom: 20px;">Plot L-5, Street No. 1, Altaf Town, Korangi Creek,
                        Karachi, Pakistan.</p>
                    <p style="font-weight: 600; font-size: 18px; color: var(--primary);">+92 300 8849180</p>
                    <p style="color: #888; margin-top: 10px;">Catering Facility & Operations Center</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Contact Area -->
    <section style="padding: 100px 0; background: #f8f9fa;">
        <div class="container">
            <div class="about-grid" style="grid-template-columns: 1.5fr 1fr; gap: 60px;">
                <div data-aos="fade-right">
                    @if(session('success'))
                        <div
                            style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form" target="_blank"
                        style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.05);">
                        @csrf

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                            <div class="form-group">
                                <label>Your Name *</label>
                                <input type="text" name="name" placeholder="Full Name" required
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                            </div>
                            <div class="form-group">
                                <label>Email Address *</label>
                                <input type="email" name="email" placeholder="Email Address" required
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" name="phone" placeholder="+92 300 1234567"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                            </div>
                            <div class="form-group">
                                <label>Event Date (Approx)</label>
                                <input type="date" name="event_date"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                            <div class="form-group">
                                <label>Event Type</label>
                                <select name="event_type"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                                    <option value="">Select Event Type</option>
                                    @php
                                        $eventTypes = \App\Models\EventType::active()->get();
                                    @endphp
                                    @foreach($eventTypes as $type)
                                        <option value="{{ $type->name }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Expected Budget</label>
                                <select name="budget"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                                    <option value="">Select Range</option>
                                    <option>Under 5 Lac</option>
                                    <option>5 Lac - 15 Lac</option>
                                    <option>15 Lac - 50 Lac</option>
                                    <option>Above 50 Lac</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 30px;">
                            <label>Event Vision & Details</label>
                            <textarea name="message" rows="5" placeholder="Tell us about your dream event..."
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Schedule My
                            Consultation</button>
                    </form>
                </div>

                <div data-aos="fade-left">
                    <h2 class="section-title" style="text-align: left; margin-bottom: 40px;">Direct Channels</h2>
                    <div style="margin-bottom: 40px;">
                        <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                            <div
                                style="width: 50px; height: 50px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px;">
                                📞</div>
                            <div>
                                <h4 style="margin-bottom: 5px;">General Inquiries</h4>
                                <p style="color: #666;">info@mgfoodevent.com</p>
                                <p style="color: #666;">+92 300 8849180</p>
                                <p style="color: #666;">+92 021-35807088</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                            <div
                                style="width: 50px; height: 50px; background: #25D366; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px;">
                                💬</div>
                            <div>
                                <h4 style="margin-bottom: 5px;">Quick WhatsApp</h4>
                                <p style="color: #666;">Start a chat for fast quotes</p>
                                <a href="https://wa.me/923008849180" target="_blank"
                                    style="color: #25D366; font-weight: bold;">Chat Now →</a>
                            </div>
                        </div>
                    </div>

                    <div style="background: #000000; color: white; padding: 30px; border-radius: 20px;">
                        <h4 style="color: var(--primary); margin-bottom: 15px;">Looking for Careers?</h4>
                        <p style="font-size: 14px; margin-bottom: 15px;">We are always looking for creative florists, chefs,
                            and coordinators.</p>
                        <a href="mailto:hr@mgfoodevent.com" style="color: white; text-decoration: underline;">Apply at
                            hr@mgfoodevent.com</a>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Map Section -->
    <section class="map-section" style="padding: 100px 0; background: #fff;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Locate Us</h2>
                <p class="section-description">Detailed map locations for our head office and production facility.</p>
            </div>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 40px;" class="services-grid">
                <!-- Head Office Map -->
                <div data-aos="fade-right">
                    <div style="text-align: center; margin-bottom: 25px;">
                        <h3
                            style="font-family: 'Playfair Display', serif; color: var(--dark); font-size: 24px; margin-bottom: 10px;">
                            Our Head Office</h3>
                        <div style="width: 50px; height: 2px; background: var(--primary); margin: 0 auto;"></div>
                    </div>
                    @php
                        $officeMap = \App\Models\SiteSetting::get('contact_map_office', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14483.838332944744!2d67.06206999416932!3d24.831055751671055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33d60eace38e1%3A0xff484eea25f9d107!2sMG%20food%20%26%20Event%20Planners!5e0!3m2!1sen!2s!4v1766091325523!5m2!1sen!2s');
                        if (str_contains($officeMap, '<iframe')) {
                            preg_match('/src="([^"]+)"/', $officeMap, $matches);
                            $officeMap = $matches[1] ?? $officeMap;
                        }
                    @endphp
                    <iframe src="{{ $officeMap }}" width="100%" height="450"
                        style="border:0; border-radius: 20px; display: block; box-shadow: 0 15px 45px rgba(0,0,0,0.08);"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
                <!-- Kitchen Map -->
                <div data-aos="fade-left">
                    <div style="text-align: center; margin-bottom: 25px;">
                        <h3
                            style="font-family: 'Playfair Display', serif; color: var(--dark); font-size: 24px; margin-bottom: 10px;">
                            Our Central Kitchen</h3>
                        <div style="width: 50px; height: 2px; background: var(--primary); margin: 0 auto;"></div>
                    </div>
                    @php
                        $kitchenMap = \App\Models\SiteSetting::get('contact_map_kitchen', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.123456789!2d67.045618!3d24.823456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33d747a747a7b%3A0x7a7a7a7a7a7a7a7a!2sZamzama%20Commercial%20Area!5e0!3m2!1sen!2s!4v1766000000000!5m2!1sen!2s');
                        if (str_contains($kitchenMap, '<iframe')) {
                            preg_match('/src="([^"]+)"/', $kitchenMap, $matches);
                            $kitchenMap = $matches[1] ?? $kitchenMap;
                        }
                    @endphp
                    <iframe src="{{ $kitchenMap }}" width="100%" height="450"
                        style="border:0; border-radius: 20px; display: block; box-shadow: 0 15px 45px rgba(0,0,0,0.08);"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
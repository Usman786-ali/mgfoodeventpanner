@extends('layouts.app')

@section('title', 'Exclusive Venues - MG Food & Event Planners')

@section('content')
    <!-- Hero Section -->
    <section class="hero" style="
                                    min-height: 65vh; 
                                    padding-top: 160px;
                                    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                                                url('{{ asset('images/Services-Background.jpeg') }}') center/cover;
                                    background-attachment: fixed;">
        <div class="hero-overlay"></div>
        <div class="container hero-container">
            <div class="hero-content">
                <span class="hero-badge" data-aos="fade-up">EXCLUSIVE SPACES</span>
                <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">
                    Premium Event Venues <span class="highlight">for Every Occasion</span>
                </h1>
                <p class="hero-description" data-aos="fade-up" data-aos-delay="200">
                    At MG Food & Event Planner, we offer a curated selection of premium venues in Karachi. From elegant
                    wedding halls to modern corporate spaces, our venues are designed to provide the perfect backdrop for
                    your most significant moments.
                </p>
            </div>
        </div>
    </section>


    <!-- Dynamic Venues Sections -->
    @forelse($services as $index => $service)
        <section style="padding: 100px 0; {{ $index % 2 != 0 ? 'background: #fdfaf5;' : '' }}">
            <div class="container">
                <div class="about-grid"
                    style="align-items: center; {{ $index % 2 != 0 ? 'grid-template-columns: 1fr 1fr;' : '' }}">
                    <div class="about-image" data-aos="fade-{{ $index % 2 == 0 ? 'right' : 'left' }}"
                        style="{{ $index % 2 != 0 ? 'order: 1;' : 'order: 0;' }}">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                            style="border-radius: 20px; width: 100%; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                    </div>
                    <div class="about-content" data-aos="fade-{{ $index % 2 == 0 ? 'left' : 'right' }}"
                        style="{{ $index % 2 != 0 ? 'order: 0;' : 'order: 1;' }}">
                        <h2 class="section-title" style="text-align: left; margin-bottom: 20px;">{!! $service->title !!}</h2>
                        <p class="section-description"
                            style="text-align: left; margin: 0 0 30px; font-size: 16px; line-height: 1.8; color: #555;">
                            {!! $service->description !!}
                        </p>

                        <!-- Pricing Table -->
                        <div
                            style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); margin-bottom: 30px; border-left: 5px solid #D4A853;">
                            <h4 style="color: #1a1a2e; margin-bottom: 15px; font-size: 18px; font-weight: 700;">💰 Starting
                                Price
                            </h4>
                            <div style="display: flex; gap: 40px;">
                                <div>
                                    <span
                                        style="display: block; font-size: 12px; color: #777; text-transform: uppercase; letter-spacing: 1px;">Minimum
                                        Price</span>
                                    <span
                                        style="font-size: 20px; font-weight: 700; color: #D4A853;">{{ $service->features[0] ?? 'Contact for Price' }}</span>
                                </div>
                                <div style="width: 1px; background: #eee;"></div>
                                <div>
                                    <span
                                        style="display: block; font-size: 12px; color: #777; text-transform: uppercase; letter-spacing: 1px;">Maximum
                                        Price</span>
                                    <span
                                        style="font-size: 20px; font-weight: 700; color: #D4A853;">{{ $service->features[1] ?? 'Contact for Price' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Location Button -->
                        @if($service->button_link)
                            <a href="{{ $service->button_link }}" target="_blank" class="btn btn-primary"
                                style="margin-top: 10px; display: inline-flex; align-items: center; gap: 10px; padding: 12px 30px; border-radius: 50px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                {{ $service->button_text ?: 'View Location' }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @empty
        <section style="padding: 100px 0;">
            <div class="container" style="text-align: center;">
                <h3>No venues available yet.</h3>
                <p style="color: #777;">Please check back later.</p>
            </div>
        </section>
    @endforelse

    <!-- Premium Add-ons -->
    <section style="padding: 120px 0 100px; background: #ffffff; color: #1a1a2e; border-top: 1px solid #eee;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title" style="color: #1a1a2e;">Complete Venue Experience</h2>
                <p class="section-description" style="color: #666;">We don't just provide space; we provide a complete
                    ecosystem for your event.</p>
            </div>
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100"
                    style="background: #000000; border: 1px solid rgba(255,255,255,0.1); padding: 40px 30px; border-radius: 20px;">
                    <div style="font-size: 40px; margin-bottom: 20px;">🍲</div>
                    <h3 style="color: #D4A853;">In-House Catering</h3>
                    <p style="color: #ffffff; opacity: 0.9;">Live BBQ counters, artisanal dessert bars, and customized
                        multi-cuisine menus.
                    </p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="200"
                    style="background: #000000; border: 1px solid rgba(255,255,255,0.1); padding: 40px 30px; border-radius: 20px;">
                    <div style="font-size: 40px; margin-bottom: 20px;">🛡️</div>
                    <h3 style="color: #D4A853;">Secure Valet</h3>
                    <p style="color: #ffffff; opacity: 0.9;">Professional parking management and security services for all
                        your guests.</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="300"
                    style="background: #000000; border: 1px solid rgba(255,255,255,0.1); padding: 40px 30px; border-radius: 20px;">
                    <div style="font-size: 40px; margin-bottom: 20px;">❄️</div>
                    <h3 style="color: #D4A853;">Climate Control</h3>
                    <p style="color: #ffffff; opacity: 0.9;">State of the art HVAC systems ensuring comfort regardless of
                        the weather
                        outside.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
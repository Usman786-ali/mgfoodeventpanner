<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MG Food and Event Planners - Best Event Planner in Karachi</title>
    <meta name="description"
        content="Karachi's top event planner for weddings, corporate events, and catering services. Let us make your special moments one of a kind.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @php $googleVerify = \App\Models\SiteSetting::get('google_verification'); @endphp
    @if($googleVerify)
        {!! $googleVerify !!}
    @endif

    @php $googleAnalytics = \App\Models\SiteSetting::get('google_analytics'); @endphp
    @if($googleAnalytics)
        {!! $googleAnalytics !!}
    @endif

    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/portfolio-hover.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/footer-fix.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/footer-social.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-responsive.css') }}?v={{ time() }}">
    <style>
        /* Force remove any bottom gap */
        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            height: auto !important;
            min-height: 100% !important;
            overflow-x: hidden !important;
            background-color: #fff !important;
        }

        .main-footer {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
            display: block !important;
        }

        .footer-copyright {
            margin-bottom: 0 !important;
        }

        /* Mobile menu fixes duplicated here for safety */
        .hero-content {
            text-align: left !important;
            margin: 0 !important;
        }

        .hero-buttons {
            justify-content: flex-start !important;
        }
    </style>
</head>

<body style="margin: 0 !important; padding: 0 !important;">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <h1>
                        <span class="logo-desktop">MG <span class="highlight">Food & Event Planners</span></span>
                        <span class="logo-mobile">MG <span class="highlight">Food & event Planner</span></span>
                    </h1>
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="{{ route('home') }}" class="nav-link active">Home</a></li>
                    <li><a href="{{ route('portfolio') }}" class="nav-link">Portfolio</a></li>
                    <li><a href="{{ route('about') }}" class="nav-link">About</a></li>
                    <li><a href="{{ route('blog') }}" class="nav-link">Blog</a></li>
                    <li><a href="{{ route('services') }}" class="nav-link">Venues</a></li>

                    <li><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary">Get Quote</a>
                    <button class="mobile-toggle" id="mobileToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Success Message -->
    @if(session('success'))
        <div
            style="position: fixed; top: 100px; right: 20px; z-index: 9999; background: #d4edda; color: #155724; padding: 20px 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); border-left: 4px solid #28a745; max-width: 400px;">
            <strong>✅ Success!</strong><br>
            {{ session('success') }}
        </div>
    @endif

    <!-- Hero Section -->
    <section class="hero" id="home">
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="hero-video-bg">
            @php
                $heroVideo = $siteSettings['hero_video'] ?? null;
                $videoPath = $heroVideo ? asset('storage/' . $heroVideo) : asset('Video/Untitled design (6).mp4');
            @endphp
            <source src="{{ $videoPath }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="hero-overlay"></div>
        <div class="container hero-container">
            <div class="hero-grid">
                <div class="hero-content">
                    <span class="hero-badge"
                        data-aos="fade-up">{{ $siteSettings['hero_badge'] ?? '✨ Best Event Planner In Karachi' }}</span>
                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">
                        @php
                            $title = $siteSettings['hero_title'] ?? 'Turning Special Moments Into Lasting Memories';
                            $highlight = $siteSettings['hero_highlight'] ?? 'Lasting Memories';
                        @endphp
                        {!! str_replace($highlight, '<span class="highlight">' . $highlight . '</span>', $title) !!}
                    </h1>
                    <p class="hero-description" data-aos="fade-up" data-aos-delay="200">
                        {{ $siteSettings['hero_description'] ?? "Experience elegance, taste, and perfection with MG Food & Event Planners, crafting moments you'll cherish forever." }}
                    </p>
                    <div class="hero-buttons" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ $siteSettings['hero_btn1_link'] ?? route('contact') }}"
                            class="btn btn-secondary btn-lg btn-animated-border">
                            {{ $siteSettings['hero_btn1_text'] ?? 'Start Planning Now' }}
                        </a>
                    </div>
                </div>

                <!-- Right Column Wrapper -->
                <div class="hero-right-column">
                    <!-- Right Contact Form -->
                    <div class="hero-quick-form" data-aos="fade-left" data-aos-delay="400">
                        <form action="{{ route('contact.submit') }}" method="POST" id="heroQuickForm" target="_blank">
                            @csrf
                            <div class="quick-form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Enter Full Name" required>
                            </div>
                            <div class="quick-form-group">
                                <label>Phone</label>
                                <input type="tel" name="phone" placeholder="Enter Your Phone" required>
                            </div>
                            <div class="quick-form-group">
                                <label>Select Event Type</label>
                                <select name="event_type" required>
                                    <option value="">Select Event Type</option>
                                    @php
                                        $heroEventTypes = \App\Models\EventType::active()->get();
                                    @endphp
                                    @foreach($heroEventTypes as $type)
                                        <option value="{{ $type->name }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn-send-message">Send Message</button>
                        </form>
                    </div>

                    <!-- Hero Social Icons -->
                    <div class="hero-social-icons" data-aos="fade-up" data-aos-delay="500">
                        @if(isset($siteSettings['social_facebook']))
                            <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" class="hero-social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                        @endif
                        @if(isset($siteSettings['social_instagram']))
                            <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" class="hero-social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                        @endif
                        @if(isset($siteSettings['social_youtube']))
                            <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" class="hero-social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        @endif
                        @if(isset($siteSettings['social_tiktok']))
                            <a href="{{ $siteSettings['social_tiktok'] }}" target="_blank" class="hero-social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Separator Line -->
    <div style="height: 1px; background: linear-gradient(to right, transparent, #e0e0e0, transparent); margin: 0;">
    </div>

    <!-- Interactive Event Cost Planner Section -->
    <section class="event-estimator-section">
        <style>
            .event-estimator-section {
                padding: 100px 0;
                background: #ffffff;
                position: relative;
                overflow: hidden;
            }
            .event-estimator-section::before {
                content: '';
                position: absolute;
                top: -200px;
                right: -200px;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(212, 168, 83, 0.12) 0%, transparent 70%);
                border-radius: 50%;
                pointer-events: none;
            }
            .event-estimator-section::after {
                content: '';
                position: absolute;
                bottom: -200px;
                left: -200px;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(212, 168, 83, 0.08) 0%, transparent 70%);
                border-radius: 50%;
                pointer-events: none;
            }
            .estimator-header {
                text-align: center;
                margin-bottom: 60px;
            }
            .estimator-badge {
                display: inline-block;
                background: rgba(212, 168, 83, 0.15);
                border: 1px solid rgba(212, 168, 83, 0.4);
                color: #D4A853;
                padding: 6px 18px;
                border-radius: 50px;
                font-size: 13px;
                font-weight: 700;
                letter-spacing: 1px;
                text-transform: uppercase;
                margin-bottom: 15px;
            }
            .estimator-title {
                font-family: 'Playfair Display', serif;
                font-size: 42px;
                font-weight: 700;
                color: #1a1a2e;
                margin-bottom: 15px;
            }
            .highlight-gold {
                color: #D4A853;
            }
            .estimator-desc {
                font-size: 16px;
                color: #6B7280;
                max-width: 600px;
                margin: 0 auto;
            }
            .estimator-grid {
                display: grid;
                grid-template-columns: 1.6fr 1fr;
                gap: 40px;
                align-items: stretch;
                max-width: 1200px;
                margin: 0 auto;
            }
            .estimator-card {
                background: #f9f9fb;
                border: 1px solid #e8e8f0;
                border-radius: 24px;
                padding: 40px;
                color: #1a1a2e;
                box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            }
            .estimator-form {
                display: flex;
                flex-direction: column;
                gap: 35px;
            }
            .estimator-group {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            .group-label {
                font-size: 16px;
                font-weight: 600;
                color: #1a1a2e;
                letter-spacing: 0.5px;
            }
            .group-label span {
                color: #D4A853;
                font-size: 18px;
                font-weight: 700;
            }
            .event-type-cards {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
            }
            .type-card {
                background: #ffffff;
                border: 1.5px solid #e0e0e8;
                border-radius: 16px;
                padding: 20px;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .type-card:hover {
                transform: translateY(-3px);
                border-color: #D4A853;
                background: rgba(212, 168, 83, 0.04);
                box-shadow: 0 6px 20px rgba(212,168,83,0.1);
            }
            .type-card.active {
                background: rgba(212, 168, 83, 0.1);
                border-color: #D4A853;
                box-shadow: 0 10px 25px rgba(212, 168, 83, 0.15);
            }
            .card-icon {
                font-size: 32px;
                display: block;
                margin-bottom: 8px;
            }
            .card-label {
                font-size: 14px;
                font-weight: 600;
                letter-spacing: 0.5px;
                color: #1a1a2e;
            }
            .slider-container {
                position: relative;
                padding: 10px 0;
            }
            .custom-slider {
                -webkit-appearance: none;
                width: 100%;
                height: 6px;
                border-radius: 5px;
                background: #e0e0e8;
                outline: none;
                margin: 15px 0;
            }
            .custom-slider::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 22px;
                height: 22px;
                border-radius: 50%;
                background: #D4A853;
                cursor: pointer;
                box-shadow: 0 0 15px rgba(212, 168, 83, 0.6);
                transition: transform 0.1s;
            }
            .custom-slider::-webkit-slider-thumb:hover {
                transform: scale(1.2);
            }
            .slider-labels {
                display: flex;
                justify-content: space-between;
                font-size: 12px;
                color: #9ca3af;
            }
            .catering-options {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            .catering-card {
                background: #ffffff;
                border: 1.5px solid #e0e0e8;
                border-radius: 16px;
                padding: 20px;
                cursor: pointer;
                transition: all 0.3s;
                display: block;
            }
            .catering-card:hover {
                border-color: #D4A853;
                background: rgba(212, 168, 83, 0.03);
            }
            .catering-card.active {
                background: rgba(212, 168, 83, 0.08);
                border-color: #D4A853;
                box-shadow: 0 5px 20px rgba(212, 168, 83, 0.1);
            }
            .c-card-content {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }
            .c-title {
                font-size: 16px;
                font-weight: 700;
                color: #1a1a2e;
            }
            .catering-card.active .c-title {
                color: #D4A853;
            }
            .c-desc {
                font-size: 12px;
                color: #6B7280;
            }
            .c-price {
                font-size: 16px;
                font-weight: 700;
                color: #D4A853;
                margin-top: 5px;
            }
            .c-price small {
                color: #9ca3af;
                font-size: 12px;
                font-weight: 400;
            }
            .decor-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            .decor-item {
                display: flex;
                align-items: center;
                gap: 12px;
                background: #ffffff;
                border: 1.5px solid #e0e0e8;
                border-radius: 12px;
                padding: 15px;
                cursor: pointer;
                transition: all 0.3s;
            }
            .decor-item:hover {
                border-color: #D4A853;
                background: rgba(212, 168, 83, 0.04);
            }
            .decor-item input {
                display: none;
            }
            .decor-box {
                width: 20px;
                height: 20px;
                border: 2px solid #d1d5db;
                border-radius: 5px;
                position: relative;
                display: inline-block;
                flex-shrink: 0;
                transition: all 0.2s;
                background: transparent;
            }
            .decor-item input:checked + .decor-box {
                background: #D4A853;
                border-color: #D4A853;
            }
            .decor-item input:checked + .decor-box::after {
                content: '✓';
                color: #000;
                font-size: 12px;
                font-weight: 900;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            .decor-name {
                font-size: 13px;
                font-weight: 500;
                color: #374151;
            }
            .decor-item input:checked ~ .decor-name {
                color: #D4A853;
                font-weight: 600;
            }

            /* Summary Card */
            .estimator-summary {
                background: #000000;
                border: 1px solid rgba(212, 168, 83, 0.3);
                box-shadow: 0 20px 50px rgba(26, 26, 46, 0.2);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .summary-top {
                text-align: center;
                border-bottom: 1px solid rgba(212, 168, 83, 0.2);
                padding-bottom: 30px;
                margin-bottom: 30px;
            }
            .summary-top h3 {
                font-size: 14px;
                font-weight: 600;
                color: rgba(255, 255, 255, 0.7);
                text-transform: uppercase;
                letter-spacing: 1.5px;
                margin-bottom: 15px;
            }
            .price-display {
                display: flex;
                justify-content: center;
                align-items: baseline;
                gap: 8px;
                margin-bottom: 15px;
            }
            .price-display .currency {
                font-size: 20px;
                font-weight: 700;
                color: #D4A853;
            }
            .price-display .total-amount {
                font-size: 44px;
                font-weight: 800;
                color: #fff;
                letter-spacing: -1px;
                text-shadow: 0 4px 20px rgba(212, 168, 83, 0.2);
            }
            .package-badge {
                display: inline-block;
                background: linear-gradient(90deg, #D4A853 0%, #b38936 100%);
                color: #000;
                padding: 6px 20px;
                border-radius: 50px;
                font-size: 13px;
                font-weight: 700;
                letter-spacing: 0.5px;
                box-shadow: 0 5px 15px rgba(212, 168, 83, 0.3);
            }
            .summary-details {
                margin-bottom: 40px;
            }
            .summary-details h4 {
                font-size: 14px;
                color: #fff;
                margin-bottom: 20px;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                font-weight: 600;
            }
            .breakdown-list {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            .breakdown-list li {
                display: flex;
                justify-content: space-between;
                font-size: 14px;
                border-bottom: 1px dashed rgba(255, 255, 255, 0.08);
                padding-bottom: 10px;
            }
            .breakdown-list li span {
                color: rgba(255, 255, 255, 0.6);
            }
            .breakdown-list li strong {
                color: #fff;
            }
            .summary-actions {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            .btn-whatsapp-quote {
                background: linear-gradient(90deg, #D4A853 0%, #b38936 100%);
                color: #000;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 16px 30px;
                border-radius: 50px;
                text-decoration: none;
                font-weight: 700;
                font-size: 15px;
                transition: all 0.3s;
                box-shadow: 0 10px 25px rgba(212, 168, 83, 0.3);
                border: none;
                cursor: pointer;
            }
            .btn-whatsapp-quote:hover {
                background: linear-gradient(90deg, #b38936 0%, #D4A853 100%);
                transform: translateY(-2px);
                box-shadow: 0 15px 30px rgba(212, 168, 83, 0.5);
            }
            .btn-whatsapp-quote svg {
                fill: #000;
            }
            .whatsapp-note {
                font-size: 11px;
                color: rgba(255, 255, 255, 0.5);
                text-align: center;
                line-height: 1.4;
            }

            @media (max-width: 1024px) {
                .estimator-grid {
                    grid-template-columns: 1fr;
                }
            }
            @media (max-width: 600px) {
                .event-type-cards {
                    grid-template-columns: 1fr;
                }
                .decor-grid {
                    grid-template-columns: 1fr;
                }
                .price-display .total-amount {
                    font-size: 34px;
                }
                .estimator-card {
                    padding: 25px;
                }
            }
        </style>

        <div class="container">
            <div class="estimator-header" data-aos="fade-up">
                <span class="estimator-badge">✨ Interactive Planner</span>
                <h2 class="estimator-title">Dream Event <span class="highlight-gold">Budget Estimator</span></h2>
                <p class="estimator-desc">Plan your special day, choose premium services, and get an instant estimated cost in real-time.</p>
            </div>
            
            <div class="estimator-grid" data-aos="zoom-in">
                <!-- Left: Interactive Selections -->
                <div class="estimator-card estimator-form">
                    <!-- Event Type Select -->
                    <div class="estimator-group">
                        <label class="group-label">1. Select Event Type</label>
                        <div class="event-type-cards">
                            @foreach($estimatorTypes as $index => $etype)
                            <div class="type-card {{ $index === 0 ? 'active' : '' }}"
                                 data-type="{{ $etype->name }}"
                                 data-base="{{ $etype->base_price }}">
                                <span class="card-icon">{{ $etype->icon }}</span>
                                <span class="card-label">{{ $etype->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Guest Count Slider -->
                    <div class="estimator-group">
                        <label class="group-label" for="guest-range">2. Total Guests: <span id="guest-val">200</span> Guests</label>
                        <div class="slider-container">
                            <input type="range" id="guest-range" min="50" max="1000" step="50" value="200" class="custom-slider">
                            <div class="slider-labels">
                                <span>50</span>
                                <span>500</span>
                                <span>1000+</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Packages Section -->
                    <div class="estimator-group">
                        <label class="group-label" id="package-section-title">3. Select Package</label>
                        <div class="catering-options">
                            <label class="catering-card active" id="pkg-card-0">
                                <input type="radio" name="catering" value="basic" checked style="display:none;">
                                <div class="c-card-content">
                                    <span class="c-title" id="pkg-title-0">Basic Decor</span>
                                    <span class="c-desc" id="pkg-desc-0">Standard stage, lighting, and seating</span>
                                    <span class="c-price" id="pkg-price-0">PKR 50,000 <small id="pkg-unit-0">(Fixed)</small></span>
                                </div>
                            </label>
                            <label class="catering-card" id="pkg-card-1">
                                <input type="radio" name="catering" value="premium" style="display:none;">
                                <div class="c-card-content">
                                    <span class="c-title" id="pkg-title-1">Premium Decor</span>
                                    <span class="c-desc" id="pkg-desc-1">Floral stage, imported lights, lounge seating</span>
                                    <span class="c-price" id="pkg-price-1">PKR 150,000 <small id="pkg-unit-1">(Fixed)</small></span>
                                </div>
                            </label>
                            <label class="catering-card" id="pkg-card-2">
                                <input type="radio" name="catering" value="luxury" style="display:none;">
                                <div class="c-card-content">
                                    <span class="c-title" id="pkg-title-2">Luxury Decor</span>
                                    <span class="c-desc" id="pkg-desc-2">Royal theme, chandeliers, complete marquee decor</span>
                                    <span class="c-price" id="pkg-price-2">PKR 300,000 <small id="pkg-unit-2">(Fixed)</small></span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Add-on Options (dynamic by type) -->
                    <div class="estimator-group">
                        <label class="group-label" id="addon-section-title">4. Add-on Premium Decor & Services</label>
                        <div class="decor-grid" id="addon-grid">
                            <!-- Items injected by JS based on selected type -->
                        </div>
                    </div>
                </div>

                <!-- Right: Dynamic Results Box -->
                <div class="estimator-card estimator-summary">
                    <div class="summary-top">
                        <h3>Estimated Cost</h3>
                        <div class="price-display">
                            <span class="currency">PKR</span>
                            <span class="total-amount" id="total-amount">0</span>
                        </div>
                        <div class="package-badge" id="package-badge">Standard Plan</div>
                    </div>

                    <div class="summary-details">
                        <h4>Estimator Details</h4>
                        <ul class="breakdown-list">
                            <li>
                                <span>Event Base:</span>
                                <strong id="sum-event">Decor</strong>
                            </li>
                            <li>
                                <span>Total Guests:</span>
                                <strong id="sum-guests">200</strong>
                            </li>
                            <li>
                                <span>Package Selection:</span>
                                <strong id="sum-catering">PKR 0</strong>
                            </li>
                            <li>
                                <span>Add-on Decor Cost:</span>
                                <strong id="sum-decor">PKR 80,000</strong>
                            </li>
                        </ul>
                    </div>

                    <div class="summary-actions">
                        @php
                            $whatsappNumber = '923001789788';
                        @endphp
                        <a id="btn-whatsapp-quote" href="#" target="_blank" class="btn btn-whatsapp-quote">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            Confirm via WhatsApp
                        </a>
                        <small class="whatsapp-note">Clicking will send your selected choices to our team dynamically.</small>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const typeCards = document.querySelectorAll('.type-card');
                const guestRange = document.getElementById('guest-range');
                const guestVal = document.getElementById('guest-val');
                const cateringCards = document.querySelectorAll('.catering-card');
                
                const sumEvent = document.getElementById('sum-event');
                const sumGuests = document.getElementById('sum-guests');
                const sumCatering = document.getElementById('sum-catering');
                const sumDecor = document.getElementById('sum-decor');
                const totalAmount = document.getElementById('total-amount');
                const packageBadge = document.getElementById('package-badge');
                const btnWhatsapp = document.getElementById('btn-whatsapp-quote');

                // Values setup
                let activeType = 'Decor';
                let basePrice = 150000;
                let guestCount = 200;
                let packageRate = 50000;
                let packageName = 'Basic Decor';
                let isPerHead = false;

                // Package Data — loaded from database
                const packagesData = @json($packagesData ?? []);

                // Add-on Items per Type — loaded from database
                const addonsData = @json($addonsData ?? []);

                function updatePackageUI() {
                    const data = packagesData[activeType];
                    document.getElementById('package-section-title').textContent = data.title;
                    
                    // For Venue: show range PKR min – max across all options
                    const isVenue = activeType === 'Venue';
                    const minPrice = Math.min(...data.options.map(o => o.price));
                    const maxPrice = Math.max(...data.options.map(o => o.price));

                    for(let i=0; i<3; i++) {
                        document.getElementById('pkg-title-'+i).textContent = data.options[i].name;
                        document.getElementById('pkg-desc-'+i).textContent = data.options[i].desc;
                        if (isVenue) {
                            document.getElementById('pkg-price-'+i).innerHTML =
                                'PKR ' + formatNumber(minPrice) + ' – ' + formatNumber(maxPrice) +
                                ' <small id="pkg-unit-'+i+'">(Range)</small>';
                        } else {
                            document.getElementById('pkg-price-'+i).innerHTML =
                                'PKR ' + formatNumber(data.options[i].price) +
                                ' <small id="pkg-unit-'+i+'">' + (data.options[i].perHead ? '/ head' : '(Fixed)') + '</small>';
                        }
                    }
                    
                    // Reset selection to basic when switching type
                    cateringCards.forEach(c => c.classList.remove('active'));
                    document.getElementById('pkg-card-0').classList.add('active');
                    document.querySelector('#pkg-card-0 input').checked = true;
                    
                    packageRate = data.options[0].price;
                    packageName = data.options[0].name;
                    isPerHead = data.options[0].perHead;

                    // Update Add-on grid based on active type
                    const addonData = addonsData[activeType];
                    document.getElementById('addon-section-title').textContent = addonData.title;
                    const addonGrid = document.getElementById('addon-grid');
                    addonGrid.innerHTML = '';
                    addonData.items.forEach(item => {
                        const label = document.createElement('label');
                        label.className = 'decor-item';
                        label.innerHTML = `
                            <input type="checkbox" id="${item.id}" data-price="${item.price}" ${item.checked ? 'checked' : ''}>
                            <span class="decor-box"></span>
                            <span class="decor-name">${item.name}</span>`;
                        addonGrid.appendChild(label);
                    });

                    // Re-bind checkbox listeners after DOM rebuild
                    addonGrid.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                        cb.addEventListener('change', calculateEstimates);
                    });
                }

                // Type Card Click
                typeCards.forEach(card => {
                    card.addEventListener('click', () => {
                        typeCards.forEach(c => c.classList.remove('active'));
                        card.classList.add('active');
                        activeType = card.getAttribute('data-type');
                        basePrice = parseInt(card.getAttribute('data-base'));
                        
                        updatePackageUI();
                        calculateEstimates();
                    });
                });

                // Guest range slider
                guestRange.addEventListener('input', () => {
                    guestCount = parseInt(guestRange.value);
                    guestVal.textContent = guestCount;
                    calculateEstimates();
                });

                // Catering/Package select
                cateringCards.forEach((card, index) => {
                    card.addEventListener('click', () => {
                        cateringCards.forEach(c => c.classList.remove('active'));
                        card.classList.add('active');
                        
                        const radio = card.querySelector('input[type="radio"]');
                        radio.checked = true;
                        
                        const data = packagesData[activeType];
                        packageRate = data.options[index].price;
                        packageName = data.options[index].name;
                        isPerHead = data.options[index].perHead;
                        
                        calculateEstimates();
                    });
                });

                // Decor checkboxes — initial bind handled in updatePackageUI after grid is built

                function formatNumber(num) {
                    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }

                function calculateEstimates() {
                    // Compute package cost
                    const packageCost = isPerHead ? (guestCount * packageRate) : packageRate;
                    
                    // Compute addon cost from dynamically rendered grid
                    let decorCost = 0;
                    let chosenDecor = [];
                    document.querySelectorAll('#addon-grid input[type="checkbox"]').forEach(cb => {
                        if (cb.checked) {
                            decorCost += parseInt(cb.getAttribute('data-price'));
                            chosenDecor.push(cb.parentNode.querySelector('.decor-name').textContent);
                        }
                    });

                    // Compute total
                    const total = packageCost + decorCost;

                    // Update view
                    sumEvent.textContent = activeType;
                    sumGuests.textContent = guestCount;
                    sumCatering.textContent = 'PKR ' + formatNumber(packageCost);
                    sumDecor.textContent = 'PKR ' + formatNumber(decorCost);
                    totalAmount.textContent = formatNumber(total);

                    // Update Badge
                    if (total < 500000) {
                        packageBadge.textContent = 'Silver Standard Package';
                        packageBadge.style.background = 'linear-gradient(90deg, #d1d5db 0%, #9ca3af 100%)';
                    } else if (total < 1000000) {
                        packageBadge.textContent = 'Gold Elite Package';
                        packageBadge.style.background = 'linear-gradient(90deg, #D4A853 0%, #b38936 100%)';
                    } else {
                        packageBadge.textContent = 'Imperial Royal Package';
                        packageBadge.style.background = 'linear-gradient(90deg, #ff4e50 0%, #f9d423 100%)';
                        packageBadge.style.color = '#fff';
                    }

                    // WhatsApp message compile
                    const adminWhatsapp = "923001789788";
                    const decorString = chosenDecor.length > 0 ? chosenDecor.join(', ') : 'None';
                    const msg = `Hello MG Food & Event Planners! I estimated my event budget on your website:\n\n• Event Type: ${activeType}\n• Guest Count: ${guestCount} Guests\n• Selected Package: ${packageName} (PKR ${formatNumber(packageCost)})\n• Chosen Add-ons: ${decorString} (PKR ${formatNumber(decorCost)})\n\nTotal Estimated Budget: PKR ${formatNumber(total)}\n\nI would like to discuss and book this setup. Please contact me back. Thank you!`;

                    btnWhatsapp.href = `https://wa.link/w6svw6?text=` + encodeURIComponent(msg);
                }

                // Initial load
                updatePackageUI();
                calculateEstimates();
            });
        </script>
    </section>

    <!-- Separator Line -->
    <div style="height: 1px; background: linear-gradient(to right, transparent, #e0e0e0, transparent); margin: 0;">
    </div>

    <!-- Portfolio Section -->
    <section class="portfolio" id="portfolio">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">What We Offer — Crafted for You</h2>
                <p class="section-description">
                    Corporate events, weddings, catering, and more — all perfectly planned under one roof.
                </p>
            </div>

            <div class="portfolio-grid"
                style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; max-width: 1400px; margin: 0 auto;">
                @forelse($portfolioItems as $index => $item)
                    <div class="portfolio-item" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}"
                        style="height: 450px;">
                        <div class="portfolio-image" style="height: 100%;">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                style="height: 100%; object-fit: cover;">
                            <div class="portfolio-overlay">
                                <h3>{{ $item->title }}</h3>
                                <p>{!! $item->description !!}</p>
                                <a href="{{ route('portfolio') }}" class="btn-view-more">View More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback if no portfolio items -->
                    <div class="portfolio-item" data-aos="zoom-in">
                        <div class="portfolio-image">
                            <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop"
                                alt="Wedding Events">
                            <div class="portfolio-overlay">
                                <h3>Wedding Events</h3>
                                <p>Add portfolio items from admin panel to display here.</p>
                                <a href="{{ route('portfolio') }}" class="btn-view-more">View More</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Separator Line -->

    <!-- Venues Section -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">Our Venues</span>
                <h2 class="section-title">Exquisite Event Venues</h2>
                <p class="section-description">
                    Discover the perfect setting for your next event. From grand ballrooms to intimate spaces, we offer
                    exclusive venues tailored to your unique requirements.
                </p>
            </div>

            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3>Corporate Events</h3>
                    <p>We are the best corporate event planners in Karachi, organizing all kinds of seminars, product
                        launches, ceremonies & more. We've worked with various multinational clients making their events
                        successful.</p>
                    <a href="{{ route('contact') }}" class="service-link">Read More →</a>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                        </svg>
                    </div>
                    <h3>Wedding Planning</h3>
                    <p>As a leading wedding event planner in Karachi, we take care of your big day from start to finish.
                        We take care of wedding photography, catering, decoration and everything possible to make your
                        wedding memorable for your family and friends.</p>
                    <a href="{{ route('contact') }}" class="service-link">Read More →</a>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                    </div>
                    <h3>Catering Services</h3>
                    <p>MG event planners offer the best catering services in Karachi. It's not just about the food but
                        the taste that lasts for years. Explore our catering menu and choose the best cuisine for your
                        special day.</p>
                    <a href="{{ route('contact') }}" class="service-link">Read More →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Separator Line -->
    <div style="height: 1px; background: linear-gradient(to right, transparent, #ddd, transparent); margin: 0;"></div>

    <!-- Meet Our Board Members Section -->
    <section style="padding: 100px 0; background: #fff;">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 60px;">
                <h2 style="font-size: 36px; font-weight: 700; color: #1a1a2e;">
                    <span style="color: #D4A853;">Meet</span> Our Board Members
                </h2>
                <a href="{{ route('about') }}"
                    style="background: #D4A853; color: #000; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                    Explore More
                    <span>→</span>
                </a>
            </div>

            <div class="board-members-grid"
                style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 40px; max-width: 800px; margin: 0 auto;">
                <!-- CEO Card -->
                <div
                    style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center;">
                    <div style="width: 100%; height: 300px; overflow: hidden;">
                        @php
                            $ceoImage = $siteSettings['ceo_image'] ?? null;
                            $ceoPath = $ceoImage ? asset('storage/' . $ceoImage) : asset('images/CEO.jpg');
                        @endphp
                        <img src="{{ $ceoPath }}" alt="CEO" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 25px;">
                        <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">CEO</h4>
                        <p style="color: #666; font-size: 14px; margin: 0 0 15px 0;">Tanveer Ahmed</p>
                        <a href="https://wa.me/923001234567" target="_blank"
                            style="display: inline-flex; align-items: center; gap: 8px; background: #D4A853; color: #000; padding: 10px 20px; border-radius: 25px; text-decoration: none; font-size: 14px; font-weight: 600;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#000">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Director Card -->
                <div
                    style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center;">
                    <div style="width: 100%; height: 300px; overflow: hidden;">
                        @php
                            $directorImage = $siteSettings['director_image'] ?? null;
                            $directorPath = $directorImage ? asset('storage/' . $directorImage) : asset('images/Director.jpg');
                        @endphp
                        <img src="{{ $directorPath }}" alt="Director"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 25px;">
                        <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">Director</h4>
                        <p style="color: #666; font-size: 14px; margin: 0 0 15px 0;">Sheraz Mustafa</p>
                        <a href="https://wa.me/923217654321" target="_blank"
                            style="display: inline-flex; align-items: center; gap: 8px; background: #D4A853; color: #000; padding: 10px 20px; border-radius: 25px; text-decoration: none; font-size: 14px; font-weight: 600;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#000">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Separator Line -->
    <div style="height: 1px; background: linear-gradient(to right, transparent, #ddd, transparent); margin: 0;"></div>

    @if(isset($reels) && $reels->count() > 0)
        <!-- ===== Reels Section ===== -->
        <section style="padding: 80px 0; background: #ffffff; overflow: hidden; position: relative;">

            <!-- Background glow -->
            <div
                style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:600px; height:300px; background:radial-gradient(ellipse, rgba(212,168,83,0.05) 0%, transparent 70%); pointer-events:none;">
            </div>

            <style>
                /* Reels scroll track */
                .home-reels-wrapper {
                    overflow: hidden;
                    mask-image: linear-gradient(to right, transparent 0%, black 8%, black 92%, transparent 100%);
                    -webkit-mask-image: linear-gradient(to right, transparent 0%, black 8%, black 92%, transparent 100%);
                }

                .home-reels-track {
                    display: flex;
                    gap: 20px;
                    width: max-content;
                    padding: 10px 0;
                    animation: homeReelsScroll 30s linear infinite;
                }

                .home-reels-track:hover {
                    animation-play-state: paused;
                }

                @keyframes homeReelsScroll {
                    0% {
                        transform: translateX(0);
                    }

                    100% {
                        transform: translateX(-50%);
                    }
                }

                .home-reel-card {
                    width: 190px;
                    flex-shrink: 0;
                    border-radius: 18px;
                    overflow: hidden;
                    background: #fff;
                    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
                    cursor: pointer;
                    position: relative;
                    transition: transform 0.3s, box-shadow 0.3s;
                    border: 1px solid #eee;
                }

                .home-reel-card:hover {
                    transform: translateY(-8px) scale(1.03);
                    box-shadow: 0 20px 50px rgba(212, 168, 83, 0.15);
                    border-color: #D4A853;
                }

                .home-reel-frame {
                    position: relative;
                    padding-bottom: 177.77%;
                    height: 0;
                    overflow: hidden;
                    background: #000;
                }

                .home-reel-frame iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border: none;
                    pointer-events: none;
                }

                .home-reel-hover {
                    position: absolute;
                    inset: 0;
                    background: linear-gradient(to top, rgba(0, 0, 0, 0.75) 0%, transparent 55%);
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-end;
                    padding: 14px;
                    opacity: 0;
                    transition: opacity 0.3s;
                }

                .home-reel-card:hover .home-reel-hover {
                    opacity: 1;
                }

                .home-reel-play {
                    width: 40px;
                    height: 40px;
                    background: #D4A853;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 16px;
                    margin-bottom: 8px;
                    box-shadow: 0 4px 15px rgba(212, 168, 83, 0.5);
                    color: #000;
                    font-weight: 900;
                }

                .home-reel-label {
                    color: #fff;
                    font-size: 12px;
                    font-weight: 600;
                    line-height: 1.3;
                    font-family: 'Inter', sans-serif;
                }

                /* Reel Modal */
                #homeReelModal {
                    display: none;
                    position: fixed;
                    inset: 0;
                    z-index: 99999;
                    background: rgba(0, 0, 0, 0.93);
                    align-items: center;
                    justify-content: center;
                }

                #homeReelModal.open {
                    display: flex;
                }

                .home-reel-modal-box {
                    position: relative;
                    width: min(370px, 88vw);
                    border-radius: 20px;
                    overflow: hidden;
                    background: #000;
                    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.7);
                }

                .home-reel-modal-box iframe {
                    width: 100%;
                    aspect-ratio: 9/16;
                    border: none;
                    display: block;
                }

                .home-reel-modal-close {
                    position: absolute;
                    top: 12px;
                    right: 12px;
                    width: 34px;
                    height: 34px;
                    background: rgba(255, 255, 255, 0.15);
                    border: none;
                    border-radius: 50%;
                    color: #fff;
                    font-size: 16px;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    backdrop-filter: blur(10px);
                    z-index: 10;
                    transition: background 0.2s;
                }

                .home-reel-modal-close:hover {
                    background: #D4A853;
                    color: #000;
                }
            </style>

            <div class="container" style="margin-bottom: 44px;">
                <div data-aos="fade-up"
                    style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
                    <div>
                        <span
                            style="display:inline-block; background:#D4A853; color:#000; padding:5px 16px; border-radius:50px; font-size:12px; font-weight:700; letter-spacing:2px; text-transform:uppercase; margin-bottom:12px;">🎬
                            Our Reels</span>
                        <h2
                            style="font-family:'Playfair Display',serif; font-size:clamp(26px,4vw,42px); font-weight:800; color:#1a1a2e; margin:0; line-height:1.2;">
                            Watch Our <span style="color:#D4A853;">Event Highlights</span>
                        </h2>
                    </div>
                    <a href="{{ route('reels') }}"
                        style="display:inline-flex; align-items:center; gap:8px; background:rgba(212,168,83,0.1); border:1px solid rgba(212,168,83,0.3); color:#D4A853; padding:12px 24px; border-radius:50px; text-decoration:none; font-weight:600; font-size:14px; transition:all 0.3s;"
                        onmouseover="this.style.background='rgba(212,168,83,0.2)'"
                        onmouseout="this.style.background='rgba(212,168,83,0.1)'">
                        View All Reels →
                    </a>
                </div>
            </div>

            <div class="home-reels-wrapper">
                <div class="home-reels-track" id="homeReelsTrack">
                    @foreach($reels as $reel)
                        @php
                            $videoUrl = ($reel->type === 'file') ? asset('storage/' . $reel->video_path) : $reel->embed_url;
                        @endphp
                        <div class="home-reel-card"
                            onmouseenter="const v=this.querySelector('video'); if(v) v.play()"
                            onmouseleave="const v=this.querySelector('video'); if(v) { v.pause(); v.currentTime = 0.1; }"
                            onclick="openHomeReel('{{ $videoUrl }}', '{{ addslashes($reel->title) }}', '{{ $reel->type }}')">
                            <div class="home-reel-frame">
                                @if($reel->type === 'file')
                                    <video class="hover-video" src="{{ $videoUrl }}#t=0.1" 
                                        @if($reel->thumbnail) poster="{{ asset('storage/' . $reel->thumbnail) }}" @endif
                                        muted loop playsinline preload="metadata" 
                                        style="width:100%; height:100%; object-fit:cover;"></video>
                                @else
                                    <iframe src="{{ $reel->embed_url }}"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen loading="lazy"></iframe>
                                @endif
                            </div>
                            <div class="home-reel-hover">
                                <div class="home-reel-play">▶</div>
                                <div class="home-reel-label">{{ $reel->title }}</div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Duplicate set for infinite loop --}}
                    @foreach($reels as $reel)
                        @php
                            $videoUrl = ($reel->type === 'file') ? asset('storage/' . $reel->video_path) : $reel->embed_url;
                        @endphp
                        <div class="home-reel-card"
                            onmouseenter="const v=this.querySelector('video'); if(v) v.play()"
                            onmouseleave="const v=this.querySelector('video'); if(v) { v.pause(); v.currentTime = 0.1; }"
                            onclick="openHomeReel('{{ $videoUrl }}', '{{ addslashes($reel->title) }}', '{{ $reel->type }}')">
                            <div class="home-reel-frame">
                                @if($reel->type === 'file')
                                    <video class="hover-video" src="{{ $videoUrl }}#t=0.1" 
                                        @if($reel->thumbnail) poster="{{ asset('storage/' . $reel->thumbnail) }}" @endif
                                        muted loop playsinline preload="metadata" 
                                        style="width:100%; height:100%; object-fit:cover;"></video>
                                @else
                                    <iframe src="{{ $reel->embed_url }}"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen loading="lazy"></iframe>
                                @endif
                            </div>
                            <div class="home-reel-hover">
                                <div class="home-reel-play">▶</div>
                                <div class="home-reel-label">{{ $reel->title }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Reel Modal -->
            <div id="homeReelModal" onclick="if(event.target===this) closeHomeReel()">
                <div class="home-reel-modal-box">
                    <button class="home-reel-modal-close" onclick="closeHomeReel()">✕</button>
                    <!-- Player for Links (YouTube/FB) -->
                    <iframe id="homeReelIframe" src=""
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen style="display:none; width:100%; aspect-ratio:9/16; border:none;"></iframe>
                    <!-- Player for Uploaded Files -->
                    <video id="homeReelVideo" controls autoplay playsinline style="width:100%; aspect-ratio:9/16; display:none; background:#000;"></video>
                </div>
            </div>
            <script>
                function openHomeReel(url, title, type) {
                    const modal = document.getElementById('homeReelModal');
                    const iframe = document.getElementById('homeReelIframe');
                    const video = document.getElementById('homeReelVideo');

                    if (type === 'file') {
                        iframe.style.display = 'none';
                        iframe.src = '';
                        video.style.display = 'block';
                        video.src = url;
                        video.play();
                    } else {
                        let src = url;
                        // Only add autoplay to YouTube/Vimeo if not already present
                        if (url.includes('youtube.com') || url.includes('vimeo.com')) {
                            src = url.includes('?') ? url + '&autoplay=1' : url + '?autoplay=1';
                        }
                        video.style.display = 'none';
                        video.src = '';
                        iframe.style.display = 'block';
                        iframe.src = src;
                    }

                    modal.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }

                function closeHomeReel() {
                    const modal = document.getElementById('homeReelModal');
                    const iframe = document.getElementById('homeReelIframe');
                    const video = document.getElementById('homeReelVideo');

                    iframe.src = '';
                    video.src = '';
                    video.pause();
                    modal.classList.remove('open');
                    document.body.style.overflow = '';
                }
                document.addEventListener('keydown', e => { if (e.key === 'Escape') closeHomeReel(); });
                // Adjust speed by count
                const homeReelCount = {{ $reels->count() }};
                document.getElementById('homeReelsTrack').style.animationDuration = Math.max(20, homeReelCount * 8) + 's';
            </script>
        </section>

        <!-- Separator Line -->
        <div style="height: 1px; background: linear-gradient(to right, transparent, #ddd, transparent); margin: 0;"></div>
    @endif


    <!-- Wedding Feature Section -->
    <section class="wedding-feature">
        <div class="container">
            <div class="feature-grid">
                <div class="feature-left" data-aos="fade-right">
                    <div class="laptop-frame">
                        <div class="laptop-screen">
                            <video width="100%" height="100%" autoplay muted loop playsinline
                                style="border-radius: 8px; object-fit: cover;">
                                @php
                                    $weddingVideo = $siteSettings['wedding_feature_video'] ?? null;
                                    $weddingVideoPath = $weddingVideo ? asset('storage/' . $weddingVideo) : asset('Video/marena club.mp4');
                                @endphp
                                <source src="{{ $weddingVideoPath }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="laptop-base"></div>
                    </div>
                </div>
                <div class="feature-right" data-aos="fade-left">
                    <h2 class="feature-title">We Are The Best <span class="highlight-blue">Wedding</span> Planning
                        Organizers and Coordinators In Pakistan</h2>
                    <p class="feature-description">
                        MG Food & Event Planners is a <b>leading wedding and event planning company in Karachi</b>, with
                        <b>over 15 years of experience</b> in creating elegant and unforgettable wedding events. From
                        beautiful Nikkah ceremonies to grand wedding celebrations, our <b>professional team</b> plans
                        and executes every detail with precision and care.
                    </p>
                    <p class="feature-description">
                        Having successfully delivered <b>hundreds of wedding events</b>, we understand our clients'
                        vision and transform it into a flawless reality. As a trusted and <b>award-winning event planner
                            in Karachi</b>, we are known for <b>premium décor, seamless coordination, and exceptional
                            service quality</b>.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Book Your Event</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Section -->
    <section class="clients-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">Our Clients</span>
                <h2 class="section-title">Trusted By Many Clients</h2>
            </div>

            <div class="clients-slider-wrapper" data-aos="fade-up" data-aos-delay="100">
                <div class="clients-track">
                    @forelse($clients as $client)
                        <div class="client-card">
                            <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}">
                        </div>
                    @empty
                        <!-- Fallback placeholders if no clients in database -->
                        <div class="client-card">
                            <img src="https://placehold.co/200x100/png?text=Client+1" alt="Client 1">
                        </div>
                        <div class="client-card">
                            <img src="https://placehold.co/200x100/png?text=Client+2" alt="Client 2">
                        </div>
                        <div class="client-card">
                            <img src="https://placehold.co/200x100/png?text=Client+3" alt="Client 3">
                        </div>
                    @endforelse

                    {{-- Repeat for seamless loop --}}
                    @foreach($clients as $client)
                        <div class="client-card">
                            <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="about-grid">
                <div class="about-content" data-aos="fade-right">
                    <span class="section-subtitle">{{ $siteSettings['home_about_badge'] ?? 'Who We Are' }}</span>
                    <h2 class="section-title">
                        {{ $siteSettings['home_about_title'] ?? "Pakistan's Premier Event Architects" }}
                    </h2>
                    @if(isset($siteSettings['home_about_description']) && !empty($siteSettings['home_about_description']))
                        <div class="about-text-container">
                            @foreach(explode("\n", $siteSettings['home_about_description']) as $para)
                                @if(trim($para))
                                    <p class="about-text">{{ trim($para) }}</p>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="about-text">
                            MG Food & Event Planner is a trusted and <b>award-winning event management company in
                                Pakistan</b>, delivering exceptional events for <b>over 15 years</b>. We specialize in
                            wedding planning, corporate events, and luxury celebrations, creating flawless experiences that
                            leave a lasting impression.
                        </p>
                        <p class="about-text">
                            Our expertise spans across weddings, corporate functions, brand launches, conferences, and
                            private events. Every event is carefully planned to align with our clients' vision, brand
                            identity, and objectives — ensuring creativity, precision, and perfection at every step.
                        </p>
                        <p class="about-text">
                            From elegant Nikkah ceremonies to grand wedding receptions, our <b>wedding planning services</b>
                            focus on personalized themes, <b>premium décor, seamless coordination, and flawless
                                execution</b>. We believe every celebration should be unique, memorable, and stress-free.
                        </p>
                        <p class="about-text">
                            From venue selection and logistics management to décor, catering, and complete event execution,
                            we handle everything with professionalism and care. Whether it's a corporate gathering or a
                            wedding celebration, MG Food & Event Planner delivers events that exceed expectations.
                        </p>
                    @endif
                    <div class="about-features">
                        <div class="about-feature">
                            <div class="feature-icon">✓</div>
                            <div class="feature-content">
                                <h4>Creative Excellence</h4>
                                <p>Innovative concepts and customized event designs</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon">✓</div>
                            <div class="feature-content">
                                <h4>Expert Team</h4>
                                <p>Highly skilled and experienced event professionals</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon">✓</div>
                            <div class="feature-content">
                                <h4>On-Time Delivery</h4>
                                <p>Punctual execution with zero compromise on quality</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon">✓</div>
                            <div class="feature-content">
                                <h4>24/7 Support</h4>
                                <p>Always available to assist you at every stage</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ $siteSettings['home_about_btn_link'] ?? route('contact') }}" class="btn btn-primary"
                        style="margin-top: 30px;">
                        {{ $siteSettings['home_about_btn_text'] ?? 'Discover Our Journey' }}
                    </a>
                </div>

                <div class="about-image" data-aos="fade-left">
                    @php
                        $teamPhoto = $siteSettings['team_photo'] ?? null;
                        $teamPhotoPath = $teamPhoto ? asset('storage/' . $teamPhoto) : asset('images/team-photo.jpg.JPG');
                    @endphp
                    <img src="{{ $teamPhotoPath }}" alt="MG Food & Event Planners Team">
                    <div class="experience-badge">
                        <h3>15+</h3>
                        <p>Years of Excellence</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Premium Info Section (Added per User Image Request) -->
        <section class="premium-info-section">
            <div class="container">
                <div class="premium-info-grid">
                    <!-- Left: Overlapping Images -->
                    <div class="premium-info-images" data-aos="fade-right">
                        @php
                            $venueHall = $siteSettings['venue_hall_image'] ?? null;
                            $venueHallPath = $venueHall ? asset('storage/' . $venueHall) : asset('images/venue-hall.JPG');
                            $eventSetup = $siteSettings['event_setup_image'] ?? null;
                            $eventSetupPath = $eventSetup ? asset('storage/' . $eventSetup) : asset('images/event-setup.JPG');
                        @endphp
                        <img src="{{ $venueHallPath }}" alt="Exquisite Hall" class="image-back">
                        <img src="{{ $eventSetupPath }}" alt="Premium Event Setup" class="image-front">
                    </div>

                    <!-- Right: Content -->
                    <div class="premium-info-content" data-aos="fade-left">
                        <div class="premium-info-subtitle">AWARD WINNING</div>
                        <h2 class="premium-info-title">Best Event Planner Award Winner from DHA Creek Club</h2>
                        <p class="premium-info-desc">
                            MG Food & Event Planner is proudly honored with the <b>Best Event Planner Award</b> by DHA
                            Creek Club, recognizing our excellence, creativity, and commitment to delivering premium
                            events in Karachi.
                        </p>
                        <p class="premium-info-desc">
                            Trusted by leading brands and prestigious venues, we specialize in weddings, corporate
                            events, brand activations, and luxury celebrations, delivering flawless execution from
                            concept to completion.
                        </p>
                        <p class="premium-info-desc">
                            From elegant décor to seamless coordination, our team ensures every event reflects quality,
                            professionalism, and unforgettable experiences.
                        </p>

                        <div class="premium-info-bottom">
                            <div class="experience-card">
                                <div class="icon-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3>Award</h3>
                                <p>Best Event Planner</p>
                                <small style="color: #666; font-size: 12px;">Awarded by DHA Creek Club</small>
                            </div>
                            <ul class="feature-list">
                                <li><span class="check-icon">✓</span> Award-Winning Event Planning Services</li>
                                <li><span class="check-icon">✓</span> Premium Quality & Creative Concepts</li>
                                <li><span class="check-icon">✓</span> 100% Client Satisfaction</li>
                                <li><span class="check-icon">✓</span> Professional & Experienced Team</li>
                                <li><span class="check-icon">✓</span> Trusted by Top Brands & Venues</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Achievements Section (Dark Theme) -->
        <section class="achievements-section">
            <div class="container">
                <div class="achievements-grid">
                    <div class="achievements-left" data-aos="fade-right">
                        <h2>Our Achievements</h2>
                        <p>Passion, creativity, and flawless execution define us — transforming ordinary gatherings into
                            extraordinary experiences as Pakistan’s trusted event planners.</p>
                        <a href="{{ route('contact') }}" class="btn-white">Schedule a Call</a>
                    </div>
                    <div class="stats-grid" data-aos="fade-left">
                        <div class="stat-box">
                            <span class="stat-icon">🛡️</span>
                            <h3>{{ $siteSettings['stat1_number'] ?? '500+' }}</h3>
                            <hr>
                            <p>{{ $siteSettings['stat1_label'] ?? 'Events Completed' }}</p>
                        </div>
                        <div class="stat-box">
                            <span class="stat-icon">📋</span>
                            <h3>{{ $siteSettings['stat2_number'] ?? '15+' }}</h3>
                            <hr>
                            <p>{{ $siteSettings['stat2_label'] ?? 'Years Experience' }}</p>
                        </div>
                        <div class="stat-box">
                            <span class="stat-icon">🌟</span>
                            <h3>{{ $siteSettings['stat3_number'] ?? '50+' }}</h3>
                            <hr>
                            <p>{{ $siteSettings['stat3_label'] ?? 'Expert Team' }}</p>
                        </div>
                        <div class="stat-box">
                            <span class="stat-icon">📅</span>
                            <h3>{{ $siteSettings['stat4_number'] ?? '100%' }}</h3>
                            <hr>
                            <p>{{ $siteSettings['stat4_label'] ?? 'Client Satisfaction' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Google Reviews Section -->
        @if(!empty($siteSettings['google_review_code']))
            <section class="reviews-section"
                style="padding: 100px 0; background: #ffffff; overflow: hidden; border-top: 1px solid #f0f0f0; margin-top: 20px;">
                <div class="container">
                    <div class="section-header" data-aos="fade-up" style="text-align: center; margin-bottom: 40px;">
                        <span class="section-subtitle" style="color: var(--primary);">GOOGLE REVIEWS</span>
                        <h2 class="section-title" style="color: #1a1a2e;">Real Experiences Shared on Google</h2>
                    </div>
                    <div class="google-widget-container" style="background: transparent; border-radius: 20px;">
                        {!! $siteSettings['google_review_code'] !!}
                    </div>
                </div>
            </section>
        @elseif($reviews->count() > 0)
            <section class="reviews-section"
                style="padding: 100px 0; background: #ffffff; overflow: hidden; border-top: 1px solid #f0f0f0; margin-top: 20px;">
                <div class="container">
                    <div class="section-header" data-aos="fade-up" style="text-align: center; margin-bottom: 60px;">
                        <span class="section-subtitle" style="color: var(--primary);">CLIENT TESTIMONIALS</span>
                        <h2 class="section-title" style="color: #1a1a2e;">What Our Clients Say on Google</h2>
                        <div style="width: 80px; height: 3px; background: var(--primary); margin: 20px auto;"></div>
                    </div>

                    <div class="reviews-slider" data-aos="fade-up">
                        <div class="reviews-track">
                            @foreach($reviews as $review)
                                <div class="review-card">
                                    <div class="review-header">
                                        @if($review->author_photo)
                                            <img src="{{ asset($review->author_photo) }}" alt="{{ $review->author_name }}"
                                                class="review-avatar">
                                        @else
                                            <div class="review-avatar-placeholder">{{ substr($review->author_name, 0, 1) }}</div>
                                        @endif
                                        <div class="review-meta">
                                            <h4>{{ $review->author_name }}</h4>
                                            <div class="review-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                                @endfor
                                            </div>
                                            @if($review->review_date)
                                                <span class="review-date">{{ $review->review_date }}</span>
                                            @endif
                                        </div>
                                        <div class="google-logo-icon">
                                            <svg viewBox="0 0 24 24" width="24" height="24">
                                                <path
                                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                                    fill="#4285F4" />
                                                <path
                                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                                    fill="#34A853" />
                                                <path
                                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                                    fill="#FBBC05" />
                                                <path
                                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                                    fill="#EA4335" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-body">
                                        <p>"{{ $review->text }}"</p>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Duplicate reviews for seamless loop if count is small --}}
                            @if($reviews->count() < 6)
                                @foreach($reviews as $review)
                                    <div class="review-card second-loop">
                                        <div class="review-header">
                                            @if($review->author_photo)
                                                <img src="{{ asset($review->author_photo) }}" alt="{{ $review->author_name }}"
                                                    class="review-avatar">
                                            @else
                                                <div class="review-avatar-placeholder">{{ substr($review->author_name, 0, 1) }}</div>
                                            @endif
                                            <div class="review-meta">
                                                <h4>{{ $review->author_name }}</h4>
                                                <div class="review-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="google-logo-icon">
                                                <svg viewBox="0 0 24 24" width="24" height="24">
                                                    <path
                                                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                                        fill="#4285F4" />
                                                    <path
                                                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                                        fill="#34A853" />
                                                    <path
                                                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                                        fill="#FBBC05" />
                                                    <path
                                                        d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                                        fill="#EA4335" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="review-body">
                                            <p>"{{ $review->text }}"</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Contact Section -->
        <section class="contact" id="contact">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-subtitle">Get In Touch</span>
                    <h2 class="section-title">Make Your Event Unforgettable</h2>
                    <p class="section-description">
                        Let's discuss your event and bring your vision to life. Fill out the form below or contact us
                        directly.
                    </p>
                </div>

                <div class="contact-grid">
                    <div class="contact-form-wrapper" data-aos="fade-right">
                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form" id="contactForm"
                            target="_blank">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Full Name *</label>
                                    <input type="text" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Phone Number *</label>
                                    <input type="tel" id="phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="event-type">Event Type *</label>
                                    <select id="event-type" name="event_type" required>
                                        <option value="">Select Event Type</option>
                                        @php
                                            $contactEventTypes = \App\Models\EventType::active()->get();
                                        @endphp
                                        @foreach($contactEventTypes as $type)
                                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="guests">Expected Guests</label>
                                <input type="number" id="guests" name="guests" placeholder="Approximate number">
                            </div>
                            <div class="form-group">
                                <label for="message">Tell Us About Your Event *</label>
                                <textarea id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">Get a Quote</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="map-section" style="padding: 100px 0; background: #fff;">
            <div class="container">
                <div class="section-header" data-aos="fade-up" style="text-align: center; margin-bottom: 50px;">
                    <h2 class="section-title">Locate Us</h2>
                    <p class="section-description">Detailed map locations for our head office and production facility.
                    </p>
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
                            if (is_string($officeMap) && str_contains($officeMap, '<iframe')) {
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
                            if (is_string($kitchenMap) && str_contains($kitchenMap, '<iframe')) {
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

        <!-- Professional Footer -->
        <footer class="main-footer">
            <!-- CTA Section -->
            <div class="footer-cta">
                <div class="container">
                    <div class="cta-content">
                        <div class="cta-text">
                            <span class="cta-subtitle">BOOK AN APPOINTMENT TODAY</span>
                            <h2>{!! $siteSettings['cta_title'] ?? 'Make Your Event Unforgettable with <br><b>MG Food & Event Planner</b>' !!}
                            </h2>
                            @if(isset($siteSettings['cta_description']))
                                <p style="color: rgba(255,255,255,0.8); margin-top: 10px;">
                                    {{ $siteSettings['cta_description'] }}
                                </p>
                            @endif
                        </div>
                        <a href="{{ $siteSettings['cta_btn_link'] ?? route('contact') }}"
                            class="btn-cta">{{ $siteSettings['cta_btn_text'] ?? 'Book Your Event Now' }} <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg></a>
                    </div>
                </div>
            </div>

            <!-- Main Footer Content -->
            <div class="footer-content">
                <div class="container">
                    <div class="footer-grid">
                        <!-- Brand Column -->
                        <div class="footer-col brand-col">
                            <div class="footer-logo">
                                <h2>MG <span class="highlight">Food & Event Planner</span></h2>
                                <p class="brand-subtitle">FOOD & EVENT PLANNERS</p>
                            </div>
                            <p class="brand-desc">MG Food & Event Planner is a trusted and professional event management
                                company in Karachi, specializing in wedding planning, corporate events, catering
                                services, and luxury celebrations. With over 15 years of experience, we deliver creative
                                concepts, flawless execution, and unforgettable experiences tailored to every client's
                                vision.</p>
                            <div class="footer-social">
                                @if(isset($siteSettings['social_facebook']))
                                    <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                    </a>
                                @endif
                                @if(isset($siteSettings['social_instagram']))
                                    <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                    </a>
                                @endif
                                @if(isset($siteSettings['social_youtube']))
                                    <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                        </svg>
                                    </a>
                                @endif
                                @if(isset($siteSettings['social_tiktok']))
                                    <a href="{{ $siteSettings['social_tiktok'] }}" target="_blank" class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Links Column -->
                        <div class="footer-col">
                            <h3>Quick Links</h3>
                            <ul class="footer-links">
                                <li><a href="{{ route('home') }}">Best Event Planner in Karachi</a></li>
                                <li><a href="{{ route('services') }}">Exclusive Event Venues</a></li>
                                <li><a href="{{ route('services') }}">Wedding & Party Venues</a></li>
                                <li><a href="{{ route('services') }}">Corporate Venues</a></li>
                                <li><a href="{{ route('services') }}">Venues Catering</a></li>
                                <li><a href="{{ route('portfolio') }}">Gallery</a></li>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                        </div>

                        <!-- Contact Us Column -->
                        <div class="footer-col contact-col">
                            <h3>Contact Us</h3>
                            <ul class="contact-list">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span><strong>Our Office:</strong> Office No. 1, Mezzanine Floor, Building No. 19-C,
                                        Phase 2 Extension, DHA, Karachi</span>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span><strong>Our Kitchen:</strong> Plot L-5, Street No. 1, Altaf Town, Korangi
                                        Creek, Karachi, Pakistan</span>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <span>info@mgfoodevent.com</span>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                    <span>+92 300 8849180</span>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                    <span>+92 021-35807088</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Footer Line -->
            <div
                style="background: #1a1a2e; padding: 15px 0; text-align: center; border-top: 1px solid rgba(255,255,255,0.1);">
                <div class="container">
                    <p style="color: #999; font-size: 13px; margin: 0;">
                        MG Food & Event Planner – Best Wedding & Event Management Company in Karachi, Pakistan
                    </p>
                </div>
            </div>

            <!-- Copyright Bar -->
            <div class="footer-copyright">
                <div class="container">
                    <p>© 2025 MG Food & Event Planner. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
        <script src="{{ asset('js/script.js') }}?v={{ time() }}"></script>

        <!-- Office Location Change Popup -->
        <div id="locationPopup" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(0,0,0,0.55); align-items:center; justify-content:center;">
            <div style="background:#fff; border:2px solid #D4A853; border-radius:16px; max-width:380px; width:92%; padding:24px; box-shadow:0 20px 50px rgba(212,168,83,0.2); animation:popupFadeIn 0.4s ease; position:relative;">

                <!-- Close -->
                <button onclick="closeLocationPopup()" style="position:absolute; top:12px; right:14px; background:#f5f5f5; border:1px solid #e0e0e0; color:#555; width:26px; height:26px; border-radius:50%; cursor:pointer; font-size:13px;">✕</button>

                <!-- Title -->
                <div style="text-align:center; margin-bottom:18px;">
                    <span style="font-size:26px;">📍</span>
                    <h3 style="color:#b38936; font-family:'Playfair Display',serif; font-size:18px; margin:6px 0 4px;">We've Moved!</h3>
                    <p style="color:#888; font-size:11px; margin:0;">Our office has a new address</p>
                </div>

                <!-- New Location (shown first) -->
                <div style="background:linear-gradient(135deg,#fffbf0,#fef3d0); border:1.5px solid #D4A853; border-radius:10px; padding:14px; margin-bottom:10px;">
                    <p style="color:#b38936; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin:0 0 5px;">✅ New Location</p>
                    <p style="color:#1a1a2e; font-size:13px; line-height:1.6; margin:0; font-weight:600;">Mezzanine Floor Plot No, 4-C 15th Commercial St, D.H.A Phase II Extension Phase 2, Karachi, 75500, Pakistan</p>
                </div>

                <!-- Old Location (fades in after 2s) -->
                <div id="oldLocBox" style="background:#fafafa; border:1.5px solid #e8e8e8; border-radius:10px; padding:14px; margin-bottom:18px; opacity:0; transition:opacity 0.6s ease;">
                    <p style="color:#e57373; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin:0 0 5px;">❌ Old Location</p>
                    <p style="color:#aaa; font-size:12px; line-height:1.6; margin:0; text-decoration:line-through;">Mezzanine Floor Building, 19-C South Park Avenue, D.H.A Phase II Extension Phase 2, Karachi</p>
                </div>

                <!-- Buttons -->
                <div style="display:flex; gap:10px;">
                    <a href="https://maps.google.com/?q=4-C+15th+Commercial+St+DHA+Phase+2+Extension+Karachi" target="_blank"
                       style="flex:1; background:linear-gradient(90deg,#D4A853,#b38936); color:#fff; text-align:center; padding:11px; border-radius:50px; text-decoration:none; font-weight:700; font-size:13px;">
                        📍 View on Map
                    </a>
                    <button onclick="closeLocationPopup()"
                            style="flex:1; background:#fff; color:#b38936; border:1.5px solid #D4A853; padding:11px; border-radius:50px; font-size:13px; font-weight:600; cursor:pointer;">
                        Got it!
                    </button>
                </div>
            </div>
        </div>

        <style>
            @keyframes popupFadeIn {
                from { opacity:0; transform:scale(0.9) translateY(10px); }
                to   { opacity:1; transform:scale(1) translateY(0); }
            }
        </style>

        <script>
            window.addEventListener('load', function() {
                if (!sessionStorage.getItem('locationPopupShown')) {
                    setTimeout(function() {
                        document.getElementById('locationPopup').style.display = 'flex';
                        setTimeout(function() {
                            document.getElementById('oldLocBox').style.opacity = '1';
                        }, 2000);
                        sessionStorage.setItem('locationPopupShown', 'true');
                    }, 5000);
                }
            });

            function closeLocationPopup() {
                document.getElementById('locationPopup').style.display = 'none';
            }

            document.getElementById('locationPopup').addEventListener('click', function(e) {
                if (e.target === this) closeLocationPopup();
            });
        </script>

</body>

</html>
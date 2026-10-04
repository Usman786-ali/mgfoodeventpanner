@extends('layouts.app')

@section('title', 'Ramadan Exclusive Offers - MG Food & Event Planners')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/ramadan-style.css') }}?v={{ time() }}">
    <style>
        .ramadan-hero {
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?w=1600&q=80') center/cover;
            padding: 180px 0 100px;
            color: white;
            text-align: left;
        }

        .details-section {
            padding: 100px 0;
            background: #fff;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .package-image-container {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .package-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .package-image-container:hover .package-image {
            transform: scale(1.05);
        }

        .package-content h3 {
            font-family: var(--font-display);
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .package-content .highlight-text {
            color: var(--primary);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            display: block;
        }

        .package-description {
            font-size: 18px;
            line-height: 1.8;
            color: #666;
            margin-bottom: 30px;
        }

        .menu-list {
            list-style: none;
            padding: 0;
            margin: 30px 0;
        }

        .menu-list li {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            color: var(--dark);
        }

        .menu-list li:last-child {
            border-bottom: none;
        }

        .menu-list li strong {
            background: rgba(212, 168, 83, 0.1);
            color: var(--primary);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .section-separator {
            height: 1px;
            background: linear-gradient(to right, transparent, #e0e0e0, transparent);
            margin: 0;
        }

        @media (max-width: 991px) {
            .details-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .package-image {
                height: 350px;
            }

            .ramadan-hero {
                text-align: center;
                padding-top: 150px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="ramadan-hero">
        <div class="container">
            <div data-aos="fade-up">
                <span class="ramadan-title-badge"
                    style="background: rgba(255,255,255,0.1); color: #fff; border-color: #fff;">Coming Soon</span>
                <h1 class="hero-title" style="margin-top: 20px;">Ramadan <span class="highlight">Exclusive Offers</span>
                </h1>
                <p class="hero-description" style="max-width: 600px; margin-top: 20px;">
                    Prepare for a blessed month with our premium food menus and spiritual decor themes.
                    Experience the essence of Ramadan with MG Food & Event Planners.
                </p>
            </div>
        </div>
    </section>

    <!-- Food Packages Section -->
    <section class="details-section">
        <div class="container">
            <div class="details-grid">
                <div class="package-content" data-aos="fade-right">
                    <span class="highlight-text">Delicious Moments</span>
                    <h3>Iftar & Suhoor Menus</h3>
                    <p class="package-description">
                        Experience the traditional taste of Ramadan with our hygienic and delicious food packages.
                        Whether it's a corporate Iftar gathering or a family Suhoor, we ensure premium quality and authentic
                        taste.
                    </p>

                    <ul class="menu-list">
                        <li><span>Chicken Biryani Deal</span> <strong>Coming Soon</strong></li>
                        <li><span>Premium Iftar Platter</span> <strong>Coming Soon</strong></li>
                        <li><span>Suhoor Special Box</span> <strong>Coming Soon</strong></li>
                        <li><span>Live Tandoor Station</span> <strong>Coming Soon</strong></li>
                    </ul>

                    <a href="{{ route('contact') }}" class="btn btn-primary">Pre-Book Now</a>
                </div>
                <div class="package-image-container" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1588613437254-4aa9dc41375d?w=800&q=80" alt="Iftar Food"
                        class="package-image">
                </div>
            </div>
        </div>
    </section>

    <div class="section-separator"></div>

    <!-- Decor Packages Section -->
    <section class="details-section" style="background: #fafafa;">
        <div class="container">
            <div class="details-grid">
                <div class="package-image-container" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&q=80" alt="Ramadan Decor"
                        class="package-image">
                </div>
                <div class="package-content" data-aos="fade-left">
                    <span class="highlight-text">Spiritual Ambience</span>
                    <h3>Ramadan Decor Themes</h3>
                    <p class="package-description">
                        Transform your venue with our spiritual and elegant Ramadan decoration themes.
                        From traditional lanterns to modern lighting setups, we create the perfect atmosphere for your
                        blessings.
                    </p>

                    <ul class="menu-list">
                        <li><span>Arabic Lantern Setup</span> <strong>Coming Soon</strong></li>
                        <li><span>Moon & Star Lighting</span> <strong>Coming Soon</strong></li>
                        <li><span>Traditional Majlis Seating</span> <strong>Coming Soon</strong></li>
                        <li><span>Corporate Iftar Setup</span> <strong>Coming Soon</strong></li>
                    </ul>

                    <a href="{{ route('contact') }}" class="btn btn-primary">Get Custom Quote</a>
                </div>
            </div>
        </div>
    </section>
@endsection
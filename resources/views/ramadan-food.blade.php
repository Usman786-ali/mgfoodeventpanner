@extends('layouts.app')

@section('title', 'Ramadan Food Packages - MG Food & Event Planners')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/ramadan-style.css') }}?v={{ time() }}">
    <style>
        .ramadan-hero {
            position: relative;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1542751110-97427bbecf20?w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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

        /* Menu Grid Styles */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .menu-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(212, 168, 83, 0.3);
        }

        .menu-image-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 140%;
            /* 1:1.4 aspect ratio for menu cards */
            overflow: hidden;
        }

        .menu-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .menu-card:hover .menu-image {
            transform: scale(1.1);
        }

        .menu-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(212, 168, 83, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-card:hover .menu-overlay {
            opacity: 1;
        }

        .menu-overlay i {
            font-size: 32px;
            color: white;
        }

        @media (max-width: 1200px) {
            .menu-grid {
                grid-template-columns: repeat(4, 1fr);
            }
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

            .menu-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
        }

        @media (max-width: 480px) {
            .menu-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="ramadan-hero"
        style="@if (\App\Models\SiteSetting::get('ramadan_food_hero_bg')) background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('storage/' . \App\Models\SiteSetting::get('ramadan_food_hero_bg')) }}'); @else background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1542751110-97427bbecf20?w=1600&q=80'); @endif">
        <div class="container">
            <div data-aos="fade-up">
                <span class="ramadan-title-badge"
                    style="background: rgba(255,255,255,0.1); color: #fff; border-color: #fff;">Coming Soon</span>
                <h1 class="hero-title" style="margin-top: 20px;">Ramadan <span class="highlight">Food Menu</span></h1>
                <p class="hero-description" style="max-width: 600px; margin-top: 20px;">
                    Experience the traditional taste of Ramadan with our hygienic and delicious food packages.
                    From corporate Iftars to family Suhoors, we serve perfection.
                </p>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="details-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="highlight-text">Ramadan Special</span>
                <h2
                    style="font-family: var(--font-display); font-size: 42px; font-weight: 700; color: var(--dark); margin-top: 10px;">
                    Our <span style="color: var(--primary);">Menu</span>
                </h2>
                <p style="max-width: 700px; margin: 20px auto; font-size: 18px; color: #666;">
                    Explore our delicious Ramadan menu offerings. Perfect for your special occasions.
                </p>
            </div>

            @php
                // Get all menu images (up to 30)
                $menuImages = [];
                for ($i = 1; $i <= 30; $i++) {
                    $menuImg = \App\Models\SiteSetting::get('ramadan_food_menu_' . $i);
                    if ($menuImg) {
                        $menuImages[] = $menuImg;
                    }
                }
            @endphp

            @if(count($menuImages) > 0)
                <div class="menu-grid" data-aos="fade-up">
                    @foreach($menuImages as $index => $menuImage)
                        <div class="menu-card" data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}">
                            <div class="menu-image-wrapper">
                                <img src="{{ asset('storage/' . $menuImage) }}" alt="Menu {{ $index + 1 }}" class="menu-image">
                                <div class="menu-overlay">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                            @php
                                $menuPrice = \App\Models\SiteSetting::get('ramadan_food_price_' . ($index + 1));
                            @endphp
                            @if($menuPrice)
                                <div style="padding: 15px; text-align: center; background: #fff; border-top: 1px solid #f0f0f0;">
                                    <span
                                        style="display: block; color: var(--primary); font-family: var(--font-display); font-size: 22px; font-weight: 700;">
                                        Rs. {{ $menuPrice }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center" data-aos="fade-up">
                    <div style="background: #f9f9f9; padding: 60px 20px; border-radius: 20px; border: 2px dashed #ddd;">
                        <i class="fas fa-utensils" style="font-size: 48px; color: var(--primary); margin-bottom: 20px;"></i>
                        <h4 style="color: #666; margin-bottom: 10px;">Menu Coming Soon</h4>
                        <p style="color: #999;">Our special Ramadan menu will be uploaded shortly.</p>
                    </div>
                </div>
            @endif

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('contact') }}" class="btn btn-primary" style="padding: 15px 40px; font-size: 16px;">
                    <i class="fas fa-phone-alt me-2"></i> Book Now
                </a>
            </div>
        </div>
    </section>
@endsection
@extends('layouts.app')

@section('title', 'Ramadan Decor Packages - MG Food & Event Planners')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/ramadan-style.css') }}?v={{ time() }}">
    <style>
        .ramadan-hero {
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1519817650390-64a93db51149?w=1600&q=80') center/cover no-repeat;
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
    <section class="ramadan-hero"
        style="@if (\App\Models\SiteSetting::get('ramadan_decor_hero_bg')) background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('storage/' . \App\Models\SiteSetting::get('ramadan_decor_hero_bg')) }}'); @endif">
        <div class="container">
            <div data-aos="fade-up">
                <span class="ramadan-title-badge"
                    style="background: rgba(255,255,255,0.1); color: #fff; border-color: #fff;">Coming Soon</span>
                <h1 class="hero-title" style="margin-top: 20px;">Ramadan <span class="highlight">Decor Packages</span></h1>
                <p class="hero-description" style="max-width: 600px; margin-top: 20px;">
                    Transform your venue with our spiritual and elegant Ramadan decoration themes.
                    Create the perfect atmosphere for your blessings with our premium setups.
                </p>
            </div>
        </div>
    </section>

    <!-- Decor Packages Section -->
    <section class="details-section">
        <div class="container">
            <div class="details-grid">
                <div class="package-image-container" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1543329240-621815b39414?w=800&q=80" alt="Ramadan Lanterns"
                        class="package-image">
                </div>
                <div class="package-content" data-aos="fade-left">
                    <span class="highlight-text">Spiritual Ambience</span>
                    <h3>Ramadan Decor Themes</h3>
                    <p class="package-description">
                        We offer a wide range of decoration themes suitable for mosques, homes, corporate offices, and
                        malls.
                        Our designs blend traditional Islamic art with contemporary aesthetics.
                    </p>

                    <ul class="menu-list">
                        @php
                            $decorMenu = \App\Models\SiteSetting::get('ramadan_decor_menu', "Arabic Lantern Setup || Coming Soon\nMoon & Star Lighting || Coming Soon\nTraditional Majlis Seating || Coming Soon\nCorporate Iftar Setup || Coming Soon\nMall Decoration || Coming Soon");
                            $decorItems = explode("\n", $decorMenu);
                        @endphp
                        @foreach ($decorItems as $item)
                            @php $parts = explode('||', $item); @endphp
                            <li>
                                <span>{{ trim($parts[0]) }}</span>
                                @if (isset($parts[1]))
                                    <strong>{{ trim($parts[1]) }}</strong>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('contact') }}" class="btn btn-primary">Get Custom Quote</a>
                </div>
            </div>
        </div>
    </section>
@endsection
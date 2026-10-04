@extends('layouts.app')

@section('title', 'Gallery & Case Studies - MG Food & Event Planners')

@section('content')
    <!-- Hero Section -->
    <section class="hero"
        style="min-height: 60vh; padding-top: 160px; background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/Blog-Background.jpeg') }}') center/cover;">
        <div class="hero-overlay"></div>
        <div class="container hero-container">
            <div class="hero-content">
                <span class="hero-badge" data-aos="fade-up">Success Stories</span>
                <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">
                    A Glimpse Into <span class="highlight">Perfection</span>
                </h1>
                <p class="hero-description" data-aos="fade-up" data-aos-delay="200">
                    Browse through our curated collection of real events. Every photo tells a story of planning, passion,
                    and execution.
                </p>
            </div>
        </div>
    </section>

    <!-- Category Tabs (Visual only for now) -->
    <section style="padding: 60px 0 20px;">
        <div class="container">
            <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;" data-aos="fade-up">
                <button class="btn btn-secondary active" style="border-radius: 30px; padding: 10px 25px;">All Work</button>
                <button class="btn btn-secondary"
                    style="border-radius: 30px; padding: 10px 25px; background: transparent; color: var(--dark);">Weddings</button>
                <button class="btn btn-secondary"
                    style="border-radius: 30px; padding: 10px 25px; background: transparent; color: var(--dark);">Corporate</button>
                <button class="btn btn-secondary"
                    style="border-radius: 30px; padding: 10px 25px; background: transparent; color: var(--dark);">Catering</button>
            </div>
        </div>
    </section>

    <!-- Main Portfolio Grid -->
    <section class="portfolio" style="padding-top: 40px;">
        <div class="container">
            <div class="portfolio-grid">
                @forelse($portfolioItems as $index => $item)
                    <div class="portfolio-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="portfolio-image">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                            <div class="portfolio-overlay">
                                <span
                                    style="font-size: 12px; text-transform: uppercase; color: var(--primary);">{{ $item->category }}</span>
                                <h3>{{ $item->title }}</h3>
                                <div style="font-size: 14px; line-height: 1.6;">{!! $item->description !!}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center" style="padding: 60px 20px;">
                        <h3 style="color: #666;">No Portfolio Items Yet</h3>
                        <p style="color: #999;">Add portfolio items from the admin panel to display here.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
@extends('layouts.app')

@section('title', $blog->title . ' - MG Events Blog')
@section('meta_description', $blog->excerpt)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/blog-styles.css') }}?v={{ time() }}">
@endsection

@section('content')
    <!-- Blog Detail Hero -->
    <section class="blog-hero" style="
            min-height: 50vh; 
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('{{ $blog->image ? asset('storage/' . $blog->image) : asset('images/Blog-Background.jpeg') }}') center/cover;
            display: flex;
            align-items: center;
            padding-top: 100px;">
        <div class="container">
            <div class="blog-hero-content" data-aos="fade-up" style="padding-top: 60px;">
                <span class="section-badge"
                    style="background: rgba(212, 168, 83, 0.2); color: #D4A853;">{{ $blog->client_name }}</span>
                <h1 style="font-size: 48px; color: white; margin: 20px 0;">{{ $blog->title }}</h1>
                <div style="display: flex; gap: 30px; color: #ccc; font-size: 14px; margin-top: 20px;">
                    <span>📅 {{ $blog->created_at->format('F d, Y') }}</span>
                    @if($blog->event_date)
                        <span>📍 Event: {{ $blog->event_date->format('M d, Y') }}</span>
                    @endif
                    @if($blog->venue)
                        <span>🏛️ {{ $blog->venue }}</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div style="max-width: 900px; margin: 0 auto;">
                <!-- Featured Image -->
                @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                        style="width: 100%; height: 500px; object-fit: cover; border-radius: 15px; margin-bottom: 40px;">
                @endif

                <!-- Event Services Badges -->
                @if($blog->has_food || $blog->has_decor)
                    <div style="display: flex; gap: 15px; margin-bottom: 30px;">
                        @if($blog->has_food)
                            <span
                                style="background: #D4A853; color: white; padding: 8px 20px; border-radius: 20px; font-size: 14px;">
                                🍽️ Food Services
                            </span>
                        @endif
                        @if($blog->has_decor)
                            <span
                                style="background: #D4A853; color: white; padding: 8px 20px; border-radius: 20px; font-size: 14px;">
                                🎨 Decor Services
                            </span>
                        @endif
                    </div>
                @endif

                <!-- Content -->
                <div style="font-size: 18px; line-height: 1.8; color: #333;">
                    {!! $blog->content !!}
                </div>

                <!-- Gallery Images -->
                @if($blog->gallery_images && count($blog->gallery_images) > 0)
                    <div style="margin-top: 60px;">
                        <h3 style="margin-bottom: 30px; color: #1a1a2e;">Event Gallery</h3>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                            @foreach($blog->gallery_images as $galleryImage)
                                <img src="{{ asset('storage/' . $galleryImage) }}" alt="Gallery Image"
                                    style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px; cursor: pointer;"
                                    onclick="window.open(this.src, '_blank')">
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Back Button -->
                <div style="margin-top: 60px; text-align: center;">
                    <a href="{{ route('blog') }}" class="btn btn-primary">← Back to Blog</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts (Optional - can add later) -->
    <section style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 40px;">Continue Reading</h2>
            <div style="text-align: center;">
                <a href="{{ route('blog') }}" class="btn btn-secondary">View All Blog Posts</a>
            </div>
        </div>
    </section>
@endsection
@extends('layouts.app')

@section('title', 'Blog - MG Events | Event Planning Tips & Insights')
@section('meta_description', 'Read the latest event planning tips, wedding trends, and industry insights from MG Events - Pakistan\'s leading event planners.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/blog-styles.css') }}?v={{ time() }}">
@endsection

@section('content')
    <!-- Blog Hero Section -->
    <section class="blog-hero" style="
                            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                                        url('{{ asset('images/Blog-Background.jpeg') }}') center/cover;
                            min-height: 60vh;
                            display: flex;
                            align-items: center;
                            padding-top: 100px;">
        <div class="container">
            <div class="blog-hero-content" data-aos="fade-up">
                <span class="section-badge">Our Blog</span>
                <h1>Event Planning Insights & Tips</h1>
                <p>Discover the latest trends, expert advice, and behind-the-scenes stories from Pakistan's premier event
                    planners.</p>
            </div>
        </div>
    </section>

    <!-- Featured Post -->
    <section class="featured-post-section">
        <div class="container">
            @if($featuredBlog)
                <div class="featured-post" data-aos="fade-up">
                    <div class="featured-post-image">
                        <span class="featured-badge">Featured</span>
                        <img src="{{ asset('storage/' . $featuredBlog->image) }}" alt="{{ $featuredBlog->title }}">
                    </div>
                    <div class="featured-post-content">
                        <div class="post-meta">
                            <span class="post-category">{{ $featuredBlog->category }}</span>
                            <span class="post-date">{{ $featuredBlog->created_at->format('F d, Y') }}</span>
                        </div>
                        <h2>{{ $featuredBlog->title }}</h2>
                        <p>{{ $featuredBlog->excerpt }}</p>
                        <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="btn-read-more">Read Full Article →</a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="blog-grid-section">
        <div class="container">
            <div class="blog-grid">
                @forelse($blogs as $index => $blog)
                    <article class="blog-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="blog-card-image">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                            <span class="blog-category">{{ $blog->category }}</span>
                        </div>
                        <div class="blog-card-content">
                            <div class="blog-meta">
                                <span class="blog-date">{{ $blog->created_at->format('F d, Y') }}</span>
                                <span class="blog-read-time">5 min read</span>
                            </div>
                            <h3>{{ $blog->title }}</h3>
                            <p>{{ $blog->excerpt }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-link">Read More →</a>
                        </div>
                    </article>
                @empty
                    <div class="col-12 text-center" style="padding: 60px 20px;">
                        <h3 style="color: #666;">No Blog Posts Yet</h3>
                        <p style="color: #999;">Add blog posts from the admin panel to display here.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($blogs->hasPages())
                <div class="blog-pagination" data-aos="fade-up">
                    @if ($blogs->onFirstPage())
                        <span class="pagination-btn disabled">← Previous</span>
                    @else
                        <a href="{{ $blogs->previousPageUrl() }}" class="pagination-btn">← Previous</a>
                    @endif

                    <div class="pagination-numbers">
                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                            <a href="{{ $url }}"
                                class="pagination-number {{ $page == $blogs->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                        @endforeach
                    </div>

                    @if ($blogs->hasMorePages())
                        <a href="{{ $blogs->nextPageUrl() }}" class="pagination-btn">Next →</a>
                    @else
                        <span class="pagination-btn disabled">Next →</span>
                    @endif
                </div>
            @endif
        </div>
    </section>

@endsection
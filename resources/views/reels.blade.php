<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reels & Videos - MG Food & Event Planners</title>
    <meta name="description"
        content="Watch our event highlights, wedding reels, and corporate event videos. MG Food & Event Planners - Best Event Planner in Karachi.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-responsive.css') }}?v={{ time() }}">

    @php $googleVerify = \App\Models\SiteSetting::get('google_verification'); @endphp
    @if($googleVerify) {!! $googleVerify !!} @endif
    @php $googleAnalytics = \App\Models\SiteSetting::get('google_analytics'); @endphp
    @if($googleAnalytics) {!! $googleAnalytics !!} @endif

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background: #fff;
        }

        /* ===== HERO ===== */
        .reels-hero {
            background: linear-gradient(135deg, #0a0e1a 0%, #1a1a2e 50%, #0d1b3e 100%);
            padding: 120px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .reels-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 60%, rgba(212, 168, 83, 0.12) 0%, transparent 65%);
            pointer-events: none;
        }

        .reels-hero-badge {
            display: inline-block;
            background: rgba(212, 168, 83, 0.15);
            border: 1px solid rgba(212, 168, 83, 0.4);
            color: #D4A853;
            padding: 8px 22px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .reels-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 5vw, 64px);
            font-weight: 800;
            color: #fff;
            margin: 0 0 16px;
            line-height: 1.15;
        }

        .reels-hero h1 span {
            color: #D4A853;
        }

        .reels-hero p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.6);
            margin: 0 auto;
            max-width: 500px;
        }

        .reels-hero-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 40px;
        }

        .reels-hero-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(212, 168, 83, 0.4);
        }

        .reels-hero-dots span:nth-child(2) {
            background: #D4A853;
            width: 24px;
            border-radius: 4px;
        }

        /* ===== SCROLL TRACK (like clients logos) ===== */
        .reels-scroll-section {
            padding: 70px 0;
            background: #fff;
            overflow: hidden;
        }

        .reels-section-header {
            text-align: center;
            margin-bottom: 50px;
            padding: 0 20px;
        }

        .reels-section-header .badge {
            display: inline-block;
            background: #D4A853;
            color: #000;
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .reels-section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 4vw, 46px);
            font-weight: 800;
            color: #1a1a2e;
            margin: 0;
        }

        .reels-section-header h2 span {
            color: #D4A853;
        }

        /* ===== SCROLL WRAPPER ===== */
        .reels-slider-wrapper {
            position: relative;
            overflow: hidden;
            mask-image: linear-gradient(to right, transparent 0%, black 6%, black 94%, transparent 100%);
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 6%, black 94%, transparent 100%);
        }

        .reels-track {
            display: flex;
            gap: 24px;
            width: max-content;
            padding: 20px 0;
            animation: reelsScroll 35s linear infinite;
        }

        .reels-track:hover {
            animation-play-state: paused;
        }

        @keyframes reelsScroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* ===== REEL CARD ===== */
        .reel-card {
            width: 220px;
            flex-shrink: 0;
            background: #1a1a2e;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            position: relative;
        }

        .reel-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.25);
        }

        .reel-iframe-wrap {
            position: relative;
            padding-bottom: 177.77%;
            /* 9:16 vertical */
            height: 0;
            overflow: hidden;
            background: #000;
        }

        .reel-iframe-wrap iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            pointer-events: none;
            /* so card hover works — click opens modal */
        }

        .reel-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 50%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 16px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .reel-card:hover .reel-card-overlay {
            opacity: 1;
        }

        .reel-play-btn {
            width: 44px;
            height: 44px;
            background: #D4A853;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(212, 168, 83, 0.5);
        }

        .reel-card-title {
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
        }

        /* ===== MODAL ===== */
        .reel-modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(0, 0, 0, 0.92);
            align-items: center;
            justify-content: center;
        }

        .reel-modal-backdrop.open {
            display: flex;
        }

        .reel-modal {
            position: relative;
            width: min(380px, 90vw);
            background: #000;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
        }

        .reel-modal iframe {
            width: 100%;
            aspect-ratio: 9/16;
            border: none;
            display: block;
        }

        .reel-modal-close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            transition: background 0.2s;
            z-index: 10;
        }

        .reel-modal-close:hover {
            background: rgba(212, 168, 83, 0.6);
        }

        /* ===== EMPTY STATE ===== */
        .reels-empty {
            text-align: center;
            padding: 100px 20px;
        }

        .reels-empty .icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .reels-empty h3 {
            color: #1a1a2e;
            font-size: 28px;
            margin-bottom: 12px;
        }

        .reels-empty p {
            color: #888;
            font-size: 16px;
        }

        /* ===== CTA ===== */
        .reels-cta {
            background: linear-gradient(135deg, #1a1a2e, #0d5016);
            padding: 80px 20px;
            text-align: center;
        }

        .reels-cta h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(26px, 4vw, 42px);
            color: #fff;
            margin-bottom: 14px;
        }

        .reels-cta p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 17px;
            margin-bottom: 30px;
        }

        .reels-cta a {
            display: inline-block;
            background: #D4A853;
            color: #000;
            padding: 14px 36px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .reels-cta a:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 168, 83, 0.4);
        }
    </style>
</head>

<body>
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
                    <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li><a href="{{ route('portfolio') }}" class="nav-link">Portfolio</a></li>
                    <li><a href="{{ route('about') }}" class="nav-link">About</a></li>
                    <li><a href="{{ route('blog') }}" class="nav-link">Blog</a></li>
                    <li><a href="{{ route('services') }}" class="nav-link">Venues</a></li>
                    <li><a href="{{ route('reels') }}" class="nav-link active">Reels</a></li>
                    <li><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary">Get Quote</a>
                    <button class="mobile-toggle" id="mobileToggle">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="reels-hero">
        <div class="container">
            <div class="reels-hero-badge">🎬 Watch Our Work</div>
            <h1>Our <span>Event</span> Reels</h1>
            <p>Watch our stunning event highlights, wedding moments & corporate event videos</p>
            <div class="reels-hero-dots">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
    </section>

    @if($reels->count() > 0)
        <!-- Scrolling Reels Section -->
        <section class="reels-scroll-section">
            <div class="reels-section-header">
                <div class="badge">🎥 OUR VIDEOS</div>
                <h2>Scroll Through Our <span>Best Moments</span></h2>
            </div>

            <div class="reels-slider-wrapper">
                <div class="reels-track" id="reelsTrack">
                    @foreach($reels as $reel)
                        @php
                            $videoUrl = ($reel->type === 'file') ? asset('storage/' . $reel->video_path) : $reel->embed_url;
                        @endphp
                        <div class="reel-card"
                            onmouseenter="const v=this.querySelector('video'); if(v) v.play()"
                            onmouseleave="const v=this.querySelector('video'); if(v) { v.pause(); v.currentTime = 0.1; }"
                            onclick="openReelModal('{{ $videoUrl }}', '{{ addslashes($reel->title) }}', '{{ $reel->type }}')">
                            <div class="reel-iframe-wrap">
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
                            <div class="reel-card-overlay">
                                <div class="reel-play-btn">▶</div>
                                <div class="reel-card-title">{{ $reel->title }}</div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Duplicate for seamless loop --}}
                    @foreach($reels as $reel)
                        @php
                            $videoUrl = ($reel->type === 'file') ? asset('storage/' . $reel->video_path) : $reel->embed_url;
                        @endphp
                        <div class="reel-card"
                            onmouseenter="const v=this.querySelector('video'); if(v) v.play()"
                            onmouseleave="const v=this.querySelector('video'); if(v) { v.pause(); v.currentTime = 0.1; }"
                            onclick="openReelModal('{{ $videoUrl }}', '{{ addslashes($reel->title) }}', '{{ $reel->type }}')">
                            <div class="reel-iframe-wrap">
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
                            <div class="reel-card-overlay">
                                <div class="reel-play-btn">▶</div>
                                <div class="reel-card-title">{{ $reel->title }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="reels-scroll-section">
            <div class="reels-empty">
                <div class="icon">🎬</div>
                <h3>Reels Coming Soon!</h3>
                <p>We are uploading our best event videos. Check back soon!</p>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="reels-cta">
        <h2>Ready to Create Your <span style="color:#D4A853;">Dream Event?</span></h2>
        <p>Let us plan your perfect wedding, corporate event or special occasion.</p>
        <a href="{{ route('contact') }}">📞 Book a Consultation</a>
    </section>

    <!-- Modal -->
    <div class="reel-modal-backdrop" id="reelModalBackdrop" onclick="closeReelModal(event)">
        <div class="reel-modal">
            <button class="reel-modal-close" onclick="closeReelModal()">✕</button>
            <!-- Player for Links -->
            <iframe id="reelModalIframe" src=""
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen style="display:none; width:100%; aspect-ratio:9/16; border:none;"></iframe>
            <!-- Player for Files -->
            <video id="reelModalVideo" controls autoplay playsinline
                style="width:100%; aspect-ratio:9/16; display:none; background:#000;"></video>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}?v={{ time() }}"></script>
    <script>
        function openReelModal(url, title, type) {
            const modal = document.getElementById('reelModalBackdrop');
            const iframe = document.getElementById('reelModalIframe');
            const video = document.getElementById('reelModalVideo');

            if (type === 'file') {
                iframe.style.display = 'none';
                iframe.src = '';
                video.style.display = 'block';
                video.src = url;
                video.play();
            } else {
                let src = url;
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

        function closeReelModal(e) {
            if (e && e.target !== document.getElementById('reelModalBackdrop') && !e.target.classList.contains('reel-modal-close')) return;

            const iframe = document.getElementById('reelModalIframe');
            const video = document.getElementById('reelModalVideo');

            iframe.src = '';
            video.src = '';
            video.pause();

            document.getElementById('reelModalBackdrop').classList.remove('open');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeReelModal({ target: document.getElementById('reelModalBackdrop') });
        });

        // Adjust animation speed based on reel count
        const count = {{ $reels->count() }};
        const speed = Math.max(20, count * 8);
        document.getElementById('reelsTrack').style.animationDuration = speed + 's';
    </script>
</body>

</html>
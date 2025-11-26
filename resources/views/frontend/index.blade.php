@extends('layouts.frontend')
@section('title', 'Halaman Utama')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --dark-overlay: rgba(0, 0, 0, 0.5);
    }

    /* === HERO SECTION === */
    .hero-section {
        background-image: url('https://salsawisata.com/wp-content/uploads/2022/09/Syarat-masuk-Mall-SKA-Pekanbaru.jpg');
        padding: 140px 0 120px;
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 100px;
        background: white;
        clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
    }

    .hero-text h1 {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        color: white;
        margin-bottom: 1.5rem;
        text-shadow: 2px 4px 12px rgba(0,0,0,0.2);
        animation: fadeInUp 0.8s ease-out;
    }

    .hero-text p {
        color: rgba(255, 255, 255, 0.95);
        font-size: clamp(1rem, 2vw, 1.3rem);
        margin-bottom: 2rem;
        animation: fadeInUp 0.8s ease-out 0.2s backwards;
    }

    .social-badges {
        animation: fadeInUp 0.8s ease-out 0.4s backwards;
    }

    .app-badge {
        width: 50px;
        height: 50px;
        line-height: 50px;
        border-radius: 50%;
        text-align: center;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 8px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        font-size: 1.5rem;
    }

    .app-badge:hover {
        transform: translateY(-5px) scale(1.1);
        background: rgba(255, 255, 255, 0.3);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .phone-mockup {
        position: relative;
        z-index: 1;
        animation: float 6s ease-in-out infinite;
        max-width: 100%;
        height: auto;
        filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* === ABOUT SECTION === */
    .about-us {
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        padding: 80px 0;
    }

    .about-us h2 {
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1.5rem;
    }

    .about-us p {
        font-size: clamp(1rem, 2vw, 1.1rem);
        line-height: 1.8;
        color: #4a5568;
    }

    .about-us img {
        transition: transform 0.4s ease;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    }

    .about-us img:hover {
        transform: scale(1.03) rotate(1deg);
    }

    /* === STATS CARDS === */
    .stats-card {
        background: white;
        padding: 30px 20px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        text-align: center;
    }

    .stats-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    .stats-card i {
        font-size: 3rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
    }

    .stats-card h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #2d3748;
        margin: 10px 0;
    }

    .stats-card p {
        color: #718096;
        font-weight: 500;
        margin: 0;
    }

    /* === SECTION HEADERS === */
    .section-header {
        text-align: center;
        margin-bottom: 50px;
        padding: 60px 0 20px;
    }

    .section-header h2 {
        font-size: clamp(2rem, 4vw, 2.8rem);
        font-weight: 800;
        color: #2d3748;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    /* === TENANT SECTION === */
    #tenants {
        background: #f8f9fa;
        padding: 60px 0;
    }

    .tenant-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .tenant-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    }

    .tenant-card img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 5px solid #f0f0f0;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .tenant-card h5 {
        color: #2d3748;
        font-weight: 700;
        margin-top: 20px;
    }

    .tenant-badge {
        display: inline-block;
        padding: 5px 15px;
        background: var(--primary-gradient);
        color: white;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 10px;
    }


    .btn-primary {
        background: var(--primary-gradient);
        border: none;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.5);
    }

    /* === PROMO SECTION === */
    #promos {
        padding: 60px 0;
        background: white;
    }

    .promo-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .promo-card img {
        border-radius: 15px;
    }

    .countdown-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 15px;
        font-size: 1rem;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        display: inline-block;
    }

    .countdown-box span {
        margin-right: 8px;
        font-weight: 600;
    }

    .countdown-box .text-warning,
    .countdown-box .text-success,
    .countdown-box .text-danger {
        color: white !important;
    }

    /* === EVENT SECTION === */
    #events {
        padding: 60px 0;
        background: #f8f9fa;
    }

    .event-card {
        background: white;
        border-left: 6px solid;
        border-image: var(--primary-gradient) 1;
        border-radius: 15px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .event-card:hover {
        transform: translateX(10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    .event-card img {
        border-radius: 10px;
    }

    .event-card h5 {
        color: #2d3748;
        font-weight: 700;
    }

    /* === FACILITIES SECTION === */
    #facilities {
        padding: 60px 0;
        background: white;
    }

    .facility-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 70vh;
        max-height: 600px;
        overflow: hidden;
        width: 100%;
        gap: 10px;
        padding: 0 20px;
    }
    
    .panel {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100%;
        border-radius: 30px;
        color: #fff;
        cursor: pointer;
        flex: 0.5;
        position: relative;
        transition: flex 0.7s ease-in-out;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        overflow: hidden;
    }

    .panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
        transition: opacity 0.3s ease;
    }

    .panel:hover::before {
        opacity: 0.9;
    }

    .panel h3 {
        font-size: clamp(1.2rem, 2vw, 1.8rem);
        position: absolute;
        bottom: 30px;
        left: 30px;
        right: 30px;
        margin: 0;
        opacity: 0;
        z-index: 2;
        font-weight: 700;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    }

    .panel.active {
        flex: 5;
    }

    .panel.active h3 {
        opacity: 1;
        transition: opacity 0.3s ease-in 0.4s;
    }

    /* === CAROUSEL CONTROLS === */
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary-gradient) !important;
        opacity: 0.9;
        transition: all 0.3s ease;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    /* === RESPONSIVE === */
    @media (max-width: 992px) {
        .hero-section {
            padding: 100px 0 80px;
            min-height: auto;
        }

        .hero-text {
            text-align: center;
            margin-bottom: 30px;
        }

        .phone-mockup {
            max-width: 80%;
        }

        .social-badges {
            justify-content: center;
        }

        .about-us img {
            margin-top: 30px;
        }

        .stats-card {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 768px) {
        .facility-container {
            height: 50vh;
            flex-wrap: nowrap;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x mandatory;
        }

        .panel {
            min-width: 200px;
            scroll-snap-align: center;
        }

        .panel:nth-of-type(n+4) {
            display: flex;
        }

        .event-card {
            margin-bottom: 20px;
        }

        .event-card img {
            margin-bottom: 20px;
        }

        .countdown-box {
            font-size: 0.85rem;
            padding: 10px 15px;
        }

        .countdown-box span {
            display: inline-block;
            margin-right: 5px;
        }
    }

    @media (max-width: 576px) {
        .hero-section {
            padding: 80px 0 60px;
        }

        .app-badge {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        .stats-card {
            padding: 20px 15px;
        }

        .stats-card h2 {
            font-size: 2rem;
        }

        .section-header {
            padding: 40px 0 15px;
        }

        .tenant-card img {
            width: 100px;
            height: 100px;
        }

        .facility-container {
            height: 40vh;
        }

        .panel h3 {
            font-size: 1rem;
            bottom: 20px;
            left: 20px;
        }
    }

    /* === SMOOTH SCROLLING === */
    html {
        scroll-behavior: smooth;
    }

    /* === LOADING ANIMATION === */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .loading {
        animation: pulse 1.5s ease-in-out infinite;
    }

    /* Carousel Event */
     #events {
        padding: 60px 0;
        background: #f8f9fa;
        overflow: hidden;
    }

    .event-carousel-wrapper {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .event-carousel-container {
        position: relative;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        perspective: 1000px;
    }

    .event-slide {
        position: absolute;
        width: 700px;
        max-width: 90%;
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        opacity: 0;
        transform: translateX(0) scale(0.8) rotateY(20deg);
        pointer-events: none;
    }

    .event-slide.active {
        opacity: 1;
        transform: translateX(0) scale(1) rotateY(0deg);
        z-index: 10;
        pointer-events: auto;
    }

    .event-slide.prev {
        opacity: 0.6;
        transform: translateX(-60%) scale(0.85) rotateY(15deg);
        z-index: 5;
        filter: brightness(0.7);
    }

    .event-slide.next {
        opacity: 0.6;
        transform: translateX(60%) scale(0.85) rotateY(-15deg);
        z-index: 5;
        filter: brightness(0.7);
    }

    .event-card-3d {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .event-card-3d:hover {
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
    }

    .event-image-wrapper {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
    }

    .event-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .event-card-3d:hover .event-image-wrapper img {
        transform: scale(1.1);
    }

    .event-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--primary-gradient);
        color: white;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
    }

    .event-card-content {
        padding: 30px;
    }

    .event-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .event-description {
        color: #718096;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .event-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .event-info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        background: #f7fafc;
        border-radius: 12px;
    }

    .event-info-item i {
        color: #667eea;
        font-size: 1.3rem;
    }

    .event-info-item .info-text {
        font-size: 0.85rem;
        color: #4a5568;
        line-height: 1.4;
    }

    .event-countdown-3d {
        background: var(--primary-gradient);
        color: white;
        padding: 15px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }

    .event-countdown-3d span {
        margin: 0 5px;
        font-weight: 700;
        font-size: 0.95rem;
    }

    /* === CUSTOM NAVIGATION === */
    .event-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: white;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #667eea;
    }

    .event-nav-btn:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .event-nav-btn.prev-btn {
        left: 20px;
    }

    .event-nav-btn.next-btn {
        right: 20px;
    }

    /* === INDICATORS === */
    .event-indicators {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 30px;
    }

    .event-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #cbd5e0;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .event-indicator.active {
        background: var(--primary-gradient);
        width: 30px;
        border-radius: 6px;
    }

    /* === VIEW ALL BUTTON === */
    .view-all-events-btn {
        text-align: center;
        margin-top: 40px;
    }

    .view-all-events-btn .btn {
        padding: 15px 40px;
        font-size: 1.1rem;
    }

    /* === EMPTY STATE === */
    .event-empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .event-empty-state i {
        font-size: 5rem;
        color: #cbd5e0;
        margin-bottom: 20px;
    }

    .event-empty-state h4 {
        color: #2d3748;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .event-empty-state p {
        color: #718096;
    }

    /* === RESPONSIVE === */
    @media (max-width: 992px) {
        .event-carousel-container {
            height: 600px;
        }

        .event-slide {
            width: 90%;
        }

        .event-slide.prev,
        .event-slide.next {
            opacity: 0;
            transform: scale(0);
        }
    }

    @media (max-width: 768px) {
        .event-carousel-container {
            height: auto;
            min-height: 550px;
        }

        .event-image-wrapper {
            height: 220px;
        }

        .event-card-content {
            padding: 20px;
        }

        .event-title {
            font-size: 1.3rem;
        }

        .event-info-grid {
            grid-template-columns: 1fr;
        }

        .event-nav-btn {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }

        .event-nav-btn.prev-btn {
            left: 10px;
        }

        .event-nav-btn.next-btn {
            right: 10px;
        }
    }

    @media (max-width: 576px) {
        .event-image-wrapper {
            height: 180px;
        }

        .event-card-content {
            padding: 15px;
        }

        .event-countdown-3d {
            font-size: 0.85rem;
            padding: 12px;
        }

        .event-countdown-3d span {
            font-size: 0.8rem;
            margin: 0 3px;
        }
    }

    .event-img {
        width: 100%;
        height: 350px;
        object-fit: contain;
        border-radius: 15px;
    }
</style>

{{-- HERO --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-text">
                <h1>Wonderful Mall SKA</h1>
                <p>Experience unforgettable moments with your family in our wonderful mall</p>
                <div class="d-flex flex-wrap social-badges">
                    <a href="#" class="app-badge">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="app-badge">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="app-badge">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center pt-4">
                @foreach ($profiles as $p)
                    @if ($p->gambar)
                        <img src="{{ asset('storage/'.$p->gambar) }}" alt="hero mall" class="phone-mockup img-fluid">
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ABOUT SECTION --}}
<section id="about" class="about-us">
    @foreach ($profiles as $p)
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h2>Tentang {{ $p->nama_mall }}</h2>
                <p>{{ $p->deskripsi }}</p>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                @if ($p->gambar)
                <img src="{{ asset('storage/'.$p->gambar) }}" 
                     alt="gambar mall" 
                     class="img-fluid">
                @endif
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <i class="bi bi-shop"></i>
                    <h2>{{ \App\Models\Tenant::count() }}</h2>
                    <p>Tenants</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card">
                    <i class="bi bi-calendar-event-fill"></i>
                    <h2>{{ \App\Models\Event::count() }}</h2>
                    <p>Events</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card">
                    <i class="bi bi-tags-fill"></i>
                    <h2>{{ \App\Models\Promo::count() }}</h2>
                    <p>Promos</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="stats-card">
                    <i class="bi bi-ladder"></i>
                    <h2>{{ \App\Models\Facility::count() }}</h2>
                    <p>Facilities</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>

{{-- TENANTS --}}
<section id="tenants">
    <div class="section-header">
        <h2>Our Tenants</h2>
    </div>

    <div class="container">
        <div class="col-md-8 mx-auto">
            <div id="tenantCarousel" class="carousel slide" data-bs-ride="carousel">
                
                <div class="carousel-inner">
                    @foreach($tenants as $index => $t)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="tenant-card text-center">
                            @if ($t->gambar)
                                <img src="{{ asset('storage/'.$t->gambar) }}"
                                     alt="Tenant Image"
                                     class="rounded-circle mx-auto d-block">
                            @endif
                            <div>
                                <h5 class="mt-3">{{ $t->nama_tenant }}</h5>
                                <p class="text-muted mb-1">
                                    <strong class="tenant-badge">{{ $t->category->nama_category ?? '-' }}</strong>
                                </p>
                                <p class="text-muted mb-2">
                                    <i class="bi bi-geo-fill"></i> 
                                    <strong>Lantai {{ $t->floor->lantai ?? '-' }}</strong>
                                </p>
                                <p class="text-muted">{{ Str::limit($t->deskripsi, 100) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#tenantCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#tenantCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>
            <div class="text-center mt-4">
                <a href="{{ route('tenant.list') }}" class="btn btn-primary">
                    <i class="bi bi-shop"></i> Lihat Semua Tenant <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- PROMOS --}}
<section id="promos">
    <div class="section-header">
        <h2>Promo</h2>
    </div>

    <div class="container">
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
            
            <div class="carousel-inner">
                @foreach ($promos as $index => $p)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="promo-card p-4">
                        <div class="row align-items-center">
                            <div class="col-md-6 text-center mb-4 mb-md-0">
                                @if ($p->gambar)
                                    <img src="{{ asset('storage/'.$p->gambar) }}" 
                                         class="img-fluid"
                                         style="max-height:350px; object-fit:cover;">
                                @endif
                            </div>

                            <div class="col-md-6">
                                <h4 class="fw-bold mb-3">{{ $p->tenant->nama_tenant ?? '-' }}</h4>
                                <p class="text-muted mb-4">{{ $p->deskripsi }}</p>

                                <div class="mb-2">
                                    <small class="text-muted d-block">
                                        <i class="bi bi-calendar-check me-2"></i>
                                        <strong>Mulai:</strong> {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y, H:i') }}
                                    </small>
                                    <small class="text-muted d-block">
                                        <i class="bi bi-calendar-x me-2"></i>
                                        <strong>Selesai:</strong> {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y, H:i') }}
                                    </small>
                                </div>

                                <div id="countdown-promo-{{ $p->id_promo }}" 
                                     class="countdown-box mt-3"
                                     data-start="{{ $p->tanggal_mulai }}"
                                     data-end="{{ $p->tanggal_selesai }}">
                                    <span class="fw-bold loading">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('promo.list') }}" class="btn btn-primary">
                    <i class="bi bi-tag-fill"></i> Lihat Semua Promo <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- EVENTS --}}
<section id="events">
    <div class="section-header">
        <h2>Event</h2>
    </div>

    <div class="container">
        @if($events && count($events) > 0)
        <div class="event-carousel-wrapper">
            <div class="event-carousel-container">
                @foreach ($events as $index => $e)
                <div class="event-slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                    <div class="event-card-3d">
                        <div class="event-image-wrapper">
                            @if ($e->gambar)
                                <img src="{{ asset('storage/'.$e->gambar) }}" 
                                     alt="{{ $e->nama_event ?? 'Event' }}" class="event-img">
                            @else
                                <img src="https://via.placeholder.com/800x400?text=Event+Image" 
                                     alt="Event Image">
                            @endif
                            <div class="event-badge">
                                <i class="bi bi-calendar-event me-2"></i>Event
                            </div>
                        </div>

                        <div class="event-card-content">
                            <h3 class="event-title">{{ $e->nama_event ?? '-' }}</h3>
                            <p class="event-description">
                                <i class="bi bi-geo-fill"></i> Lantai {{ $e->floor->lantai ?? '-' }}
                            </p>

                            <div class="event-info-grid">
                                <div class="event-info-item">
                                    <i class="bi bi-calendar-check-fill"></i>
                                    <div class="info-text">
                                        <strong>Mulai</strong><br>
                                        {{ \Carbon\Carbon::parse($e->tanggal_mulai)->format('d M Y, H:i') }}
                                    </div>
                                </div>
                                <div class="event-info-item">
                                    <i class="bi bi-calendar-x-fill"></i>
                                    <div class="info-text">
                                        <strong>Selesai</strong><br>
                                        {{ \Carbon\Carbon::parse($e->tanggal_selesai)->format('d M Y, H:i') }}
                                    </div>
                                </div>
                            </div>

                            <div id="countdown-event-{{ $e->id_event }}" 
                                 class="event-countdown-3d"
                                 data-start="{{ $e->tanggal_mulai }}"
                                 data-end="{{ $e->tanggal_selesai }}">
                                <span class="loading">Loading countdown...</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- Navigation Buttons --}}
                <button class="event-nav-btn prev-btn" onclick="changeEventSlide(-1)">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="event-nav-btn next-btn" onclick="changeEventSlide(1)">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>

            {{-- Indicators --}}
            <div class="event-indicators">
                @foreach ($events as $index => $e)
                <div class="event-indicator {{ $index === 0 ? 'active' : '' }}" 
                     onclick="goToEventSlide({{ $index }})"></div>
                @endforeach
            </div>

            {{-- View All Button --}}
            <div class="view-all-events-btn">
                <a href="{{ route('event.list') }}" class="btn btn-primary">
                    <i class="bi bi-calendar-event me-2"></i>
                    View All Events
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        @else
        <div class="event-empty-state">
            <i class="bi bi-calendar-x"></i>
            <h4>No Events Available</h4>
            <p>Stay tuned for upcoming exciting events!</p>
        </div>
        @endif
    </div>
</section>

{{-- FACILITIES --}}
<section id="facilities">
    <div class="section-header">
        <h2>Our Facilities</h2>
    </div>
    
    <div class="facility-container">
        @foreach ($facilities as $key => $f)
            <div class="panel {{ $key === 0 ? 'active' : '' }}" 
                 style="background-image: url('{{ asset('storage/'.$f->foto) }}')">
                <h3>{{ $f->nama_fasilitas ?? 'Facility' }}</h3>
            </div>
        @endforeach
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // === FACILITY PANEL INTERACTION ===
    const panels = document.querySelectorAll('.panel');
    const container = document.querySelector('.facility-container');
    
    let currentIndex = 0;
    const totalPanels = panels.length;
    let autoplayInterval;

    function setActivePanel(panel) {
        panels.forEach(p => p.classList.remove('active'));
        panel.classList.add('active');
    }

    panels.forEach((panel, index) => {
        panel.addEventListener('click', () => {
            currentIndex = index;
            setActivePanel(panel);
            resetAutoplay();
        });
    });

    function startAutoplay() {
        autoplayInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalPanels;
            setActivePanel(panels[currentIndex]);
        }, 4000);
    }

    function resetAutoplay() {
        clearInterval(autoplayInterval);
        startAutoplay();
    }

    if (panels.length > 0) {
        startAutoplay();

        if (container) {
            container.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
            container.addEventListener('mouseleave', startAutoplay);
        }
    }

    // === COUNTDOWN SYSTEM ===
    function startCountdown(elementId, startStr, endStr) {
        const el = document.getElementById(elementId);

        if (!el || !startStr || !endStr) {
            if (el) el.innerHTML = "<span class='text-danger'>Invalid date</span>";
            return;
        }

        const startDate = new Date(startStr.replace(' ', 'T'));
        const endDate = new Date(endStr.replace(' ', 'T'));

        if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
            el.innerHTML = "<span class='text-danger'>Invalid date format</span>";
            return;
        }

        const startMs = startDate.getTime();
        const endMs = endDate.getTime();

        function update() {
            const now = Date.now();

            // NOT STARTED YET
            if (now < startMs) {
                const diff = startMs - now;
                const days = Math.floor(diff / 86400000);
                const hours = Math.floor((diff / 3600000) % 24);
                const minutes = Math.floor((diff / 60000) % 60);
                const seconds = Math.floor((diff / 1000) % 60);

                el.innerHTML = `
                    <div class="fw-bold mb-1">Belum Dimulai</div>
                    <div>
                        <span>${days} Hari</span>
                        <span>${hours} Jam</span>
                        <span>${minutes} Menit</span>
                        <span>${seconds} Detik</span>
                    </div>
                `;
                return;
            }

            // ONGOING
            if (now >= startMs && now < endMs) {
                const diff = endMs - now;
                const days = Math.floor(diff / 86400000);
                const hours = Math.floor((diff / 3600000) % 24);
                const minutes = Math.floor((diff / 60000) % 60);
                const seconds = Math.floor((diff / 1000) % 60);

                el.innerHTML = `
                    <div class="fw-bold mb-1">Sedang Berlangsung</div>
                    <div>
                        <span>${days} Hari</span>
                        <span>${hours} Jam</span>
                        <span>${minutes} Menit</span>
                        <span>${seconds} Detik</span>
                        <span class="text-white-50">tersisa</span>
                    </div>
                `;
                return;
            }

            // ENDED
            if (now >= endMs) {
                el.innerHTML = `<span class='fw-bold'>✅ Ended</span>`;
                if (typeof interval !== 'undefined') {
                    clearInterval(interval);
                }
                return;
            }
        }

        update();
        const interval = setInterval(update, 1000);
    }

    // PROMO COUNTDOWN
    document.querySelectorAll('[id^="countdown-promo-"]').forEach(el => {
        const startStr = el.dataset.start;
        const endStr = el.dataset.end;

        if (!startStr || !endStr) {
            el.innerHTML = "<span class='text-muted'>Date unavailable</span>";
            return;
        }

        startCountdown(el.id, startStr, endStr);
    });

    // === EVENT CAROUSEL ===
    let currentEventSlide = 0;
    const eventSlides = document.querySelectorAll('.event-slide');
    const eventIndicators = document.querySelectorAll('.event-indicator');
    const totalEventSlides = eventSlides.length;

    let eventAutoplayInterval;

    function updateEventSlides() {
        eventSlides.forEach((slide, index) => {
            slide.classList.remove('active', 'prev', 'next');
            
            if (index === currentEventSlide) {
                slide.classList.add('active');
            } else if (index === (currentEventSlide - 1 + totalEventSlides) % totalEventSlides) {
                slide.classList.add('prev');
            } else if (index === (currentEventSlide + 1) % totalEventSlides) {
                slide.classList.add('next');
            }
        });

        // Update indicators
        eventIndicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentEventSlide);
        });
    }

    window.changeEventSlide = function(direction) {
        currentEventSlide = (currentEventSlide + direction + totalEventSlides) % totalEventSlides;
        updateEventSlides();
        resetEventAutoplay();
    };

    window.goToEventSlide = function(index) {
        currentEventSlide = index;
        updateEventSlides();
        resetEventAutoplay();
    };

    function startEventAutoplay() {
        if (totalEventSlides > 1) {
            eventAutoplayInterval = setInterval(() => {
                changeEventSlide(1);
            }, 5000);
        }
    }

    function resetEventAutoplay() {
        clearInterval(eventAutoplayInterval);
        startEventAutoplay();
    }

    // Start autoplay
    if (totalEventSlides > 0) {
        startEventAutoplay();

        // Pause on hover
        const eventCarousel = document.querySelector('.event-carousel-container');
        if (eventCarousel) {
            eventCarousel.addEventListener('mouseenter', () => {
                clearInterval(eventAutoplayInterval);
            });
            eventCarousel.addEventListener('mouseleave', startEventAutoplay);
        }
    }

    // === EVENT COUNTDOWN ===
    function startEventCountdown(elementId, startStr, endStr) {
        const el = document.getElementById(elementId);

        if (!el || !startStr || !endStr) {
            if (el) el.innerHTML = "<span>Date unavailable</span>";
            return;
        }

        const startDate = new Date(startStr.replace(' ', 'T'));
        const endDate = new Date(endStr.replace(' ', 'T'));

        if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
            el.innerHTML = "<span>Invalid date</span>";
            return;
        }

        const startMs = startDate.getTime();
        const endMs = endDate.getTime();

        function update() {
            const now = Date.now();

            if (now < startMs) {
                // UPCOMING
                const diff = startMs - now;
                const days = Math.floor(diff / 86400000);
                const hours = Math.floor((diff / 3600000) % 24);
                const minutes = Math.floor((diff / 60000) % 60);
                const seconds = Math.floor((diff / 1000) % 60);

                el.innerHTML = `
                    <div style="font-size: 0.85rem; margin-bottom: 8px;">Event Dimulai Dalam:</div>
                    <div>
                        <span>${days} Hari</span>
                        <span>${hours} Jam</span>
                        <span>${minutes} Menit</span>
                        <span>${seconds} Detik</span>
                    </div>
                `;
                return;
            }

            if (now >= startMs && now < endMs) {
                // ONGOING
                const diff = endMs - now;
                const days = Math.floor(diff / 86400000);
                const hours = Math.floor((diff / 3600000) % 24);
                const minutes = Math.floor((diff / 60000) % 60);
                const seconds = Math.floor((diff / 1000) % 60);

                el.innerHTML = `
                    <div style="font-size: 0.85rem; margin-bottom: 8px;">Event Berlangsung:</div>
                    <div>
                        <span>${days} Hari</span>
                        <span>${hours} Jam</span>
                        <span>${minutes} Menit</span>
                        <span>${seconds} Detik</span>
                    </div>
                `;
                return;
            }

            // ENDED
            el.innerHTML = `<span style="font-weight: 700;">Event Berakhir</span>`;
            if (typeof interval !== 'undefined') {
                clearInterval(interval);
            }
        }

        update();
        const interval = setInterval(update, 1000);
    }

    document.querySelectorAll('[id^="countdown-event-"]').forEach(el => {
        const startStr = el.dataset.start;
        const endStr = el.dataset.end;

        if (!startStr || !endStr) {
            el.innerHTML = "<span>Date unavailable</span>";
            return;
        }

        startEventCountdown(el.id, startStr, endStr);
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            changeEventSlide(-1);
        } else if (e.key === 'ArrowRight') {
            changeEventSlide(1);
        }
    });
});
</script>

@endsection
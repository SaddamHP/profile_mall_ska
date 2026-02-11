<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAL SKA | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --text-light: #d8dbe2;
        }

        /* === SMOOTH SCROLL === */
        html {
            scroll-behavior: smooth;
        }

        * {
            font-family: "Poppins", sans-serif;
        }

        /* === NAVBAR === */
        .navbar {
            background: var(--primary-gradient) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(255, 255, 255);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-logo {
            height: 45px;
            width: auto;
            transition: all 0.3s ease;
        }

        .navbar.scrolled .navbar-logo {
            height: 40px;
        }

        .navbar-brand-text {
            font-size: 1.8rem;
            font-weight: 800;
            background: white;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: none; /* Hide text, show only logo */
        }

        .nav-link {
            color: var(--text-light) !important;
            font-weight: 600;
            margin: 0 10px;
            padding: 8px 16px !important;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: #a2b1f1;
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-gradient) !important;
            background: rgba(102, 126, 234, 0.1);
        }

        .nav-link:hover::after {
            width: 60%;
        }

        .navbar-toggler {
            border: none;
            padding: 8px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(102, 126, 234, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* === FOOTER === */
        footer {
            background: var(--primary-gradient);
            color: #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .footer-section {
            padding: 60px 0 30px;
        }

        .footer-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: #fff;
            position: relative;
            padding-bottom: 15px;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: #a2b1f1;
            border-radius: 2px;
        }

        .footer-text {
            color: #cbd5e0;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .footer-link {
            color: #cbd5e0;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            padding: 5px 0;
        }

        .footer-link:hover {
            color: #fff;
            transform: translateX(5px);
        }

        .footer-link i {
            margin-right: 8px;
            color: #a2b1f1;
        }

        /* === SOCIAL ICONS === */
        .social-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .social-icon:hover {
            transform: translateY(-5px);
            color: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .social-instagram {
            background: linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #fcb045 100%);
        }

        .social-tiktok {
            background: #000000;
        }

        .social-facebook {
            background: #1877f2;
        }

        /* === CONTACT INFO === */
        .contact-item {
            display: flex;
            align-items: start;
            gap: 12px;
            margin-bottom: 20px;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a2b1f1;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .contact-content {
            flex-grow: 1;
        }

        .contact-content a {
            color: #cbd5e0;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-content small {
            font-weight: 800;
        }

        .contact-content a:hover {
            color: #fff;
        }

        /* === MAP === */
        .footer-map {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 100%;
            height: 250px;
        }

        .footer-map iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* === COPYRIGHT === */
        .footer-bottom {
            background: rgba(0, 0, 0, 0.2);
            padding: 20px 0;
            margin-top: 40px;
        }

        .footer-bottom p {
            margin: 0;
            color: #cbd5e0;
        }

        /* === RESPONSIVE === */
        @media (max-width: 992px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .nav-link {
                margin: 5px 0;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .footer-section {
                padding: 40px 0 20px;
            }

            .footer-title {
                font-size: 1.2rem;
                margin-bottom: 20px;
            }

            .footer-map {
                height: 200px;
                margin-top: 20px;
            }

            .social-links {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.3rem;
            }

            .footer-title {
                font-size: 1.1rem;
            }

            .social-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ Storage::url('images/logo.png') }}" alt="MAL SKA Logo" class="navbar-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="#about" class="nav-link">
                            <i class="bi bi-info-circle me-1"></i>Tentang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tenants" class="nav-link">
                            <i class="bi bi-shop me-1"></i>Tenant
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#promos" class="nav-link">
                            <i class="bi bi-tags me-1"></i>Promo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#events" class="nav-link">
                            <i class="bi bi-calendar-event me-1"></i>Event
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#facilities" class="nav-link">
                            <i class="bi bi-cone-striped me-1"></i>Fasilitas
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <div style="margin-top: 76px;">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-section">
            <div class="container">
                <div class="row g-4">
                    
                    {{-- ABOUT SECTION --}}
                    <div class="col-lg-4 col-md-6">
                        <h5 class="footer-title">Tentang Mall SKA</h5>
                        @foreach ($profiles as $p)
                            <p class="footer-text">{{ Str::limit($p->deskripsi, 150) }}</p>
                        @endforeach
                        <div class="social-links">
                            <a href="https://www.instagram.com/malskapekanbaru?igsh=Z2I5Ymdic3hzZGFv" 
                               target="_blank" 
                               class="social-icon social-instagram"
                               title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" 
                               class="social-icon social-tiktok"
                               title="TikTok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                            <a href="#" 
                               class="social-icon social-facebook"
                               title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </div>
                    </div>

                    {{-- NAVIGATION --}}
                    <div class="col-lg-2 col-md-6">
                        <h5 class="footer-title">Navigasi</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="#about" class="footer-link">
                                    <i class="bi bi-chevron-right"></i>Tentang Kami
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#tenants" class="footer-link">
                                    <i class="bi bi-chevron-right"></i>Tenant
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#promos" class="footer-link">
                                    <i class="bi bi-chevron-right"></i>Promo
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#events" class="footer-link">
                                    <i class="bi bi-chevron-right"></i>Event
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#facilities" class="footer-link">
                                    <i class="bi bi-chevron-right"></i>Fasilitas
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- CONTACT INFO --}}
                    <div class="col-lg-3 col-md-6">
                        <h5 class="footer-title">Informasi</h5>
                        @foreach ($contacts as $c)
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="contact-content">
                                    <small class="d-block mb-1">Alamat</small>
                                    {{ $c->alamat }}
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="contact-content">
                                    <small class="d-block mb-1">Telepon</small>
                                    <a href="tel:{{ $c->telepon }}">{{ $c->telepon }}</a>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div class="contact-content">
                                    <small class="d-block mb-1">Email</small>
                                    <a href="/cdn-cgi/l/email-protection#7308085357105e4d161e121a1f530e0e">{{ $c->email }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- MAP --}}
                    <div class="col-lg-3 col-md-6">
                        <h5 class="footer-title">Lokasi Kami</h5>
                        @foreach ($contacts as $c)
                            <div class="footer-map">
                                @if ($c->maps_embed)
                                    <iframe 
                                        src="{{ $c->maps_embed }}" 
                                        allowfullscreen="" 
                                        loading="lazy" 
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-secondary">
                                        <p class="text-white">Map tidak tersedia</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <p>
                            &copy; {{ date('Y') }} <strong>Mal SKA</strong>. All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p>
                            <em>Mall With Style</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            });
        });
    </script>
</body>
</html>
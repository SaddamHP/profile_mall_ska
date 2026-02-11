<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAL SKA - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --text-light: #ffffff;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        html {
            scroll-behavior: smooth;
        }

        /* === NAVBAR === */
        .navbar {
            background: var(--primary-gradient) !important;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
        }

        /* === NAVBAR BRAND (LOGO) === */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            padding: 5px;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: white;
            padding: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            object-fit: contain;
        }

        .navbar-brand:hover .brand-logo {
            transform: rotate(5deg);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .brand-text {
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            letter-spacing: 0.5px;
        }

        /* === BACK BUTTON === */
        .btn-back-home {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back-home:hover {
            background: white;
            color: #667eea;
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-back-home i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .btn-back-home:hover i {
            transform: translateX(-3px);
        }

        /* === NAVBAR TOGGLER === */
        .navbar-toggler {
            border: 2px solid rgba(255, 255, 255, 0.5);
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            border-color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 25px;
            height: 25px;
        }

        /* === MOBILE MENU === */
        .navbar-collapse {
            background: rgba(102, 126, 234, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            margin-top: 15px;
            padding: 15px;
        }

        @media (min-width: 992px) {
            .navbar-collapse {
                background: transparent;
                backdrop-filter: none;
                margin-top: 0;
                padding: 0;
            }
        }

        /* === RESPONSIVE === */
        @media (max-width: 992px) {
            .brand-logo {
                width: 45px;
                height: 45px;
            }

            .brand-text {
                font-size: 1.3rem;
            }

            .btn-back-home {
                width: 100%;
                justify-content: center;
                margin-top: 10px;
            }
        }

        @media (max-width: 576px) {
            .brand-logo {
                width: 40px;
                height: 40px;
            }

            .brand-text {
                font-size: 1.1rem;
            }

            .navbar {
                padding: 10px 0;
            }
        }

        /* === ANIMATION === */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar-collapse.show {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            {{-- LOGO BRAND --}}
            <a href="#" class="navbar-brand">
                <img src="storage/app/public/logo.png" 
                     alt="Mall SKA Logo" 
                     class="brand-logo"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                
                <div class="brand-logo" style="display:none; align-items:center; justify-content:center; font-size:1.5rem; font-weight:800; color:#667eea;">
                    SKA
                </div>
                
                <span class="brand-text">MALL SKA</span>
            </a>

            {{-- TOGGLER BUTTON --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- NAVBAR MENU --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="btn-back-home">
                            <i class="bi bi-house-door-fill"></i>
                            <span>Kembali ke Beranda</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <div style="margin-top: 90px;">
        @yield('content')
    </div>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        document.querySelector('.btn-back-home')?.addEventListener('click', () => {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        });
    </script>
</body>
</html>
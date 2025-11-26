<!DOCTYPE html>
<html lang="en">
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
            --text-light: #d8dbe2;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        html {
            scroll-behavior: smooth;
        }

        .navbar {
            background: var(--primary-gradient) !important;
            backdrop-filter: 0 2px 20px rgba(255, 255, 255);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3 ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
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
            background: var(--primary-gradient);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: #a2b1f1 !important;
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

        /* === BACK BUTTON === */
    .back-button {
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1000;
        text-decoration: none;
        color: whitesmoke;
        font-size: 1.3rem;
    }

    .back-button:hover {
        transform: translateX(-5px) scale(1.1);
        color: #a2b1f1;
    }

    /* === RESPONSIVE === */
    @media(max-width: 992px) {
        .navbar-brand {
            font-size: 1.5rem;
        }

        .nav-link {
            margin: 5px 0;
            text-align: center;
        }
    }

    @media(max-width: 576px) {
        .navbar-brand {
            font-size: 1.1rem;
        }
    }
     </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a href="#" class="navbar-brand">
                MAL SKA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {{-- BACK BUTTON --}}
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="back-button" title="Kembali ke halaman awal">
                        <i class="bi bi-house-fill"></i> Kembali
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

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if(window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if(navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootsrap.Collapse(navbarCollapse);
                }
            });
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
@extends('layouts.admin')
@section('title', 'Dashboard Admin')
    
@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .main-content {
        margin-left: 280px;
        background: linear-gradient(to bottom, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 30px;
        transition: all 0.3s ease;
    }

    .collapsed ~ .main-content {
        margin-left: 80px;
    }

    /* === HEADER === */
    .dashboard-header {
        margin-bottom: 30px;
        animation: fadeInDown 0.6s ease-out;
    }

    .dashboard-header h1 {
        font-size: clamp(1.5rem, 4vw, 2.5rem);
        font-weight: 800;
        color: #2d3748;
        margin-bottom: 10px;
    }

    .dashboard-header p {
        color: #718096;
        font-size: 1rem;
    }

    /* === STAT CARDS === */
    .stat-card {
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        background: white;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30%, -30%);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .stat-card:hover::before {
        transform: translate(30%, -30%) scale(1.5);
    }

    .stat-card-tenant {
        background: var(--primary-gradient);
        color: white;
    }

    .stat-card-event {
        background: var(--success-gradient);
        color: white;
    }

    .stat-card-promo {
        background: var(--warning-gradient);
        color: white;
    }

    .stat-card-facility {
        background: var(--info-gradient);
        color: white;
    }

    .stat-icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .stat-icon {
        font-size: 2rem;
        color: white;
    }

    .stat-value {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 800;
        line-height: 1;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .stat-card-content {
        position: relative;
        z-index: 1;
    }

    /* === LOGOUT SECTION === */
    .logout-section {
        background: white;
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    .logout-section h5 {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .btn-logout {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(250, 112, 154, 0.4);
    }

    .btn-logout:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(250, 112, 154, 0.5);
        color: white;
    }

    /* === ANIMATIONS === */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    /* === QUICK INFO === */
    .quick-info {
        background: white;
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    .quick-info h5 {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 12px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .info-item i {
        font-size: 1.5rem;
        color: #667eea;
    }

    .info-item-content {
        flex-grow: 1;
    }

    .info-item-label {
        font-size: 0.85rem;
        color: #718096;
        margin-bottom: 5px;
    }

    .info-item-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
    }

    /* === RESPONSIVE === */
    @media (max-width: 992px) {
        .main-content {
            margin-left: 0;
            padding: 20px;
        }

        .collapsed ~ .main-content {
            margin-left: 0;
        }
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 15px;
        }

        .stat-card {
            padding: 20px;
            margin-bottom: 15px;
        }

        .stat-icon-wrapper {
            width: 60px;
            height: 60px;
        }

        .stat-icon {
            font-size: 1.5rem;
        }

        .logout-section {
            padding: 20px;
        }

        .quick-info {
            padding: 20px;
        }
    }

    @media (max-width: 576px) {
        .dashboard-header h1 {
            font-size: 1.5rem;
        }

        .stat-card {
            padding: 15px;
        }

        .stat-value {
            font-size: 2rem;
        }
    }
</style>

<main class="main-content">
    <div class="container-fluid">
        
        {{-- HEADER --}}
        <div class="dashboard-header">
            <h1>👋 Selamat Datang di Dashboard</h1>
            <p>Mall SKA - Kelola semua data dengan mudah</p>
        </div>

        {{-- STAT CARDS --}}
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card stat-card-tenant fade-in-up" style="animation-delay: 0.1s">
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <i class="bi bi-shop-window stat-icon"></i>
                        </div>
                        <div class="stat-value">{{ App\Models\Tenant::count() }}</div>
                        <div class="stat-label">Total Tenant</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card stat-card-event fade-in-up" style="animation-delay: 0.2s">
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <i class="bi bi-calendar-event-fill stat-icon"></i>
                        </div>
                        <div class="stat-value">{{ App\Models\Event::count() }}</div>
                        <div class="stat-label">Total Event</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card stat-card-promo fade-in-up" style="animation-delay: 0.3s">
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <i class="bi bi-tags-fill stat-icon"></i>
                        </div>
                        <div class="stat-value">{{ App\Models\Promo::count() }}</div>
                        <div class="stat-label">Total Promo</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card stat-card-facility fade-in-up" style="animation-delay: 0.4s">
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <i class="bi bi-cone-striped stat-icon"></i>
                        </div>
                        <div class="stat-value">{{ App\Models\Facility::count() }}</div>
                        <div class="stat-label">Total Fasilitas</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- QUICK INFO --}}
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="quick-info fade-in-up" style="animation-delay: 0.5s">
                    <h5><i class="bi bi-speedometer2 me-2"></i>Informasi Cepat</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="bi bi-calendar-check"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">Event Aktif</div>
                                    <div class="info-item-value">
                                        {{ App\Models\Event::where('tanggal_selesai', '>=', now())->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="bi bi-tag"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">Promo Aktif</div>
                                    <div class="info-item-value">
                                        {{ App\Models\Promo::where('tanggal_selesai', '>=', now())->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="bi bi-building"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">Total Lantai</div>
                                    <div class="info-item-value">
                                        {{ App\Models\Floor::count() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="bi bi-grid-3x3"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">Total Kategori</div>
                                    <div class="info-item-value">
                                        {{ App\Models\Category::count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- LOGOUT SECTION --}}
            <div class="col-lg-4 mb-4">
                <div class="logout-section fade-in-up" style="animation-delay: 0.6s">
                    <h5><i class="bi bi-person-circle me-2"></i>Akun Admin</h5>
                    <p class="text-muted mb-3">
                        <small>
                            <i class="bi bi-envelope me-2"></i>{{ Auth::user()->email ?? 'admin@mall.com' }}
                        </small>
                    </p>
                    <p class="text-muted mb-3">
                        <small>
                            <i class="bi bi-clock me-2"></i>Login: {{ now()->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}
                        </small>
                    </p>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-logout w-100">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </div>

                {{-- QUICK ACTIONS --}}
                <div class="logout-section mt-3 fade-in-up" style="animation-delay: 0.7s">
                    <h5><i class="bi bi-lightning-charge me-2"></i>Quick Actions</h5>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('tenants.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-shop me-2"></i>Kelola Tenant
                        </a>
                        <a href="{{ route('events.index') }}" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-calendar-event me-2"></i>Kelola Event
                        </a>
                        <a href="{{ route('promos.index') }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-tags me-2"></i>Kelola Promo
                        </a>
                        <a href="{{ route('facilities.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-cone-striped me-2"></i>Kelola Fasilitas
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
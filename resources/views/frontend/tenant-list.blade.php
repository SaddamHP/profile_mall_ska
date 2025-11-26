@extends('layouts.tenant')
@section('title', 'Tenant')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --card-shadow-hover: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    /* === HERO HEADER === */
    .tenant-hero {
        background: var(--primary-gradient);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .tenant-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }

    .tenant-hero::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 80px;
        background: white;
        clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
    }

    .tenant-hero h1 {
        color: white;
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 800;
        text-shadow: 2px 4px 12px rgba(0,0,0,0.2);
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .tenant-hero p {
        color: rgba(255, 255, 255, 0.9);
        font-size: clamp(1rem, 2vw, 1.2rem);
        position: relative;
        z-index: 1;
    }

    /* === FILTER SECTION === */
    .filter-section {
        background: white;
        padding: 25px;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        margin-bottom: 40px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    .filter-label {
        font-weight: 600;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .custom-select {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        background: white;
        min-width: 180px;
    }

    .custom-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .custom-select:hover {
        border-color: #667eea;
    }

    /* === SEARCH BAR === */
    .search-wrapper {
        position: relative;
        width: 100%;
        max-width: 400px;
    }

    .search-input {
        width: 100%;
        padding: 12px 45px 12px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .search-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        font-size: 1.2rem;
    }

    /* === TENANT CARDS === */
    .tenant-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        height: 100%;
        position: relative;
    }

    .tenant-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: var(--card-shadow-hover);
    }

    .tenant-card-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .tenant-card:hover .tenant-card-image {
        transform: scale(1.1);
    }

    .tenant-card-body {
        padding: 20px;
    }

    .tenant-card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 8px;
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

    .tenant-floor {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #718096;
        font-weight: 500;
    }

    /* === LOADING STATE === */
    .loading-spinner {
        display: inline-block;
        width: 50px;
        height: 50px;
        border: 5px solid #f3f4f6;
        border-top-color: #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .loading-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        gap: 20px;
    }

    /* === EMPTY STATE === */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 5rem;
        color: #cbd5e0;
        margin-bottom: 20px;
    }

    .empty-state-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 10px;
    }

    .empty-state-text {
        color: #718096;
        font-size: 1rem;
    }

    /* === STATS COUNTER === */
    .stats-bar {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .stats-number {
        font-size: 1.5rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stats-text {
        color: #718096;
        font-weight: 600;
    }

    /* === ANIMATION === */
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

    .fade-in {
        animation: fadeInUp 0.5s ease-out;
    }

    /* === RESPONSIVE === */
    @media (max-width: 768px) {
        .tenant-hero {
            padding: 80px 0 60px;
        }

        .filter-section {
            padding: 20px;
        }

        .custom-select {
            width: 100%;
            min-width: unset;
        }

        .search-wrapper {
            max-width: 100%;
        }

        .back-button {
            width: 45px;
            height: 45px;
            top: 15px;
            left: 15px;
        }

        .tenant-card-image {
            height: 180px;
        }
    }

    @media (max-width: 576px) {
        .tenant-hero h1 {
            font-size: 1.8rem;
        }

        .filter-section {
            gap: 10px;
        }

        .stats-bar {
            flex-direction: column;
            gap: 5px;
        }
    }

    /* === GRID LAYOUT === */
    .tenant-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    @media (max-width: 768px) {
        .tenant-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 576px) {
        .tenant-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

{{-- HERO SECTION --}}
<section class="tenant-hero">
    <div class="container text-center">
        <h1 class="fade-in">Our Tenants</h1>
        <p class="fade-in">Explore Tenant in Our Mall</p>
    </div>
</section>

<section class="container pb-5">

    {{-- STATS BAR --}}
    <div class="stats-bar fade-in">
        <i class="bi bi-shop"></i>
        <span class="stats-number" id="tenantCount">0</span>
        <span class="stats-text">Tenant Tersedia</span>
    </div>

    {{-- SEARCH & FILTER --}}
    <div class="filter-section fade-in">
        {{-- SEARCH BAR --}}
        <div class="search-wrapper">
            <input type="text" 
                   id="searchInput" 
                   class="search-input" 
                   placeholder="Ketik nama tenant...">
            <i class="bi bi-search search-icon"></i>
        </div>

        {{-- CATEGORY FILTER --}}
        <div class="d-flex align-items-center gap-2">
            <span class="filter-label">
                <i class="bi bi-tag"></i>
                Kategori:
            </span>
            <select id="filterCategory" class="custom-select">
                <option value="all">Semua Kategori</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id_category }}">{{ $c->nama_category }}</option>
                @endforeach
            </select>
        </div>

        {{-- FLOOR FILTER --}}
        <div class="d-flex align-items-center gap-2">
            <span class="filter-label">
                <i class="bi bi-geo-fill"></i>
                Lantai:
            </span>
            <select id="filterFloor" class="custom-select">
                <option value="all">Semua Lantai</option>
                @foreach ($floors as $f)
                    <option value="{{ $f->id_floor }}">Lantai {{ $f->lantai }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- TENANT GRID --}}
    <div id="tenantContainer" class="tenant-grid"></div>

</section>

{{-- AJAX SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", () => {

    const categorySelect = document.getElementById("filterCategory");
    const floorSelect = document.getElementById("filterFloor");
    const searchInput = document.getElementById("searchInput");
    const tenantContainer = document.getElementById("tenantContainer");
    const tenantCount = document.getElementById("tenantCount");

    let allTenants = [];
    let filteredTenants = [];

    // === LOAD TENANTS ===
    function loadTenants() {
        showLoading();

        let url = `/ajax/tenants?category=${categorySelect.value}&floor=${floorSelect.value}`;
        
        fetch(url)
            .then(res => res.json())
            .then(data => {
                allTenants = data.tenants;
                applySearch();
            })
            .catch(error => {
                console.error('Error loading tenants:', error);
                showError();
            });
    }

    // === SEARCH FILTER ===
    function applySearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        
        if (searchTerm === '') {
            filteredTenants = allTenants;
        } else {
            filteredTenants = allTenants.filter(tenant => 
                tenant.nama_tenant.toLowerCase().includes(searchTerm)
            );
        }
        
        renderTenants(filteredTenants);
    }

    // === RENDER TENANTS ===
    function renderTenants(tenants) {
        tenantContainer.innerHTML = "";

        // Update counter with animation
        animateCounter(tenants.length);

        if (tenants.length === 0) {
            showEmptyState();
            return;
        }

        tenants.forEach((t, index) => {
            const card = document.createElement('div');
            card.className = 'fade-in';
            card.style.animationDelay = `${index * 0.05}s`;
            
            card.innerHTML = `
                <div class="tenant-card">
                    <img src="/storage/${t.gambar}" 
                         class="tenant-card-image" 
                         alt="${t.nama_tenant}"
                         onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                    <div class="tenant-card-body">
                        <span class="tenant-badge">${t.category.nama_category}</span>
                        <h5 class="tenant-card-title">${t.nama_tenant}</h5>
                        <div class="tenant-floor">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Floor ${t.floor ? t.floor.lantai : 'N/A'}</span>
                        </div>
                    </div>
                </div>
            `;
            
            tenantContainer.appendChild(card);
        });
    }

    // === LOADING STATE ===
    function showLoading() {
        tenantContainer.innerHTML = `
            <div class="col-12">
                <div class="loading-wrapper">
                    <div class="loading-spinner"></div>
                    <p class="text-muted">Loading tenants...</p>
                </div>
            </div>
        `;
    }

    // === EMPTY STATE ===
    function showEmptyState() {
        tenantContainer.innerHTML = `
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3 class="empty-state-title">No Tenants Found</h3>
                    <p class="empty-state-text">Try adjusting your filters or search terms</p>
                </div>
            </div>
        `;
    }

    // === ERROR STATE ===
    function showError() {
        tenantContainer.innerHTML = `
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h3 class="empty-state-title">Oops! Something went wrong</h3>
                    <p class="empty-state-text">Please try again later</p>
                </div>
            </div>
        `;
    }

    // === COUNTER ANIMATION ===
    function animateCounter(target) {
        const current = parseInt(tenantCount.textContent) || 0;
        const increment = target > current ? 1 : -1;
        const duration = 500;
        const steps = Math.abs(target - current);
        const stepDuration = duration / steps;

        let count = current;
        const timer = setInterval(() => {
            count += increment;
            tenantCount.textContent = count;
            
            if (count === target) {
                clearInterval(timer);
            }
        }, stepDuration);
    }

    // === EVENT LISTENERS ===
    categorySelect.addEventListener("change", loadTenants);
    floorSelect.addEventListener("change", loadTenants);
    
    // Debounce search input
    let searchTimeout;
    searchInput.addEventListener("input", () => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            applySearch();
        }, 300);
    });

    // === INITIAL LOAD ===
    loadTenants();
});
</script>

@endsection
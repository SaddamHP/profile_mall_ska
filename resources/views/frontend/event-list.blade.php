@extends('layouts.event')

@section('title', 'Event')
@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --card-shadow-hover: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    /* === HERO HEADER === */
    .event-hero {
        background: var(--primary-gradient);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
        margin-bottom: 60px;
    }

    .event-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }

    .event-hero::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 80px;
        background: white;
        clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
    }

    .event-hero h1 {
        color: white;
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 800;
        text-shadow: 2px 4px 12px rgba(0, 0, 0, 0.2);
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .event-hero p {
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

    /* === STATUS FILTER TABS === */
    .status-tabs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
    }

    .status-tab {
        padding: 12px 25px;
        border-radius: 50px;
        border: 2px solid #e2e8f0;
        background: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-tab:hover {
        border-color: #667eea;
        transform: translateY(-2px);
    }

    .status-tab.active {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .status-tab.active.ongoing {
        background: var(--success-gradient);
    }

    .status-tab.active.upcoming {
        background: var(--warning-gradient);
    }

    .status-tab.active.ended {
        background: var(--danger-gradient);
    }

    /* === EVENT CARDS === */
    .event-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--card-shadow-hover);
    }

    .event-card-image-wrapper {
        width: 100%;
        height: 250px;
        overflow: hidden;
        position: relative;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .event-card-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }

    .event-card:hover .event-card-image {
        transform: scale(1.05);
    }

    .event-status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .badge-ongoing {
        background: rgba(17, 153, 142, 0.95);
        color: white;
    }

    .badge-upcoming {
        background: rgba(245, 87, 108, 0.95);
        color: white;
    }

    .badge-ended {
        background: rgba(113, 128, 150, 0.95);
        color: white;
    }

    .event-card-body {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .event-card-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .event-card-description {
        color: #4a5568;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        flex-grow: 1;
        font-weight: 500;
    }

    .event-dates {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 15px;
        padding-top: 15px;
        border-top: 2px dashed #e2e8f0;
    }

    .event-date-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
        color: #4a5568;
    }

    .event-date-item i {
        color: #667eea;
        font-size: 1rem;
    }

    /* === COUNTDOWN BOX === */
    .countdown-box {
        background: var(--primary-gradient);
        color: white;
        padding: 12px 18px;
        border-radius: 12px;
        font-size: 0.9rem;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        text-align: center;
    }

    .countdown-box.ongoing {
        background: var(--success-gradient);
    }

    .countdown-box.upcoming {
        background: var(--warning-gradient);
    }

    .countdown-box.ended {
        background: var(--danger-gradient);
    }

    .countdown-box span {
        margin: 0 3px;
        font-weight: 600;
    }

    /* === STATS BAR === */
    .stats-bar {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
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

    /* === MODAL STYLES === */
    .modal-content {
        border-radius: 20px;
        border: none;
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 20px 30px;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
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

    /* === GRID LAYOUT === */
    .event-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    /* === RESPONSIVE === */
    @media (max-width: 768px) {
        .event-hero {
            padding: 80px 0 60px;
        }

        .filter-section {
            padding: 20px;
        }

        .status-tab {
            flex: 1;
            justify-content: center;
            padding: 10px 15px;
            font-size: 0.9rem;
        }

        .back-button {
            width: 45px;
            height: 45px;
            top: 15px;
            left: 15px;
        }

        .event-card-image-wrapper {
            height: 200px;
        }

        .event-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    @media (max-width: 576px) {
        .event-hero h1 {
            font-size: 1.8rem;
        }

        .stats-bar {
            flex-direction: column;
            gap: 5px;
        }

        .event-card-body {
            padding: 20px;
        }

        .countdown-box {
            font-size: 0.8rem;
            padding: 10px 15px;
        }
    }
</style>

{{-- HERO SECTION --}}
<section class="event-hero">
    <div class="container text-center">
        <h1 class="fade-in">Semua Event</h1>
        <p class="fade-in">Jangan lewatkan event menarik kami</p>
    </div>
</section>

<section class="container pb-5">

    {{-- STATS BAR --}}
    <div class="stats-bar fade-in">
        <i class="bi bi-calendar-event-fill"></i>
        <span class="stats-number">{{ $events->count() }}</span>
        <span class="stats-text">Event Tersedia</span>
    </div>

    {{-- FILTER --}}
    <div class="filter-section fade-in">
        <div class="status-tabs">
            <button class="status-tab active" data-status="all">
                <i class="bi bi-grid-fill"></i>
                Semua Event
            </button>
            <button class="status-tab ongoing" data-status="ongoing">
                <i class="bi bi-play-circle-fill"></i>
                Sedang Berlangsung
            </button>
            <button class="status-tab upcoming" data-status="upcoming">
                <i class="bi bi-clock-fill"></i>
                Akan Datang
            </button>
            <button class="status-tab ended" data-status="ended">
                <i class="bi bi-check-circle-fill"></i>
                Sudah Berakhir
            </button>
        </div>
    </div>

    {{-- EVENT GRID - LANGSUNG DI BLADE --}}
    <div class="event-grid">
        @foreach ($events as $e)
            @php
                $now = now();
                $start = \Carbon\Carbon::parse($e->tanggal_mulai);
                $end = \Carbon\Carbon::parse($e->tanggal_selesai);
                
                // Tentukan status
                if ($now->lt($start)) {
                    $status = 'upcoming';
                    $statusText = 'Akan Datang';
                    $statusClass = 'badge-upcoming';
                } elseif ($now->gte($start) && $now->lt($end)) {
                    $status = 'ongoing';
                    $statusText = 'Sedang Berlangsung';
                    $statusClass = 'badge-ongoing';
                } else {
                    $status = 'ended';
                    $statusText = 'Sudah Berakhir';
                    $statusClass = 'badge-ended';
                }
            @endphp

            <div class="event-card fade-in" data-status="{{ $status }}">
                <div class="event-card-image-wrapper">
                    @if ($e->gambar)
                        <img src="{{ asset('storage/'.$e->gambar) }}" 
                             class="event-card-image" 
                             alt="{{ $e->nama_event }}">
                    @else
                        <img src="https://via.placeholder.com/400x300?text=No+Image" 
                             class="event-card-image" 
                             alt="Event">
                    @endif
                    <span class="event-status-badge {{ $statusClass }}">
                        {{ $statusText }}
                    </span>
                </div>

                <div class="event-card-body">
                    <h5 class="event-card-title">{{ $e->nama_event ?? 'Event' }}</h5>
                    
                    <p class="event-card-description">
                        <i class="bi bi-geo-fill"></i>Lantai {{ $e->floor->lantai ?? '-' }}
                    </p>
                    
                    <div class="event-dates">
                        <div class="event-date-item">
                            <i class="bi bi-calendar-check"></i>
                            <span><strong>Mulai:</strong> {{ $start->locale('id')->isoFormat('D MMM YYYY, HH:mm') }}</span>
                        </div>
                        <div class="event-date-item">
                            <i class="bi bi-calendar-x"></i>
                            <span><strong>Berakhir:</strong> {{ $end->locale('id')->isoFormat('D MMM YYYY, HH:mm') }}</span>
                        </div>
                    </div>

                    <div id="countdown-event-{{ $e->id_event }}" 
                         class="countdown-box {{ $status }}"
                         data-start="{{ $e->tanggal_mulai }}"
                         data-end="{{ $e->tanggal_selesai }}">
                        <span>Loading...</span>
                    </div>
                    
                    <button class="btn btn-primary w-100 mt-3" 
                            onclick="openEventDetail('{{ $e->nama_event }}', '{{ $statusText }}', '{{ $start->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}', '{{ $end->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}', '{{ addslashes($e->deskripsi ?? '') }}', '{{ asset('storage/'.$e->gambar) }}')"
                            style="background: var(--primary-gradient); border: none; padding: 12px; border-radius: 12px; font-weight: 600;">
                        <i class="bi bi-eye-fill"></i> Lihat Detail
                    </button>
                </div>
            </div>
        @endforeach
    </div>

</section>

{{-- MODAL DETAIL --}}
<div class="modal fade" id="detailCard" tabindex="-1" aria-labelledby="detailCardLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailCardLabel">
                    <i class="bi bi-calendar-event-fill me-2"></i>Detail Event
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="eventDetailContent">
                {{-- Content loaded by JavaScript --}}
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT - HANYA UNTUK COUNTDOWN & FILTER --}}
<script>
document.addEventListener("DOMContentLoaded", () => {

    const statusTabs = document.querySelectorAll(".status-tab");
    const eventCards = document.querySelectorAll(".event-card");

    // === STATUS FILTER ===
    statusTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const selectedStatus = tab.dataset.status;
            
            // Update active tab
            statusTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            
            // Filter cards
            eventCards.forEach(card => {
                if (selectedStatus === 'all' || card.dataset.status === selectedStatus) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // === COUNTDOWN SYSTEM ===
    function startCountdown(elementId, startStr, endStr) {
        const el = document.getElementById(elementId);
        if (!el) return;

        const startDate = new Date(startStr.replace(' ', 'T'));
        const endDate = new Date(endStr.replace(' ', 'T'));

        if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
            el.innerHTML = "<span>Format tanggal tidak valid</span>";
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
                    <div style="font-size: 0.85rem; margin-bottom: 5px;">Dimulai dalam:</div>
                    <div>
                        <span>${days}h</span>
                        <span>${hours}j</span>
                        <span>${minutes}m</span>
                        <span>${seconds}d</span>
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
                    <div style="font-size: 0.85rem; margin-bottom: 5px;">Berakhir dalam:</div>
                    <div>
                        <span>${days}h</span>
                        <span>${hours}j</span>
                        <span>${minutes}m</span>
                        <span>${seconds}d</span>
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

    // Initialize all countdowns
    document.querySelectorAll('[id^="countdown-event-"]').forEach(el => {
        const startStr = el.dataset.start;
        const endStr = el.dataset.end;

        if (!startStr || !endStr) {
            el.innerHTML = "<span>Tanggal tidak tersedia</span>";
            return;
        }

        startCountdown(el.id, startStr, endStr);
    });

    // === OPEN EVENT DETAIL ===
    window.openEventDetail = function(name, status, startFormatted, endFormatted, description, imageUrl) {
        const html = `
            <div class="row">
                <div class="col-md-5 mb-3 text-center">
                    <img src="${imageUrl}" 
                         class="img-fluid rounded shadow"
                         style="max-height: 350px; object-fit: contain;"
                         onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                </div>

                <div class="col-md-7">
                    <h4 class="mb-3">${name}</h4>
                    <span class="badge bg-primary mb-3">${status}</span>

                    <p><strong><i class="bi bi-calendar-check me-2"></i>Mulai:</strong> ${startFormatted}</p>
                    <p><strong><i class="bi bi-calendar-x me-2"></i>Berakhir:</strong> ${endFormatted}</p>

                    <hr>

                    <p class="mt-3"><strong>Deskripsi:</strong></p>
                    <p>${description || 'Tidak ada deskripsi tersedia'}</p>
                </div>
            </div>
        `;

        document.getElementById("eventDetailContent").innerHTML = html;
        
        const modalElement = document.getElementById("detailCard");
        if (modalElement) {
            new bootstrap.Modal(modalElement).show();
        }
    };
});
</script>

@endsection
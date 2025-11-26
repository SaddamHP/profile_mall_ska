<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-width-collapsed: 80px;
        }

        body {
            overflow-x: hidden;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, #1a1c2e 0%, #16181f 100%);
            color: #b7b9c9;
            transition: all .3s ease;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            padding-top: 60px;
            z-index: 200;
        }

        .sidebar.collapsed {
            width: var(--sidebar-width-collapsed);
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #b7b9c9;
            transition: all .2s ease;
            white-space: nowrap;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .sidebar .nav-link i {
            margin-right: 12px;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        /* CONTENT */
        .content-area {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            transition: all .3s ease;
            padding: 20px;
        }

        .sidebar.collapsed ~ .content-area {
            margin-left: var(--sidebar-width-collapsed);
            width: calc(100% - var(--sidebar-width-collapsed));
        }

        /* Toggle Button */
        .toggle-btn {
            position: fixed;
            top: 15px;
            left: calc(var(--sidebar-width) - 15px);
            z-index: 300;
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 50%;
            background: white;
            box-shadow: 0 2px 6px rgba(0,0,0,.2);
            transition: all .3s ease;
        }

        .sidebar.collapsed + .toggle-btn {
            left: calc(var(--sidebar-width-collapsed) - 15px);
            transform: rotate(180deg);
        }

        .modal-content {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.5);
        }

        .modal-header {
            border-bottom: none;
            padding: 1.5rem 1.5rem 0.5rem;
            background: linear-gradient(to right, #ff6b6b, #ff8787);
            border-radius: 1rem, 1rem, 0, 0;
            color: white;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .btn-close:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 2rem, 1.5rem;
            font-size: 1.1rem;
            color: #495057;
        }

        .modal-footer {
            border-top: none;
            padding: 1rem, 1.5rem 1.5rem;
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-secondary {
            background-color: #dee2e6;
        }

        .btn-danger {
            background: red;
            border: none;
        }

        .btn-danger:hover {
            background: rgb(252, 123, 123);
        }

        .warning-icon {
            font-size: 3rem;
            color: #ff6b6b;
            margin-bottom: 1rem;
        }

        .modal-fade .modal-dialog {
            transform: scale(0.95);
            transition: transform 0.2s ease-out;
        }

        .modal.show .modal-dialog {
            transform: scale(1);
        }
    </style>
</head>

<body>

<div class="admin-layout">

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebarMenu">

        <div class="px-4 mb-4">
            <h4 class="text-white fw-bold">Admin MAL SKA</h4>
        </div>

        <ul class="nav flex-column">
            <li><a href="/dashboard" class="nav-link"><i class="bi bi-house-fill"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('profiles.index') }}" class="nav-link text-decoration-none p-3 {{ request()->routeIs('profiles.*') ? 'active' : '' }}"><i class="bi bi-building-fill"></i> <span>Profile</span></a></li>
            <li><a href="{{ route('contacts.index') }}" class="nav-link text-decoration-none p-3 {{ request()->routeIs('contacts.*') ? 'active' : '' }}"><i class="bi bi-telephone-fill"></i> <span>Contacts</span></a></li>
            <li><a href="{{ route('floors.index') }}" class="nav-link text-decoration-none p-3 {{ request()->routeIs('floors.*') ? 'active' : '' }}"><i class="bi bi-layers-fill"></i> <span>Floors</span></a></li>
            <li><a href="{{ route('categories.index') }}" class="nav-link text-decoration-none p-3 {{ request()->routeIs('categories.*') ? 'active' : '' }}"><i class="bi bi-bookmark-fill"></i> <span>Categories</span></a></li>
            <li><a href="{{ route('tenants.index') }}" class="nav-link text-decoration-none p-3 {{ request()->routeIs('tenants.*') ? 'active' : '' }}"><i class="bi bi-shop-window"></i> <span>Tenants</span></a></li>
            <li><a href="{{ route('promos.index') }}" class="nav-link text-decoration-none p-3 {{ request()->routeIs('promos.*') ? 'active' : '' }}"><i class="bi bi-tags-fill"></i> <span>Promos</span></a></li>
            <li><a href="{{ route('facilities.index') }}" class="nav-link text-decoration-none p-3 {{ request()->routeIs('facilities.*') ? 'active' : '' }}"><i class="bi bi-person-walking"></i> <span>Facilities</span></a></li>
            <li><a href="{{ route('events.index') }}" class="nav-link text-decoration-none p-3 {{ request()->routeIs('events.*') ? 'active' : '' }}"><i class="bi bi-calendar-event-fill"></i> <span>Events</span></a></li>
        </ul>

    </nav>

    <!-- Toggle button -->
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="bi bi-chevron-left"></i>
    </button>

    <!-- Content Area -->
    <main class="content-area">
        @if (session()->has('admin_last_page'))
            <a href="{{ session('admin_last_page') }}" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        @endif

        @php
            $segments = request()->segments();
        @endphp

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>

                @foreach ($segments as $index => $segment)
                    @if ($index == count($segments) -1)
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ ucwords(Str_replace('-', ' ', $segment)) }}
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="/{{ implode('/', array_slice($segments, 0, $index + 1)) }}">
                                {{ ucwords(Str_replace('-', ' ', $segment)) }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
        @yield('content')
    </main>

</div>

@if (session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <i class="bi bi-exclamation-triangle-fill display-5 text-warning"></i>
                <p class="mt-2 mb-0">Apa kamu yakin ingin menghapus data ini?<br>
                   Tindakan ini tidak dapat dibatalkan.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle-fill"></i> Batalkan
                </button>

                <form id="confirmDeleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash-fill"></i> Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebarMenu');
    sidebar.classList.toggle('collapsed');
}

document.addEventListener("DOMContentLoaded", function() {
    const toastEl = document.getElementById('successToast');

    if (toastEl) {
        const toast = new bootstrap.Toast(toastEl, {
            autohide: true,
            delay: 4000
        });
        toast.show();
    }
});

document.addEventListener("DOMContentLoaded", function() {

    const deleteButtons = document.querySelectorAll(".btn-delete");
    const deleteForm = document.getElementById("confirmDeleteForm");
    const modalEl = document.getElementById("confirmModal");

    // Inisialisasi Bootstrap Modal
    const deleteModal = new bootstrap.Modal(modalEl);

    // Untuk setiap tombol delete
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();

            // Set action form sesuai tombol yang diklik
            const url = btn.getAttribute("data-url");
            deleteForm.setAttribute("action", url);

            // Tampilkan modal
            deleteModal.show();
        });
    });

});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

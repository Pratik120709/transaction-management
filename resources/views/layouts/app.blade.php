<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Transaction Management System')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- font awesome CDN -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
        />

   <style>
    :root {
        --sidebar-gradient: linear-gradient(
            90deg,
            #1A365D 0%,
            #2C7A7B 50%,
            #4FD1C5 100%
        );
    }

    body {
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Sidebar */
    .sidebar {
        width: 260px;
        min-height: 100vh;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
    }

    /* Sidebar links */
    .sidebar .nav-link {
        color: #1f2937;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 6px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    /* Hover state */
    .sidebar .nav-link:hover {
        background: var(--sidebar-gradient);
        color: #ffffff;
    }

    /* Active state */
    .sidebar .nav-link.active {
        background: var(--sidebar-gradient);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Icon color inherit */
    .sidebar .nav-link i {
        transition: color 0.3s ease;
    }

    /* Content */
    .content-wrapper {
        flex: 1;
        background: #f8f9fa;
    }

    /* Mobile Sidebar */
    @media (max-width: 991px) {
        .sidebar {
            position: fixed;
            left: -260px;
            top: 0;
            z-index: 1040;
            transition: all 0.3s ease;
        }

        .sidebar.show {
            left: 0;
        }
    }
</style>

</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar p-3">
        <h5 class="text-white mb-4 text-center">
                <img src="{{ asset('/assets/img/webLogo.png') }}" alt="Logo" style="width:100%; height: 56px; object-fit: cover;">
        </h5>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('transactions') ? 'active' : '' }}"
                href="{{ route('transactions') }}">
                    <i class="bi bi-list-ul me-2"></i> Transactions
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3">
            <button class="btn btn-outline-primary d-lg-none"
                    onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>

            <span class="navbar-brand ms-3">@yield('page-title', 'Dashboard')</span>

            <div class="ms-auto d-flex align-items-center">
                <span class="me-3">
                    <i class="bi bi-person-circle"></i> {{ auth()->user()->name ?? 'Admin' }}
                </span>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="p-4">
            @yield('content')
        </main>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


@stack('scripts')
</body>
</html>

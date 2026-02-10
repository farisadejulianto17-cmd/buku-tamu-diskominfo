<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Buku Tamu Diskominfo</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #2c3e50;
            --sidebar-active: #0072ff;
            --main-bg: #f4f7f6;
            --accent-gradient: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--main-bg);
            margin: 0;
            display: flex;
        }

        /* --- SIDEBAR STYLES --- */
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            color: white;
            position: fixed;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand-text {
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 15px;
            line-height: 1.4;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-menu { padding: 20px 0; }
        .nav-item { padding: 5px 20px; list-style: none; }

        .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 12px;
            transition: 0.3s;
            font-weight: 400;
        }

        .nav-link-custom i { font-size: 1.2rem; margin-right: 15px; }

        .nav-link-custom:hover, .nav-link-custom.active {
            background: var(--accent-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 114, 255, 0.3);
        }

        .menu-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            padding: 20px 20px 10px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        /* --- CONTENT AREA --- */
        .main-content {
            margin-left: 280px; /* Jarak agar tidak tertutup sidebar */
            width: calc(100% - 280px);
            padding: 40px;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .table-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            padding: 25px;
        }

        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .sidebar-brand-text, .nav-link-custom span, .menu-label { display: none; }
            .main-content { margin-left: 80px; width: calc(100% - 80px); }
        }

        @media print {
            .sidebar, .no-print, .top-bar, .btn { display: none !important; }
            .main-content { margin-left: 0 !important; width: 100% !important; padding: 0 !important; }
            body { background: white !important; }
        }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="sidebar-header">
            <div class="d-flex justify-content-center gap-2">
                <img src="{{ asset('img/logo-tegal.png') }}" width="40" alt="Logo">
                <img src="{{ asset('img/logo-kominfo.png') }}" width="40" alt="Logo">
            </div>
            <div class="sidebar-brand-text">
                Diskominfo<br><span style="font-weight: 300; font-size: 0.7rem;">Kabupaten Tegal</span>
            </div>
        </div>

        <div class="nav-menu">
            <div class="menu-label">Main Menu</div>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.data-tamu') }}" class="nav-link-custom {{ request()->routeIs('admin.data-tamu') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> <span>Data Tamu</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.rekap') }}" class="nav-link-custom {{ request()->routeIs('admin.rekap') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>

            <div class="menu-label">Sistem</div>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link-custom border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-power text-danger"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </div>
    </div>

    <main class="main-content">
        @yield('content')  </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
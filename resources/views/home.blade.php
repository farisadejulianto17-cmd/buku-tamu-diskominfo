<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - Diskominfo Kab. Tegal</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link rel="icon" href="{{ asset('img/logo-kominfo.png') }}" type="image/x-icon">

    <style>
        /* --- Background Utama (Langsung di Body) --- */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100vh;
            
            /* Background Biru-Cyan Gradient */
            background: linear-gradient(120deg, #00c6ff 0%, #0072ff 100%);
            
            /* Pattern Overlay Halus */
            background-image: 
                radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(120deg, #00c6ff 0%, #0072ff 100%);
            background-size: 30px 30px, cover;
            
            position: relative;
            overflow-x: hidden;
        }

        /* --- Navbar Styles --- */
        .navbar {
            padding: 1.5rem 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white !important;
        }

        .brand-text h5 {
            font-size: 1rem;
            margin: 0;
            font-weight: 700;
            line-height: 1.2;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .brand-text small {
            font-size: 0.75rem;
            font-weight: 300;
            opacity: 0.9;
        }

        /* --- Custom Hamburger Menu (Garis 3 Putih) --- */
        .navbar-toggler {
            border: none !important; /* Menghapus kotak border */
            padding: 0;
            box-shadow: none !important; /* Menghapus efek glow saat diklik */
        }
        
        .navbar-toggler:focus {
            outline: none;
            box-shadow: none;
        }

        .navbar-toggler-icon {
            width: 35px;
            height: 35px;
            /* Kode SVG ini dimodifikasi agar stroke='white' (garis putih) */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='3' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            transition: transform 0.3s ease;
        }

        /* Efek putar sedikit saat diklik (Opsional) */
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
            transform: rotate(90deg);
        }

        /* Menu Dropdown Admin */
        .admin-menu-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .admin-menu-link:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        /* --- Hero Content --- */
        .hero-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            padding-bottom: 60px;
        }

        .hero-content {
            text-align: center;
            color: white;
            padding: 20px;
        }

        .welcome-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .welcome-subtitle {
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        /* Tombol Utama */
        .btn-main {
            background-color: #ffffff;
            color: #0072ff;
            font-weight: 600;
            padding: 15px 45px;
            border-radius: 50px;
            font-size: 1.1rem;
            border: none;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            background-color: #f8f9fa;
            color: #0056b3;
        }

        /* --- Animasi --- */
        .animate-fade-up {
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
        }
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Wave Bottom */
        .wave-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            z-index: 1;
        }
        
        @media (max-width: 768px) {
            .welcome-title { font-size: 2.2rem; }
            .brand-text { display: none; } 
        }
    </style>
</head>
<body>

    <nav class="navbar fixed-top">
        <div class="container">
            
            <a class="navbar-brand" href="#">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('img/logo-tegal.png') }}" alt="Logo Kab Tegal" width="45">
                    <img src="{{ asset('img/logo-kominfo.png') }}" alt="Logo Kominfo" width="45">
                </div>
                <div class="brand-text ms-2 d-none d-md-block">
                    <h5>Dinas Komunikasi dan Informatika<br>Kabupaten Tegal</h5>
                </div>
            </a>

            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse mt-3 text-end" id="navbarContent">
    <div class="p-3 bg-primary bg-opacity-10 rounded border border-white border-opacity-25" style="backdrop-filter: blur(5px);">
        <span class="text-white d-block mb-2 small">Menu Admin</span>
        @auth
            <a href="{{ route('login') }}" class="admin-menu-link">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
            </a>
        @else
            <a href="{{ route('login') }}" class="admin-menu-link">
                <i class="bi bi-box-arrow-in-right me-2"></i> Login Administator
            </a>
        @endauth
    </div>
</div>

        </div>
    </nav>

    <div class="hero-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 hero-content">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show w-75 mx-auto mb-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h1 class="welcome-title animate-fade-up">Selamat Datang</h1>
                    <h4 class="welcome-subtitle animate-fade-up delay-1">
                        Sistem Buku Tamu Digital Terpadu<br>
                        Dinas Komunikasi dan Informatika Kabupaten Tegal
                    </h4>
                    
                    <div class="animate-fade-up delay-2 mt-4">
                        <a href="{{ route('tamu.create') }}" class="btn-main">
                            <i class="bi bi-pencil-fill me-2"></i> ISI KEHADIRAN BUKU TAMU
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="wave-bottom">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 80px;">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" style="fill: #ffffff; opacity:0.2"></path>
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" style="fill: #ffffff; opacity:0.1"></path>
        </svg>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
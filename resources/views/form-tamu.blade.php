<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Data Tamu - Diskominfo Kab. Tegal</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link rel="icon" href="{{ asset('img/logo-kominfo.png') }}" type="image/x-icon">

    <style>
        /* Menggunakan Background yang sama dengan Home */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #00c6ff 0%, #0072ff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }

        /* Navbar Sederhana (Tanpa Menu Login) */
        .navbar {
            padding: 1rem 0;
            z-index: 10;
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
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .brand-text small {
            font-size: 0.75rem;
            font-weight: 300;
            opacity: 0.9;
        }

        /* Container Tengah */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            z-index: 2; /* Di atas wave */
        }

        /* Styling Card Form */
        .form-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            border: none;
            overflow: hidden;
            width: 100%;
            max-width: 600px;
        }

        .form-header {
            background: #f8f9fa;
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .form-header h4 {
            color: #0072ff;
            font-weight: 700;
            margin: 0;
        }

        .form-body {
            padding: 40px;
        }

        /* Styling Input Fields */
        .form-label {
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }

        .input-group-text {
            background: #f1f5f9;
            border: 1px solid #ced4da;
            border-right: none;
            color: #0072ff;
        }

        .form-control {
            border-left: none;
            padding: 12px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: #0072ff;
        }

        /* Tombol */
        .btn-submit {
            background: linear-gradient(90deg, #0072ff 0%, #00c6ff 100%);
            border: none;
            color: white;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 114, 255, 0.4);
            color: white;
        }

        .btn-back {
            background: transparent;
            border: 2px solid #e0e0e0;
            color: #666;
            padding: 10px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: #f8f9fa;
            border-color: #ccc;
            color: #333;
        }

        /* Animasi Masuk */
        .animate-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Wave Bottom */
        .wave-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1;
            line-height: 0;
        }

        /* Mobile Responsive */
        @media (max-width: 576px) {
            .form-body { padding: 25px; }
            .brand-text { display: none; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('img/logo-tegal.png') }}" alt="Logo Kab Tegal" width="45">
                    <img src="{{ asset('img/logo-kominfo.png') }}" alt="Logo Kominfo" width="45">
                </div>
                <div class="brand-text ms-2">
                    <h5>Dinas Komunikasi dan Informatika<br>Kabupaten Tegal</h5>
                </div>
            </a>
            </div>
    </nav>

    <div class="main-content">
        
        <div class="form-card animate-up">
            <div class="form-header">
                <h4><i class="bi bi-person-lines-fill me-2"></i> Isi Data Tamu</h4>
                <p class="text-muted small mb-0 mt-1">Silakan lengkapi form di bawah ini</p>
            </div>
            
            <div class="form-body">
                <form action="{{ route('tamu.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap Anda">
                            @error('nama')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="instansi" class="form-label">Instansi / Asal</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                            <input type="text" class="form-control @error('instansi') is-invalid @enderror" id="instansi" name="instansi" value="{{ old('instansi') }}" placeholder="Contoh: Bappeda / Umum / Mahasiswa">
                            @error('instansi')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="no_hp" class="form-label">Nomor WhatsApp / HP</label>
                        <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                            <input type="number" 
                                class="form-control @error('no_hp') is-invalid @enderror" 
                                id="no_hp" 
                                name="no_hp" 
                                value="{{ old('no_hp') }}" 
                                placeholder="Contoh: 081234567890">
                            @error('no_hp')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="kebutuhan" class="form-label">Keperluan / Tujuan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-chat-text-fill"></i></span>
                            <textarea class="form-control @error('kebutuhan') is-invalid @enderror" id="kebutuhan" name="kebutuhan" rows="3" placeholder="Jelaskan tujuan anda">{{ old('kebutuhan') }}</textarea>
                            @error('kebutuhan')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-submit btn-lg shadow-sm">
                            <i class="bi bi-send-fill me-2"></i> Simpan Kehadiran
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-back text-center text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Utama
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="wave-bottom">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="display: block; width: 100%; height: 60px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" style="fill: #ffffff; opacity:0.2"></path>
        </svg>
    </div>

</body>
</html>
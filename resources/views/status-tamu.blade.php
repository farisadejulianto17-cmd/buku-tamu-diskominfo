<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Kunjungan - Diskominfo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .status-card {
            background: #ffffff;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 800px; /* Lebar maksimal diperbesar untuk landscape */
            overflow: hidden;
            display: flex;
            flex-wrap: wrap; /* Agar responsif di HP */
        }

        /* Bagian Kiri (QR) */
        .card-left {
            background: #f8faff;
            padding: 40px;
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-right: 2px dashed #e0e0e0;
            position: relative;
        }

        /* Bagian Kanan (Info) */
        .card-right {
            padding: 40px;
            flex: 1.5;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .qr-wrapper {
            background: white;
            padding: 15px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,114,255,0.1);
            border: 2px solid #0072ff;
            margin-bottom: 20px;
        }

        .status-badge {
            background: #d4edda;
            color: #155724;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }

        .info-label {
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 15px;
        }

        .visitor-id {
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            color: #0072ff;
            background: #eef5ff;
            padding: 2px 8px;
            border-radius: 5px;
        }

        /* Ornamen Lingkaran Tiket (Opsional) */
        .card-left::before, .card-left::after {
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            background: #1e3c72; /* Warna body */
            border-radius: 50%;
            right: -15px;
        }
        .card-left::before { top: -15px; }
        .card-left::after { bottom: -15px; }

        @media (max-width: 768px) {
            .card-left { border-right: none; border-bottom: 2px dashed #e0e0e0; }
            .card-left::before, .card-left::after { display: none; }
        }
    </style>
</head>
<body>

    <div class="status-card">
        <div class="card-left text-center">
            <div class="status-badge">
                <i class="bi bi-circle-fill me-1 small"></i> Kunjungan Aktif
            </div>
            <div class="qr-wrapper">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ route('admin.tamu.verifikasi', $tamu->unique_id) }}" alt="QR Code Checkout">
            </div>
            <p class="small text-muted mb-0">Tunjukkan QR ini ke petugas</p>
            <p class="visitor-id mt-2">#{{ $tamu->unique_id }}</p>
        </div>

        <div class="card-right">
            <div class="mb-4">
                <h4 class="fw-bold mb-1">E-Pass Pengunjung</h4>
                <p class="text-muted small">Diskominfo Kab. Tegal</p>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value">{{ $tamu->nama }}</div>
                </div>
                <div class="col-6">
                    <div class="info-label">Instansi</div>
                    <div class="info-value">{{ $tamu->instansi }}</div>
                </div>
                <div class="col-6">
                    <div class="info-label">Jam Masuk</div>
                    <div class="info-value text-primary">{{ $tamu->created_at->format('H:i') }} WIB</div>
                </div>
                <div class="col-12">
                    <div class="info-label">Keperluan</div>
                    <div class="info-value" style="font-size: 0.95rem;">{{ $tamu->kebutuhan }}</div>
                </div>
            </div>

            <hr class="my-3 opacity-10">

            <div class="text-center">
                <p class="small text-muted mb-1">Lupa scan QR saat pulang?</p>
                <a href="{{ route('tamu.checkout', $tamu->unique_id) }}" 
                   class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"
                   onclick="return confirm('Konfirmasi Checkout Mandiri?')">
                    <i class="bi bi-box-arrow-right me-1"></i> Checkout Mandiri
                </a>
            </div>
        </div>
    </div>

</body>
</html>
@extends('layouts.admin')

@section('title', 'Data Tamu Hari Ini')

<style>
    @media print {
        /* Sembunyikan elemen UI Dashboard agar tidak ikut tercetak */
        .no-print, .btn-export, .user-profile, .gap-1, form, .bi-pencil-square, .d-print-none, .search-container, .top-bar {
            display: none !important;
        }
        
        /* Pengaturan Tabel Cetak agar rapi */
        .table-responsive { overflow: visible !important; }
        table { width: 100% !important; border-collapse: collapse !important; margin-top: 10px; }
        table th, table td { border: 1px solid #000 !important; color: #000 !important; padding: 8px; font-size: 10pt; }
        .table-light { background-color: transparent !important; }
        
        /* Sembunyikan kolom Aksi saat cetak */
        th:last-child, td:last-child { display: none !important; }

        /* TAMPILAN KOP SURAT (Hanya saat cetak) */
        .print-kop-surat {
            display: flex !important;
            align-items: center;
            justify-content: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 10px;
        }
        .kop-logo {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }
        .kop-text {
            text-align: center;
        }
        .kop-text h4 { margin: 0; font-size: 14pt; font-weight: bold; }
        .kop-text h2 { margin: 0; font-size: 18pt; font-weight: bold; text-transform: uppercase; }
        .kop-text p { margin: 0; font-size: 9pt; }

        /* Tanggal di bawah kop */
        .print-tanggal-laporan {
            display: block !important;
            text-align: right;
            font-size: 10pt;
            margin-bottom: 20px;
            margin-top: 10px;
        }
        .print-judul {
            display: block !important;
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 5px;
            font-size: 12pt;
        }
    }

    /* Sembunyikan elemen cetak di layar browser biasa */
    .print-kop-surat, .print-tanggal-laporan, .print-judul {
        display: none;
    }
    
    .search-container { max-width: 400px; }
    .pulse { animation: pulse-animation 2s infinite; }
    @keyframes pulse-animation {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
</style>

@section('content')
    <div class="print-kop-surat">
        <img src="/img/logo-kominfo.png" class="kop-logo">
        <div class="kop-text">
            <h4>PEMERINTAH KABUPATEN TEGAL</h4>
            <h2>DINAS KOMUNIKASI DAN INFORMATIKA</h2>
            <p>Jl. DR. Soetomo No.1, Dukuh Ringin, Dukuhwringin, Kec. Slawi, Kabupaten Tegal, Jawa Tengah.</p>
            <p>Email: diskominfo@tegalkab.go.id | Website: diskominfo.tegalkab.go.id</p>
        </div>
    </div>

    <div class="print-judul">LAPORAN DATA KUNJUNGAN TAMU HARIAN</div>
    
    <div class="print-tanggal-laporan">
        Tanggal Cetak: <strong>{{ now()->translatedFormat('d F Y') }}</strong>
    </div>

    <div class="top-bar no-print">
        <div>
            <h3 class="fw-bold mb-0">Data Kunjungan Harian</h3>
            <p class="text-muted small">Tanggal : <strong>{{ now()->translatedFormat('d F Y') }}</strong></p>
        </div>
        <div class="user-profile">
            <i class="bi bi-person-circle fs-4 text-primary"></i>
            <div class="text-end">
                <div class="fw-bold" style="font-size: 0.85rem;">Admin Kominfo</div>
                <div class="text-success small" style="font-size: 0.7rem;">● Online</div>
            </div>
        </div>
    </div>

    <div class="table-card mt-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h5 class="fw-bold m-0"><i class="bi bi-table me-2 text-primary"></i>Daftar Tamu Hari Ini</h5>
            
            <div class="search-container no-print">
                <form action="{{ route('admin.data-tamu') }}" method="GET" class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama/instansi..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.data-tamu') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </form>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-export shadow-sm no-print" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Cetak Daftar
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">Identitas Tamu</th>
                        <th>No. WhatsApp</th>
                        <th>Keperluan</th>
                        <th class="text-center">Waktu Datang</th>
                        <th class="text-center">Waktu Keluar</th>
                        <th class="text-center no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tamus as $tamu)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $tamu->nama }}</div>
                            <div class="text-muted small">{{ $tamu->instansi }}</div>
                        </td>
                        <td>
                            @if($tamu->no_hp)
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $tamu->no_hp);
                                    if (strpos($cleanPhone, '0') === 0) { $cleanPhone = '62' . substr($cleanPhone, 1); }
                                @endphp
                                <a href="https://api.whatsapp.com/send?phone={{ $cleanPhone }}" target="_blank" class="btn btn-sm btn-outline-success border-0 fw-bold d-print-none">
                                    <i class="bi bi-whatsapp me-1"></i> {{ $tamu->no_hp }}
                                </a>
                                <span class="d-none d-print-block text-dark">{{ $tamu->no_hp }}</span>
                            @else
                                <span class="text-muted small">Tidak ada nomor</span>
                            @endif
                        </td>
                        <td style="max-width: 200px;" class="small text-truncate" title="{{ $tamu->kebutuhan }}">
                            {{ $tamu->kebutuhan }}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary-subtle text-primary border d-print-none">{{ $tamu->created_at->format('H:i') }}</span>
                            <span class="d-none d-print-block text-dark">{{ $tamu->created_at->format('H:i') }}</span>
                        </td>
                        <td class="text-center">
                            @if($tamu->waktu_keluar)
                                <span class="badge bg-info-subtle text-info border d-print-none">
                                    {{ \Carbon\Carbon::parse($tamu->waktu_keluar)->format('H:i') }}
                                </span>
                                <span class="d-none d-print-block text-dark">
                                    {{ \Carbon\Carbon::parse($tamu->waktu_keluar)->format('H:i') }}
                                </span>
                            @else
                                <div class="d-print-none">
                                    <form action="{{ route('admin.tamu.manualCheckout', $tamu->unique_id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-warning fw-bold shadow-sm" onclick="return confirm('Tamu sudah keluar?')">
                                            <i class="bi bi-box-arrow-right"></i> Check-out
                                        </button>
                                    </form>
                                </div>
                                <span class="text-warning small fw-bold italic d-print-none">
                                    <i class="bi bi-clock pulse"></i> Aktif
                                </span>
                                <span class="d-none d-print-block text-muted">Belum Keluar</span>
                            @endif
                        </td>
                        <td class="text-center no-print">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.tamu.edit', $tamu->unique_id) }}" class="btn btn-outline-warning btn-sm border-0">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('tamu.destroy', $tamu->unique_id) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm border-0"><i class="bi bi-trash3"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada data tamu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@extends('layouts.admin')

@section('title', 'Rekapitulasi Laporan')

<style>
    /* CSS Khusus Tampilan Layar */
    .table-card {
        background: #fff;
        border-radius: 15px;
    }

    /* CSS Khusus Saat Dicetak (Printer) */
    @media print {
        .no-print, .top-bar, .btn, form, nav {
            display: none !important;
        }

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

        /* PAKSA NOMOR HP JADI TEKS BIASA */
        .wa-link-report, 
        table a.wa-link-report, 
        table td a {
            color: #000 !important;
            text-decoration: none !important;
            background: none !important;
            pointer-events: none !important;
            font-weight: normal !important;
        }

        /* SEMBUNYIKAN IKON WA SAAT PRINT */
        .wa-link-report i, 
        table td i.bi-whatsapp {
            display: none !important;
        }

        .printable-area {
            position: static !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
            border: none !important;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #000 !important;
        }

        table {
            font-size: 10pt;
            width: 100% !important;
            border-collapse: collapse !important;
        }

        .table-light {
            background-color: #f8f9fa !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }

    /* Sembunyikan Kop di Layar Biasa */
    .print-kop-surat {
        display: none;
    }
</style>

@section('content')
<div class="no-print">
    <div class="top-bar">
        <div>
            <h3 class="fw-bold mb-0">Rekapitulasi Laporan</h3>
            <p class="text-muted small">Filter dan cetak riwayat kunjungan tamu</p>
        </div>
        <div class="user-profile">
            <i class="bi bi-person-circle fs-4 text-primary"></i>
            <div class="text-end">
                <div class="fw-bold" style="font-size: 0.85rem;">Admin Kominfo</div>
                <div class="text-success small" style="font-size: 0.7rem;">● Online</div>
            </div>
        </div>
    </div>

    <div class="table-card mb-4 shadow-sm p-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-filter-left me-2 text-primary"></i>Filter Periode</h5>
        <form action="{{ route('admin.rekap') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label small fw-bold">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" required>
            </div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Tampilkan
                </button>
                <button type="button" onclick="window.print()" class="btn btn-success">
                    <i class="bi bi-printer me-1"></i> Cetak
                </button>
            </div>
        </form>
    </div>
</div>

<div class="table-card p-4 shadow-sm printable-area">
    <div class="print-kop-surat">
        <img src="/img/logo-kominfo.png" class="kop-logo">
        <div class="kop-text">
            <h4>PEMERINTAH KABUPATEN TEGAL</h4>
            <h2>DINAS KOMUNIKASI DAN INFORMATIKA</h2>
            <p>Jl. DR. Soetomo No.1, Dukuh Ringin, Dukuhwringin, Kec. Slawi, Kabupaten Tegal, Jawa Tengah.</p>
            <p>Email: diskominfo@tegalkab.go.id | Website: diskominfo.tegalkab.go.id</p>
        </div>
    </div>

    <div class="text-center mb-4 pb-3">
        <h4 class="fw-bold mb-0">LAPORAN KUNJUNGAN TAMU</h4>
        @if(request('start_date') && request('end_date'))
            <p class="mb-0 mt-2">Periode: <strong>{{ \Carbon\Carbon::parse(request('start_date'))->translatedFormat('d F Y') }}</strong> s/d <strong>{{ \Carbon\Carbon::parse(request('end_date'))->translatedFormat('d F Y') }}</strong></p>
        @else
            <p class="mb-0 mt-2 text-muted small italic">Menampilkan seluruh data riwayat kunjungan</p>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th width="50">No</th>
                    <th width="120">Tanggal</th>
                    <th>Nama & Instansi</th>
                    <th>No. HP</th>
                    <th>Keperluan</th>
                    <th width="80">Masuk</th>
                    <th width="80">Keluar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tamus as $key => $tamu)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $tamu->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="fw-bold">{{ $tamu->nama }}</div>
                        <div class="text-muted small">{{ $tamu->instansi }}</div>
                    </td>
                    <td class="text-center">
                        @if($tamu->no_hp)
                            @php
                                $cleanPhone = preg_replace('/[^0-9]/', '', $tamu->no_hp);
                                if (str_starts_with($cleanPhone, '0')) {
                                    $cleanPhone = '62' . substr($cleanPhone, 1);
                                }
                            @endphp
                            <a href="https://api.whatsapp.com/send?phone={{ $cleanPhone }}&text=Halo%20{{ urlencode($tamu->nama) }},%20kami%20dari%20Kominfo." 
                                target="_blank" 
                                class="wa-link-report text-success text-decoration-none fw-bold">
                                <i class="bi bi-whatsapp"></i> {{ $tamu->no_hp }}
                            </a>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                    <td class="small">{{ $tamu->kebutuhan }}</td>
                    <td class="text-center">{{ $tamu->created_at->format('H:i') }}</td>
                    <td class="text-center">
                        {{ $tamu->waktu_keluar ? \Carbon\Carbon::parse($tamu->waktu_keluar)->format('H:i') : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">Data tidak ditemukan untuk periode ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-none d-print-block mt-5">
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p class="mb-5">Slawi, {{ now()->translatedFormat('d F Y') }}<br>Administrator,</p>
                <br><br>
                <p class="fw-bold border-top pt-2">(............................................)</p>
            </div>
        </div>
    </div>
</div>
@endsection
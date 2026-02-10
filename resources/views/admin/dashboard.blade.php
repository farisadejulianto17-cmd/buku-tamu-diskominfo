@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="top-bar">
    <div>
        <h3 class="fw-bold mb-0">Dashboard Kunjunga</h3>
        <p class="text-muted small">Ringkasan data buku tamu Diskominfo</p>
    </div>
    <div class="user-profile">
        <i class="bi bi-person-circle fs-4 text-primary"></i>
        <div class="text-end">
            <div class="fw-bold" style="font-size: 0.85rem;">Admin Kominfo</div>
            <div class="text-success small" style="font-size: 0.7rem;">● Online</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="table-card p-4 shadow-sm border-0 h-100" style="border-left: 5px solid #0072ff !important;">
            <div class="text-muted small fw-bold text-uppercase mb-2">Hari Ini</div>
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="fw-bold mb-0">{{ $stats['hari_ini'] }}</h2>
                <i class="bi bi-person-check fs-1 text-primary opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="table-card p-4 shadow-sm border-0 h-100" style="border-left: 5px solid #27ae60 !important;">
            <div class="text-muted small fw-bold text-uppercase mb-2">Bulan Ini</div>
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="fw-bold mb-0">{{ $stats['bulan_ini'] }}</h2>
                <i class="bi bi-calendar-month fs-1 text-success opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="table-card p-4 shadow-sm border-0 h-100" style="border-left: 5px solid #f39c12 !important;">
            <div class="text-muted small fw-bold text-uppercase mb-2">Tahun Ini</div>
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="fw-bold mb-0">{{ $stats['tahun_ini'] }}</h2>
                <i class="bi bi-graph-up-arrow fs-1 text-warning opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="table-card p-4 shadow-sm border-0 h-100" style="border-left: 5px solid #2c3e50 !important;">
            <div class="text-muted small fw-bold text-uppercase mb-2">Total Tamu</div>
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="fw-bold mb-0">{{ $stats['total'] }}</h2>
                <i class="bi bi-database fs-1 text-dark opacity-25"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
    <div class="table-card p-4 h-100 shadow-sm">
        <h5 class="fw-bold mb-4"><i class="bi bi-bar-chart-line me-2 text-primary"></i>Statistik Kunjungan</h5>
        <div style="height: 300px; width: 100%;"> {{-- Hapus background f8f9fa dan border dashed --}}
            <canvas id="kunjunganChart"></canvas>
        </div>
    </div>
</div>
    <div class="col-md-4">
        <div class="table-card p-4 h-100 shadow-sm">
            <h5 class="fw-bold mb-4"><i class="bi bi-info-circle me-2 text-primary"></i>Status Sistem</h5>
            <div class="mb-3">
                <label class="small text-muted d-block mb-1">Penyimpanan Database</label>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" style="width: 45%"></div>
                </div>
            </div>
            <hr>
            <div class="small">
                <div class="d-flex justify-content-between mb-2">
                    <span>Waktu Server</span>
                    <span class="fw-bold text-dark">{{ now()->format('H:i') }} WIB</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Tanggal</span>
                    <span class="fw-bold text-dark">{{ now()->translatedFormat('d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gunakan DOMContentLoaded agar script berjalan setelah HTML siap
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('kunjunganChart');
        if(!canvas) return;

        const ctx = canvas.getContext('2d');
        
        // Gradient Warna Biru
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(0, 114, 255, 0.4)');
        gradient.addColorStop(1, 'rgba(0, 114, 255, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($grafik['labels']) !!},
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: {!! json_encode($grafik['data']) !!},
                    borderColor: '#0072ff',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#0072ff',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        },
                        ticks: { 
                            stepSize: 1,
                            precision: 0 // Menghindari angka desimal di sumbu Y
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>

@endsection

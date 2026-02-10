@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold mb-4">Verifikasi Scan QR</h4>
                    
                    <div class="mb-4">
                        <i class="bi bi-person-check text-primary" style="font-size: 60px;"></i>
                        <h3 class="mb-0">{{ $tamu->nama }}</h3>
                        <p class="badge bg-secondary">{{ $tamu->unique_id }}</p>
                    </div>

                    <div class="card bg-light border-0 rounded-3 mb-4">
                        <div class="card-body text-start">
                            <div class="row mb-2">
                                <div class="col-5 text-muted small">Nama Pengunjung</div>
                                <div class="col-7 fw-bold">{{ $tamu->nama }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 text-muted small">No. Handphone</div>
                                <div class="col-7 fw-bold text-primary">
                                    {{ $tamu->no_hp ?? 'Tidak Ada Data' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 text-muted small">Asal Instansi</div>
                                <div class="col-7 fw-bold">{{ $tamu->instansi }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 text-muted small">Keperluan</div>
                                <div class="col-7"><em>{{ $tamu->kebutuhan }}</em></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5 text-muted small">Jam Masuk</div>
                                <div class="col-7 fw-bold">{{ $tamu->created_at->format('H:i') }} WIB</div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.tamu.konfirmasi', $tamu->unique_id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm">
                            <i class="bi bi-box-arrow-right me-2"></i> KONFIRMASI TAMU KELUAR
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.data-tamu') }}" class="btn btn-link text-muted w-100 mt-2 text-decoration-none">
                        <i class="bi bi-x-circle me-1"></i> Batal / Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
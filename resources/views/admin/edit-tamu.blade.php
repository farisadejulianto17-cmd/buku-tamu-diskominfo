@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Edit Data Tamu</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.tamu.update', $tamu->unique_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="{{ $tamu->nama }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $tamu->no_hp }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Instansi</label>
                    <input type="text" name="instansi" class="form-control" value="{{ $tamu->instansi }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keperluan</label>
                    <textarea name="kebutuhan" class="form-control" rows="3" required>{{ $tamu->kebutuhan }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    <a href="{{ route('admin.data-tamu') }}" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
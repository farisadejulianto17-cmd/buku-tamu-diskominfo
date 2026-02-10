<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(120deg, #00c6ff 0%, #0072ff 100%); 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
        }
        .card { 
            border-radius: 15px; 
            border: none; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); 
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <h4>Login Admin</h4>
                    <small class="text-muted">Silahkan masukan email dan password login</small>
                </div>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- PERBAIKAN: Meletakkan blok error di dalam form dengan urutan yang benar --}}
                    @if ($errors->any())
                        <div class="alert alert-danger p-2">
                            <small>{{ $errors->first() }}</small>
                        </div>
                    @endif
                    
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">Masuk</button>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100">Bukan Admin? Kembali</a>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
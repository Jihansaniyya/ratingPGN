@extends('layouts.app')

@section('title', 'Edit Data Petugas')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-user-edit"></i>
        Formulir Perubahan Data Petugas
    </h1>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-user-cog me-2"></i> Informasi Data Petugas
            </div>
            <div class="card-body p-4">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap petugas" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $user->email) }}" placeholder="Masukkan alamat email resmi" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <p class="text-muted mb-3"><small><i class="fas fa-info-circle me-1"></i> Bagian berikut hanya diisi jika ingin mengubah kata sandi.</small></p>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Kata Sandi Baru</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Masukkan kata sandi baru (opsional)">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Biarkan kosong apabila tidak ingin mengubah kata sandi.</small>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                               placeholder="Ketik ulang kata sandi baru">
                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan Data
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted text-center small">
                <i class="fas fa-shield-alt me-1"></i> Data yang dimasukkan akan tersimpan dengan aman.
            </div>
        </div>
    </div>
</div>
@endsection

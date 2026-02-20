@extends('layouts.app')

@section('title', 'Tambah Petugas')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-user-plus"></i>
        Tambah Petugas Baru
    </h1>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user-cog me-2"></i> Form Tambah Petugas
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan, mohon perbaiki:</h6>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" placeholder="Masukkan alamat email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Minimal 8 karakter, huruf kapital & simbol" required style="padding-right: 40px;">
                            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted pe-3" 
                                    onclick="togglePassword('password', this)" style="z-index: 5; text-decoration: none;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal 8 karakter, harus ada huruf kapital dan simbol (!@#$%^&* dll)</small>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                                   placeholder="Ulangi password" required style="padding-right: 40px;">
                            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted pe-3" 
                                    onclick="togglePassword('password_confirmation', this)" style="z-index: 5; text-decoration: none;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Simpan Petugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endpush

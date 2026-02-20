@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-key"></i>
        Ubah Password
    </h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-lock me-2"></i>Formulir Ubah Password
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Password Saat Ini <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password" name="current_password" id="current_password" class="form-control" required style="padding-right: 40px;">
                            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted pe-3"
                                    onclick="togglePassword('current_password', this)" style="z-index: 5; text-decoration: none;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control" required style="padding-right: 40px;">
                            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted pe-3"
                                    onclick="togglePassword('password', this)" style="z-index: 5; text-decoration: none;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="text-muted">Minimal 8 karakter, harus ada huruf kapital dan simbol (!@#$%^&* dll)</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required style="padding-right: 40px;">
                            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted pe-3"
                                    onclick="togglePassword('password_confirmation', this)" style="z-index: 5; text-decoration: none;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Password
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
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

@extends('layouts.app')

@section('title', 'Daftar Petugas')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-users"></i>
        Daftar Petugas
    </h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Petugas
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form action="{{ route('users.index') }}" method="GET" class="row align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari nama atau email petugas..." value="{{ request('search') }}">
                    <button class="btn btn-sm btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Dibuat</th>
                        <th class="text-center" style="min-width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td>
                            <strong>{{ $user->name }}</strong>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-secondary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-secondary" title="Hapus" 
                                        onclick="confirmDelete({{ $user->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-users fa-4x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Belum ada data petugas</h5>
                            <a href="{{ route('users.create') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-plus me-2"></i> Tambah Petugas Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} data
            </div>
            {{ $users->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus akun petugas ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush

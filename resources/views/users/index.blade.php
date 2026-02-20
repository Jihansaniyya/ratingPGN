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
        <div class="table-responsive" style="overflow: visible;">
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
                            <div class="dropdown">
                                <button class="btn btn-link text-secondary p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-lg"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('users.edit', $user) }}">
                                            <i class="fas fa-edit me-2 text-primary"></i> Edit
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <button class="dropdown-item text-danger" onclick="confirmDelete({{ $user->id }})">
                                            <i class="fas fa-trash me-2"></i> Hapus
                                        </button>
                                    </li>
                                </ul>
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
        Swal.fire({
            title: 'Hapus Petugas?',
            text: 'Data petugas yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash me-1"></i> Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush

@extends('layouts.app')

@section('title', 'Data Formulir Pelanggan')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-clipboard-list"></i>
        Data Formulir Pelanggan
    </h1>
    <div class="d-flex gap-2">
        <a href="{{ route('reports.print', request()->query()) }}" target="_blank" class="btn btn-outline-secondary">
            <i class="fas fa-print me-1"></i> Cetak Laporan
        </a>
        <a href="{{ route('forms.create') }}" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i> Buat Formulir Baru
        </a>
    </div>
</div>

<!-- Statistik Ringkas -->
<div class="row mb-4 g-3">
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 bg-light h-100">
            <div class="card-body d-flex align-items-center py-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; background: rgba(0,0,0,0.05);">
                    <i class="fas fa-file-alt text-secondary"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">{{ $stats['total'] ?? $forms->total() }}</h4>
                    <small class="text-muted">Total Formulir</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 bg-light h-100">
            <div class="card-body d-flex align-items-center py-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; background: rgba(40, 167, 69, 0.1);">
                    <i class="fas fa-smile-beam text-success"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">{{ $stats['sangat_puas'] ?? 0 }}</h4>
                    <small class="text-muted">Sangat Puas</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 bg-light h-100">
            <div class="card-body d-flex align-items-center py-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; background: rgba(255, 193, 7, 0.1);">
                    <i class="fas fa-meh text-warning"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">{{ $stats['puas'] ?? 0 }}</h4>
                    <small class="text-muted">Puas</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 bg-light h-100">
            <div class="card-body d-flex align-items-center py-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; background: rgba(220, 53, 69, 0.1);">
                    <i class="fas fa-frown text-danger"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">{{ $stats['tidak_puas'] ?? 0 }}</h4>
                    <small class="text-muted">Tidak Puas</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter & Tabel Data -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom">
        <form method="GET" action="{{ route('forms.index') }}" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari nama pelanggan..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="d-flex gap-2 justify-content-end">
                    <select name="filter" class="form-select form-select-sm" style="width: 140px;">
                        <option value="">Semua Penilaian</option>
                        <option value="tidak_puas" {{ request('filter') == 'tidak_puas' ? 'selected' : '' }}>Tidak Puas</option>
                        <option value="puas" {{ request('filter') == 'puas' ? 'selected' : '' }}>Puas</option>
                        <option value="sangat_puas" {{ request('filter') == 'sangat_puas' ? 'selected' : '' }}>Sangat Puas</option>
                    </select>
                    <input type="date" name="start_date" class="form-control form-control-sm" 
                           value="{{ request('start_date') }}" title="Tanggal Mulai" style="width: 140px;">
                    <input type="date" name="end_date" class="form-control form-control-sm" 
                           value="{{ request('end_date') }}" title="Tanggal Akhir" style="width: 140px;">
                    @if(request('filter') || request('search') || request('start_date') || request('end_date'))
                        <a href="{{ route('forms.index') }}" class="btn btn-sm btn-outline-secondary" title="Atur Ulang">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        @if(request('filter') || request('start_date') || request('end_date'))
            <div class="bg-light border-bottom px-3 py-2 small">
                <i class="fas fa-filter me-2 text-secondary"></i>
                Penyaringan:
                @if(request('filter'))
                    <span class="badge bg-secondary me-1">
                        @if(request('filter') == 'tidak_puas') Tidak Puas
                        @elseif(request('filter') == 'puas') Puas
                        @else Sangat Puas
                        @endif
                    </span>
                @endif
                @if(request('start_date'))
                    <span class="badge bg-secondary me-1">Mulai: {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }}</span>
                @endif
                @if(request('end_date'))
                    <span class="badge bg-secondary">Sampai: {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}</span>
                @endif
            </div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No.</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th class="text-center">Penilaian</th>
                        <th>Petugas</th>
                        <th>Tanggal</th>
                        <th class="text-center" style="width: 150px;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($forms as $index => $form)
                    <tr>
                        <td class="text-center text-muted">{{ $forms->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold">{{ $form->customer->customer_name }}</div>
                            <small class="text-muted">{{ $form->customer->email }}</small>
                        </td>
                        <td>
                            <div>{{ $form->customer->layanan_service }}</div>
                            <small class="text-muted">{{ $form->customer->kapasitas_capacity }}</small>
                        </td>
                        <td class="text-center">
                            @if($form->assessment == 'sangat_puas')
                                <span class="badge bg-success bg-opacity-75">Sangat Puas</span>
                            @elseif($form->assessment == 'puas')
                                <span class="badge bg-warning bg-opacity-75 text-dark">Puas</span>
                            @else
                                <span class="badge bg-danger bg-opacity-75">Tidak Puas</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ $form->user->name ?? '-' }}</small>
                        </td>
                        <td>
                            <small>{{ $form->form_date ? $form->form_date->format('d/m/Y') : $form->created_at->format('d/m/Y') }}</small>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('forms.show', $form) }}" class="btn btn-outline-secondary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('forms.pdf', $form) }}" class="btn btn-outline-secondary" title="PDF" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @if($form->user_id == auth()->id())
                                <a href="{{ route('forms.edit', $form) }}" class="btn btn-outline-secondary" title="Ubah">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                                @if(auth()->user()->isAdmin())
                                <button type="button" class="btn btn-outline-secondary" title="Hapus" 
                                        onclick="confirmDelete({{ $form->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                            <form id="delete-form-{{ $form->id }}" action="{{ route('forms.destroy', $form) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-3">Belum ada data formulir</p>
                            <a href="{{ route('forms.create') }}" class="btn btn-dark btn-sm">
                                <i class="fas fa-plus me-1"></i> Buat Formulir Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($forms->hasPages())
    <div class="card-footer bg-white border-top">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Menampilkan {{ $forms->firstItem() ?? 0 }} - {{ $forms->lastItem() ?? 0 }} dari {{ $forms->total() }} data
            </small>
            {{ $forms->withQueryString()->links() }}
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus formulir ini? Data yang dihapus tidak dapat dikembalikan.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush

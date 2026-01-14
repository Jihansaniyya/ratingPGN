@extends('layouts.app')

@section('title', 'Laporan Penilaian Pelanggan')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-chart-bar"></i>
        Laporan Penilaian Kepuasan Pelanggan
    </h1>
    <div class="col-auto text-end">
                <div class="bg-white bg-opacity-10 rounded px-3 py-2">
                    <p class="text-black mb-1"><i class="fas fa-calendar-alt me-2"></i>{{ now()->translatedFormat('d F Y') }}</p>
                    <p class="text-black-50 mb-0 small">Penanggung Jawab: {{ auth()->user()->name }}</p>
                </div>
    </div>
</div>

<!-- Filter Section -->
<div class="card shadow-sm mb-4 border-0">
    <div class="card-header bg-white" style="border-left: 4px solid #1a5276;">
        <h5 class="mb-0 text-dark"><i class="fas fa-filter me-2" style="color: #1a5276;"></i> Kriteria Penyaringan Data</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('reports.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-3 col-md-6">
                <label class="form-label fw-semibold text-secondary small text-uppercase"><i class="fas fa-star me-1 text-warning"></i> Kategori Penilaian</label>
                <select name="assessment" class="form-select">
                    <option value="semua" {{ request('assessment') == 'semua' ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="sangat_puas" {{ request('assessment') == 'sangat_puas' ? 'selected' : '' }}>Sangat Puas</option>
                    <option value="puas" {{ request('assessment') == 'puas' ? 'selected' : '' }}>Puas</option>
                    <option value="tidak_puas" {{ request('assessment') == 'tidak_puas' ? 'selected' : '' }}>Tidak Puas</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6">
                <label class="form-label fw-semibold text-secondary small text-uppercase"><i class="fas fa-calendar me-1 text-success"></i> Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <label class="form-label fw-semibold text-secondary small text-uppercase"><i class="fas fa-calendar-check me-1 text-danger"></i> Tanggal Akhir</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="fas fa-search me-1"></i> Terapkan
                    </button>
                    <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary" title="Atur Ulang">
                        <i class="fas fa-sync"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #1a5276 !important;">
            <div class="card-body text-center py-4">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(26, 82, 118, 0.1);">
                        <i class="fas fa-file-alt fa-lg" style="color: #1a5276;"></i>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold" style="color: #1a5276;">{{ $stats['total'] }}</h2>
                <p class="mb-0 text-muted">Total Formulir</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #27ae60 !important;">
            <div class="card-body text-center py-4">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(39, 174, 96, 0.1);">
                        <i class="fas fa-smile-beam fa-lg text-success"></i>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold text-success">{{ $stats['sangat_puas'] }}</h2>
                <p class="mb-0 text-muted">Kategori Sangat Puas</p>
                <small class="text-success">{{ $stats['total'] > 0 ? number_format($stats['sangat_puas']/$stats['total']*100, 1) : 0 }}%</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #f39c12 !important;">
            <div class="card-body text-center py-4">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(243, 156, 18, 0.1);">
                        <i class="fas fa-meh fa-lg text-warning"></i>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold text-warning">{{ $stats['puas'] }}</h2>
                <p class="mb-0 text-muted">Kategori Puas</p>
                <small class="text-warning">{{ $stats['total'] > 0 ? number_format($stats['puas']/$stats['total']*100, 1) : 0 }}%</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #e74c3c !important;">
            <div class="card-body text-center py-4">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(231, 76, 60, 0.1);">
                        <i class="fas fa-frown fa-lg text-danger"></i>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold text-danger">{{ $stats['tidak_puas'] }}</h2>
                <p class="mb-0 text-muted">Kategori Tidak Puas</p>
                <small class="text-danger">{{ $stats['total'] > 0 ? number_format($stats['tidak_puas']/$stats['total']*100, 1) : 0 }}%</small>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center" style="background: #f8f9fa; border-left: 4px solid #1a5276;">
        <h5 class="mb-0"><i class="fas fa-table me-2 text-primary"></i> Tabel Data Penilaian Pelanggan</h5>
        <div class="d-flex gap-2">
            <a href="{{ route('reports.print', request()->query()) }}" target="_blank" class="btn btn-danger btn-sm">
                <i class="fas fa-file-pdf me-1"></i> Unduh Berkas PDF
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(request('assessment') && request('assessment') !== 'semua' || request('start_date') || request('end_date'))
        <div class="alert alert-info py-2 mb-3 d-flex align-items-center">
            <i class="fas fa-info-circle me-2"></i>
            <span>Filter Aktif: </span>
            @if(request('assessment') && request('assessment') !== 'semua')
                <span class="badge bg-primary ms-2">
                    Assessment: 
                    @if(request('assessment') == 'sangat_puas') Sangat Puas
                    @elseif(request('assessment') == 'puas') Puas
                    @else Tidak Puas
                    @endif
                </span>
            @endif
            @if(request('start_date'))
                <span class="badge bg-secondary ms-2">Dari: {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }}</span>
            @endif
            @if(request('end_date'))
                <span class="badge bg-secondary ms-2">Sampai: {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}</span>
            @endif
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead style="background: #1a5276; color: #fff;">
                    <tr>
                        <th class="text-center" style="width: 50px;">No.</th>
                        <th style="width: 110px;">Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat Email</th>
                        <th>Jenis Layanan</th>
                        <th>Kapasitas</th>
                        <th class="text-center">Hasil Penilaian</th>
                        <th class="text-center" style="width: 80px;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($forms as $index => $form)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <span class="text-nowrap">{{ $form->form_date ? $form->form_date->format('d/m/Y') : '-' }}</span>
                            </td>
                            <td>
                                <strong>{{ $form->customer->customer_name ?? '-' }}</strong>
                            </td>
                            <td>
                                <small>{{ $form->customer->email ?? '-' }}</small>
                            </td>
                            <td>{{ $form->customer->layanan_service ?? '-' }}</td>
                            <td>{{ $form->customer->kapasitas_capacity ?? '-' }}</td>
                            <td class="text-center">
                                @if($form->assessment == 'sangat_puas')
                                    <span class="badge bg-success px-3 py-2">
                                        <i class="fas fa-smile-beam me-1"></i> Sangat Puas
                                    </span>
                                @elseif($form->assessment == 'puas')
                                    <span class="badge bg-warning text-dark px-3 py-2">
                                        <i class="fas fa-meh me-1"></i> Puas
                                    </span>
                                @else
                                    <span class="badge bg-danger px-3 py-2">
                                        <i class="fas fa-frown me-1"></i> Tidak Puas
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('forms.show', $form) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-inbox fa-4x text-muted mb-3 d-block"></i>
                                <h5 class="text-muted">Data Tidak Tersedia</h5>
                                <p class="text-muted">Silakan ubah kriteria penyaringan untuk menampilkan data lainnya.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($forms) > 0)
        <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
            <div class="text-muted">
                <i class="fas fa-database me-1"></i> Jumlah Data: <strong>{{ count($forms) }}</strong> entri
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

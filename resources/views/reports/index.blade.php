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

<!-- Diagram Penilaian -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-4 text-center border-end">
                <div style="max-width: 180px; margin: 0 auto;">
                    <canvas id="assessmentChart"></canvas>
                </div>
                <p class="mb-0 mt-2"><strong>Total: {{ $stats['total'] }}</strong></p>
            </div>
            <div class="col-md-8">
                <h6 class="mb-3">Ringkasan Penilaian</h6>
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kategori</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span style="display:inline-block;width:12px;height:12px;background:#27ae60;border-radius:2px;margin-right:8px;"></span>Sangat Puas</td>
                            <td class="text-center"><strong>{{ $stats['sangat_puas'] }}</strong></td>
                            <td class="text-center">{{ $stats['total'] > 0 ? number_format($stats['sangat_puas']/$stats['total']*100, 1) : 0 }}%</td>
                        </tr>
                        <tr>
                            <td><span style="display:inline-block;width:12px;height:12px;background:#f39c12;border-radius:2px;margin-right:8px;"></span>Puas</td>
                            <td class="text-center"><strong>{{ $stats['puas'] }}</strong></td>
                            <td class="text-center">{{ $stats['total'] > 0 ? number_format($stats['puas']/$stats['total']*100, 1) : 0 }}%</td>
                        </tr>
                        <tr>
                            <td><span style="display:inline-block;width:12px;height:12px;background:#e74c3c;border-radius:2px;margin-right:8px;"></span>Tidak Puas</td>
                            <td class="text-center"><strong>{{ $stats['tidak_puas'] }}</strong></td>
                            <td class="text-center">{{ $stats['total'] > 0 ? number_format($stats['tidak_puas']/$stats['total']*100, 1) : 0 }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-light">
        <h6 class="mb-0">Data Penilaian Pelanggan</h6>
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
                                <strong>{{ $form->customer?->customer_name ?? '-' }}</strong>
                                <br><small class="text-muted">{{ $form->customer?->cid ?? '-' }}</small>
                            </td>
                            <td>
                                <small>{{ $form->customer?->email ?? '-' }}</small>
                            </td>
                            <td>{{ $form->customer?->layanan_service ?? '-' }}</td>
                            <td>{{ $form->customer?->kapasitas_capacity ?? '-' }}</td>
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

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statsData = {
        total: {{ $stats['total'] }},
        sangat_puas: {{ $stats['sangat_puas'] }},
        puas: {{ $stats['puas'] }},
        tidak_puas: {{ $stats['tidak_puas'] }}
    };
    
    const colors = {
        sangat_puas: '#27ae60',
        puas: '#f39c12',
        tidak_puas: '#e74c3c'
    };
    
    const ctx = document.getElementById('assessmentChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Sangat Puas', 'Puas', 'Tidak Puas'],
            datasets: [{
                data: [statsData.sangat_puas, statsData.puas, statsData.tidak_puas],
                backgroundColor: [colors.sangat_puas, colors.puas, colors.tidak_puas],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            const total = statsData.total;
                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return context.label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            },
            cutout: '50%'
        }
    });
});
</script>
@endsection

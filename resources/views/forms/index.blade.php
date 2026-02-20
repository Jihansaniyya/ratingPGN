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
        <a href="{{ route('forms.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-2"></i> Buat Formulir Baru
        </a>
    </div>
</div>

<!-- Diagram Penilaian -->
<div class="card mb-4">
    <div class="card-header">
        <strong>Ringkasan Penilaian</strong>
        <span class="text-muted ms-2">(Total: {{ $stats['total'] ?? 0 }} data)</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center d-flex align-items-center justify-content-center">
                <canvas id="formAssessmentChart" style="max-width: 200px; margin: 0 auto;"></canvas>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Kategori</th>
                            <th class="text-center" style="width: 100px;">Jumlah</th>
                            <th class="text-center" style="width: 100px;">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span style="display:inline-block;width:10px;height:10px;background:#27ae60;margin-right:8px;"></span>Sangat Puas</td>
                            <td class="text-center">{{ $stats['sangat_puas'] ?? 0 }}</td>
                            <td class="text-center">{{ ($stats['total'] ?? 0) > 0 ? number_format(($stats['sangat_puas'] ?? 0)/($stats['total'] ?? 1)*100, 1) : 0 }}%</td>
                        </tr>
                        <tr>
                            <td><span style="display:inline-block;width:10px;height:10px;background:#f39c12;margin-right:8px;"></span>Puas</td>
                            <td class="text-center">{{ $stats['puas'] ?? 0 }}</td>
                            <td class="text-center">{{ ($stats['total'] ?? 0) > 0 ? number_format(($stats['puas'] ?? 0)/($stats['total'] ?? 1)*100, 1) : 0 }}%</td>
                        </tr>
                        <tr>
                            <td><span style="display:inline-block;width:10px;height:10px;background:#e74c3c;margin-right:8px;"></span>Tidak Puas</td>
                            <td class="text-center">{{ $stats['tidak_puas'] ?? 0 }}</td>
                            <td class="text-center">{{ ($stats['total'] ?? 0) > 0 ? number_format(($stats['tidak_puas'] ?? 0)/($stats['total'] ?? 1)*100, 1) : 0 }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Filter & Tabel Data -->
<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('forms.index') }}" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" id="search-input" class="form-control" 
                           placeholder="Cari nama pelanggan..." value="{{ request('search') }}" autocomplete="off">
                    <button type="submit" class="btn btn-sm btn-primary">
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

                    <!-- tombol terapkan filter -->
                    <button type="submit" class="btn btn-sm btn-primary" title="Terapkan Filter">
                        <i class="fas fa-check me-1"></i> Terapkan
                    </button>

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
            <table id="data-table" class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No.</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th class="text-center">Penilaian</th>
                        <th>Petugas</th>
                        <th>Tanggal</th>
                        <th class="text-center" style="width: 80px;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($forms as $index => $form)
                    <tr>
                        <td class="text-center text-muted">{{ $forms->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold">{{ $form->customer?->customer_name ?? '-' }}</div>
                            <small class="text-muted">{{ $form->customer?->cid ?? '-' }}</small>
                        </td>
                        <td>
                            <div>{{ $form->customer?->layanan_service ?? '-' }}</div>
                            <small class="text-muted">{{ $form->customer?->kapasitas_capacity ?? '-' }}</small>
                        </td>
                        <td class="text-center">
                            @if($form->assessment == 'sangat_puas')
                                <span class="badge" style="background-color: #27ae60;">Sangat Puas</span>
                            @elseif($form->assessment == 'puas')
                                <span class="badge" style="background-color: #f39c12;">Puas</span>
                            @else
                                <span class="badge" style="background-color: #e74c3c;">Tidak Puas</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ $form->user->name ?? '-' }}</small>
                        </td>
                        <td>
                            <small>{{ $form->form_date ? $form->form_date->format('d/m/Y') : $form->created_at->format('d/m/Y') }}</small>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; color: #6c757d;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('forms.show', $form) }}">
                                            <i class="fas fa-eye me-2 text-primary"></i> Lihat Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('forms.pdf', $form) }}" target="_blank">
                                            <i class="fas fa-file-pdf me-2 text-danger"></i> Unduh PDF
                                        </a>
                                    </li>
                                    @if($form->user_id == auth()->id())
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('forms.edit', $form) }}">
                                            <i class="fas fa-edit me-2 text-warning"></i> Edit Form
                                        </a>
                                    </li>
                                    @endif
                                    @if(auth()->user()->isAdmin())
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); confirmDelete({{ $form->id }})">
                                            <i class="fas fa-trash me-2"></i> Hapus
                                        </a>
                                    </li>
                                    @endif
                                </ul>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statsData = {
            total: {{ $stats['total'] ?? 0 }},
            sangat_puas: {{ $stats['sangat_puas'] ?? 0 }},
            puas: {{ $stats['puas'] ?? 0 }},
            tidak_puas: {{ $stats['tidak_puas'] ?? 0 }}
        };
        
        const ctx = document.getElementById('formAssessmentChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Sangat Puas', 'Puas', 'Tidak Puas'],
                datasets: [{
                    data: [statsData.sangat_puas, statsData.puas, statsData.tidak_puas],
                    backgroundColor: ['#27ae60', '#f39c12', '#e74c3c'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
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
                cutout: '55%'
            }
        });

        // ============================================
        // LIVE TABLE FILTER - Filter saat mengetik
        // ============================================
        const searchInput = document.getElementById('search-input');
        const dataTable = document.getElementById('data-table');
        const tableBody = dataTable ? dataTable.querySelector('tbody') : null;
        
        if (searchInput && tableBody) {
            searchInput.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                const rows = tableBody.querySelectorAll('tr');
                
                rows.forEach(function(row) {
                    // Ambil nama pelanggan dari kolom pertama (td kedua karena ada nomor)
                    const pelangganCell = row.querySelector('td:nth-child(2)');
                    if (pelangganCell) {
                        const namaPelanggan = pelangganCell.textContent.toLowerCase();
                        
                        // Tampilkan row jika cocok, sembunyikan jika tidak
                        if (query === '' || namaPelanggan.includes(query)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            });
        }
    });
    
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Formulir?',
            text: 'Data formulir yang dihapus tidak dapat dikembalikan.',
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

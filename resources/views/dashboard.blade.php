@extends('layouts.app')

@section('title', 'Dashboard - Rating PGN')

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
    }
    .stat-card.blue {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    .stat-card.teal {
        background: linear-gradient(135deg, #36b9cc 0%, #1a8a9a 100%);
    }
    .stat-card .stat-icon {
        font-size: 2rem;
        opacity: 0.3;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
    }
    .activity-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 6px 10px;
        background: #f8f9fc;
        border-radius: 6px;
        margin-bottom: 5px;
    }
    .activity-item:last-child {
        margin-bottom: 0;
    }
    .activity-icon {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.7rem;
    }
    .table tbody tr:hover td {
        background-color: #f8f9fc;
    }
    .badge {
        font-weight: 500;
    }
    .table a.text-secondary:hover {
        color: #4e73df !important;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h4 class="page-title"><i class="fa-solid fa-chart-line"></i> Dashboard</h4>
    <small class="text-secondary">{{ now()->translatedFormat('l, d F Y') }}</small>
</div>

<!-- Main Stats -->
<div class="row mb-3">
    <div class="col-md-6 mb-2">
        <div class="card stat-card blue position-relative overflow-hidden">
            <div class="card-body py-3">
                <div class="text-uppercase small opacity-75 mb-1">Total Formulir</div>
                <div class="h4 mb-0 fw-bold">{{ $stats['total_forms'] }}</div>
                <i class="fa-solid fa-file-lines stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="card stat-card teal position-relative overflow-hidden">
            <div class="card-body py-3">
                <div class="text-uppercase small opacity-75 mb-1">Total Petugas</div>
                <div class="h4 mb-0 fw-bold">{{ $stats['total_petugas'] }}</div>
                <i class="fa-solid fa-user-gear stat-icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <!-- Kepuasan Pelanggan -->
    <div class="col-lg-4 mb-3">
        <div class="card h-100">
            <div class="card-header bg-white py-2 border-0">
                <span class="fw-semibold text-dark small"><i class="fa-solid fa-chart-pie me-2 text-primary"></i>Kepuasan Pelanggan</span>
            </div>
            <div class="card-body py-3">
                @if($stats['total_forms'] > 0)
                <div class="text-center mb-3">
                    <div style="width: 120px; margin: 0 auto;">
                        <canvas id="assessmentChart"></canvas>
                    </div>
                </div>
                <div class="px-2">
                    @php $total = $stats['total_forms']; @endphp
                    <div class="mb-2">
                        <div class="d-flex justify-content-between small mb-1">
                            <span><i class="fa-solid fa-face-smile me-1" style="color:#27ae60;"></i>Sangat Puas</span>
                            <span class="fw-bold">{{ $stats['total_sangat_puas'] }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: {{ $total > 0 ? ($stats['total_sangat_puas']/$total*100) : 0 }}%; background: #27ae60;"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between small mb-1">
                            <span><i class="fa-solid fa-face-meh me-1" style="color:#f39c12;"></i>Puas</span>
                            <span class="fw-bold">{{ $stats['total_puas'] }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: {{ $total > 0 ? ($stats['total_puas']/$total*100) : 0 }}%; background: #f39c12;"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span><i class="fa-solid fa-face-frown me-1" style="color:#e74c3c;"></i>Tidak Puas</span>
                            <span class="fw-bold">{{ $stats['total_tidak_puas'] }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: {{ $total > 0 ? ($stats['total_tidak_puas']/$total*100) : 0 }}%; background: #e74c3c;"></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fa-solid fa-chart-pie fa-2x text-muted mb-2"></i>
                    <p class="text-muted small mb-0">Belum ada data</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistik Aktivitas -->
    <div class="col-lg-8 mb-3">
        <div class="card h-100">
            <div class="card-header bg-white py-2 border-0">
                <span class="fw-semibold text-dark small"><i class="fa-solid fa-chart-bar me-2 text-primary"></i>Statistik Aktivitas</span>
            </div>
            <div class="card-body py-2">
                <div class="row">
                    <div class="col-md-7 mb-2 mb-md-0">
                        <canvas id="activityChart" height="180"></canvas>
                    </div>
                    <div class="col-md-5 d-flex flex-column justify-content-end">
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon me-2" style="background: #3498db;"><i class="fa-solid fa-clipboard-list"></i></div>
                                <span class="small">Survey</span>
                            </div>
                            <span class="fw-bold small">{{ $activityStats['survey'] }}</span>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon me-2" style="background: #27ae60;"><i class="fa-solid fa-power-off"></i></div>
                                <span class="small">Activation</span>
                            </div>
                            <span class="fw-bold small">{{ $activityStats['activation'] }}</span>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon me-2" style="background: #9b59b6;"><i class="fa-solid fa-arrow-up"></i></div>
                                <span class="small">Upgrade</span>
                            </div>
                            <span class="fw-bold small">{{ $activityStats['upgrade'] }}</span>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon me-2" style="background: #e67e22;"><i class="fa-solid fa-arrow-down"></i></div>
                                <span class="small">Downgrade</span>
                            </div>
                            <span class="fw-bold small">{{ $activityStats['downgrade'] }}</span>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon me-2" style="background: #e74c3c;"><i class="fa-solid fa-wrench"></i></div>
                                <span class="small">Troubleshoot</span>
                            </div>
                            <span class="fw-bold small">{{ $activityStats['troubleshoot'] }}</span>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon me-2" style="background: #1abc9c;"><i class="fa-solid fa-shield-halved"></i></div>
                                <span class="small">Preventive Maintenance</span>
                            </div>
                            <span class="fw-bold small">{{ $activityStats['preventive_maintenance'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulir Terbaru -->
<div class="card">
    <div class="card-header bg-white py-2 border-0 d-flex justify-content-between align-items-center">
        <span class="fw-semibold text-dark small"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Formulir Terbaru</span>
        <a href="{{ route('forms.index') }}" class="btn btn-sm btn-primary btn-xs">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-sm mb-0">
                <thead>
                    <tr class="bg-light">
                        <th class="border-0 ps-3 small">Customer</th>
                        <th class="border-0 small">Layanan</th>
                        <th class="border-0 small">Aktivitas</th>
                        <th class="border-0 small">Penilaian</th>
                        <th class="border-0 small">Tanggal</th>
                        <th class="border-0 text-center pe-3 small">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentForms as $form)
                    <tr>
                        <td class="ps-3 small">{{ $form->customer?->customer_name ?? '-' }}</td>
                        <td class="text-secondary small">{{ $form->customer?->layanan_service ?? '-' }}</td>
                        <td class="small">
                            @php $activities = $form->activities; @endphp
                            @if(count($activities) > 0)
                                @foreach($activities as $activity)
                                    <span class="badge bg-secondary me-1" style="font-size:0.7rem;">{{ $activity }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="small">
                            @if($form->assessment == 'sangat_puas')
                                <span class="badge" style="background-color: #27ae60; font-size:0.7rem;">Sangat Puas</span>
                            @elseif($form->assessment == 'puas')
                                <span class="badge" style="background-color: #f39c12; font-size:0.7rem;">Puas</span>
                            @else
                                <span class="badge" style="background-color: #e74c3c; font-size:0.7rem;">Tidak Puas</span>
                            @endif
                        </td>
                        <td class="text-secondary small">{{ $form->created_at->format('d/m/Y') }}</td>
                        <td class="text-center pe-3">
                            <a href="{{ route('forms.show', $form) }}" class="text-secondary" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3 small">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Doughnut Chart - Kepuasan (hanya render jika ada data)
        const assessmentEl = document.getElementById('assessmentChart');
        if (assessmentEl && {{ $stats['total_forms'] }} > 0) {
            new Chart(assessmentEl, {
                type: 'doughnut',
                data: {
                    labels: ['Sangat Puas', 'Puas', 'Tidak Puas'],
                    datasets: [{
                        data: [{{ $stats['total_sangat_puas'] }}, {{ $stats['total_puas'] }}, {{ $stats['total_tidak_puas'] }}],
                        backgroundColor: ['#27ae60', '#f39c12', '#e74c3c'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '60%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(ctx) {
                                    const total = {{ $stats['total_forms'] }};
                                    const pct = total > 0 ? ((ctx.raw / total) * 100).toFixed(1) : 0;
                                    return ctx.label + ': ' + ctx.raw + ' (' + pct + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }

        // Bar Chart - Aktivitas
        new Chart(document.getElementById('activityChart'), {
            type: 'bar',
            data: {
                labels: ['Survey', 'Activation', 'Upgrade', 'Downgrade', 'Troubleshoot', 'Preventive'],
                datasets: [{
                    data: [
                        {{ $activityStats['survey'] }},
                        {{ $activityStats['activation'] }},
                        {{ $activityStats['upgrade'] }},
                        {{ $activityStats['downgrade'] }},
                        {{ $activityStats['troubleshoot'] }},
                        {{ $activityStats['preventive_maintenance'] }}
                    ],
                    backgroundColor: ['#3498db', '#27ae60', '#9b59b6', '#e67e22', '#e74c3c', '#1abc9c'],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endpush


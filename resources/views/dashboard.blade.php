@extends('layouts.app')

@section('title', 'Dashboard - Rating PGN')

@push('styles')
<style>
    /* Card hover effects */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    /* Table row hover */
    .table tbody tr {
        transition: background-color 0.15s ease;
    }
    .table tbody tr:hover td {
        background-color: #f8f9fc;
    }
    
    /* Badge pulse on hover */
    .badge {
        transition: transform 0.15s ease;
    }
    .badge:hover {
        transform: scale(1.05);
    }
    
    /* Eye icon hover */
    .table a.text-secondary {
        transition: color 0.15s ease, transform 0.15s ease;
        display: inline-block;
    }
    .table a.text-secondary:hover {
        color: #4e73df !important;
        transform: scale(1.2);
    }
    
    /* Button hover effect */
    .btn-primary {
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3);
    }
    
    /* Stat number counter animation */
    .stat-number {
        display: inline-block;
    }
    
    /* Fade in animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .row.mb-4 .col-md-6:nth-child(1) .card { animation: fadeInUp 0.3s ease forwards; }
    .row.mb-4 .col-md-6:nth-child(2) .card { animation: fadeInUp 0.3s ease 0.1s forwards; }
    .row.mb-4 .col-md-6:nth-child(3) .card { animation: fadeInUp 0.3s ease 0.2s forwards; }
    .row.mb-4 .col-md-6:nth-child(4) .card { animation: fadeInUp 0.3s ease 0.3s forwards; }
    .row.mb-4 .col-md-6:nth-child(5) .card { animation: fadeInUp 0.3s ease 0.4s forwards; }
</style>
@endpush

@section('content')
<div class="page-header">
    <h4 class="page-title"><i class="fa-solid fa-chart-line"></i>Dashboard</h4>
    <small class="text-secondary">{{ now()->translatedFormat('l, d F Y') }}</small>
</div>

<!-- Stats Row -->
<div class="row mb-5">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card h-100" style="border-left: 4px solid #4e73df;">
            <div class="card-body py-3">
                <div class="text-uppercase text-secondary small mb-1">
                    <i class="fa-solid fa-copy"></i> Total Formulir</div>
                <div class="h4 mb-0 fw-bold text-dark">{{ $stats['total_forms'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card h-100" style="border-left: 4px solid #36b9cc;">
            <div class="card-body py-3">
                <div class="text-uppercase text-secondary small mb-1">
                    <i class="fa-solid fa-users"></i> Total Pengguna</div>
                <div class="h4 mb-0 fw-bold text-dark">{{ $stats['total_users'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2 mb-3">
        <div class="card h-100" style="border-left: 4px solid #27ae60;">
            <div class="card-body py-3">
                <div class="text-uppercase text-secondary small mb-1">
                    <i class="fa-solid fa-face-smile"></i> Sangat Puas</div>
                <div class="h4 mb-0 fw-bold" style="color: #27ae60;">{{ $stats['total_sangat_puas'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2 mb-3">
        <div class="card h-100" style="border-left: 4px solid #f39c12;">
            <div class="card-body py-3">
                <div class="text-uppercase text-secondary small mb-1">
                    <i class="fa-solid fa-face-meh"></i> Puas</div>
                <div class="h4 mb-0 fw-bold" style="color: #f39c12;">{{ $stats['total_puas'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2 mb-3">
        <div class="card h-100" style="border-left: 4px solid #e74a3b;">
            <div class="card-body py-3">
                <div class="text-uppercase text-secondary small mb-1">
                    <i class="fa-solid fa-face-frown"></i> Tidak Puas</div>
                <div class="h4 mb-0 fw-bold" style="color: #e74a3b;">{{ $stats['total_tidak_puas'] }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart -->
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <span class="fw-semibold text-dark">Distribusi Kepuasan</span>
            </div>
            <div class="card-body">
                <canvas id="assessmentChart" height="220"></canvas>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold text-dark">Formulir Terbaru</span>
                <a href="{{ route('forms.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th class="border-0 ps-4">Pelanggan</th>
                            <th class="border-0">Layanan</th>
                            <th class="border-0">Penilaian</th>
                            <th class="border-0">Tanggal</th>
                            <th class="border-0 text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentForms as $form)
                        <tr>
                            <td class="ps-4">{{ $form->customer->customer_name }}</td>
                            <td class="text-secondary">{{ $form->customer->layanan_service }}</td>
                            <td>
                                @if($form->assessment == 'sangat_puas')
                                    <span class="badge bg-success">Sangat Puas</span>
                                @elseif($form->assessment == 'puas')
                                    <span class="badge bg-warning text-dark">Puas</span>
                                @else
                                    <span class="badge bg-danger">Tidak Puas</span>
                                @endif
                            </td>
                            <td class="text-secondary">{{ $form->created_at->format('d/m/Y') }}</td>
                            <td class="text-center pe-4">
                                <a href="{{ route('forms.show', $form) }}" class="text-secondary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart dengan animasi
    new Chart(document.getElementById('assessmentChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($assessmentData['labels']) !!},
            datasets: [{ 
                data: {!! json_encode($assessmentData['data']) !!},
                backgroundColor: ['#e74c3c', '#f39c12', '#27ae60'],
                hoverOffset: 8,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '70%',
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 800,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    padding: 12,
                    cornerRadius: 8
                }
            }
        }
    });

    // Animasi angka statistik
    document.querySelectorAll('.h4.fw-bold').forEach(el => {
        const target = parseInt(el.textContent);
        if (!isNaN(target) && target > 0) {
            let current = 0;
            const increment = Math.ceil(target / 20);
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                el.textContent = current;
            }, 30);
        }
    });
</script>
@endpush


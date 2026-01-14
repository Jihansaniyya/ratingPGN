

<?php $__env->startSection('title', 'Dashboard - Rating PGN'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-home"></i>
        Dashboard
    </h1>
    <div class="text-end">
        <p class="mb-0 text-dark"><i class="fas fa-calendar-alt me-2"></i><?php echo e(now()->translatedFormat('d F Y')); ?></p>
        <small class="text-muted">Penanggung Jawab: <?php echo e(auth()->user()->name); ?></small>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Total Form</div>
                    <div class="stat-value"><?php echo e($stats['total_forms']); ?></div>
                </div>
                <div class="stat-icon primary">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Total Customer</div>
                    <div class="stat-value"><?php echo e($stats['total_customers']); ?></div>
                </div>
                <div class="stat-icon info">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Sangat Puas</div>
                    <div class="stat-value"><?php echo e($stats['total_sangat_puas']); ?></div>
                </div>
                <div class="stat-icon success">
                    <i class="fas fa-smile-beam"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Puas</div>
                    <div class="stat-value"><?php echo e($stats['total_puas']); ?></div>
                </div>
                <div class="stat-icon warning">
                    <i class="fas fa-meh"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Tidak Puas</div>
                    <div class="stat-value"><?php echo e($stats['total_tidak_puas']); ?></div>
                </div>
                <div class="stat-icon danger">
                    <i class="fas fa-frown"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Assessment Chart -->
    <div class="col-xl-4 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-chart-pie me-2"></i> Distribusi Assessment</span>
            </div>
            <div class="card-body">
                <canvas id="assessmentChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Forms -->
    <div class="col-xl-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-clock me-2"></i> Form Terbaru</span>
                <a href="<?php echo e(route('forms.index')); ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Layanan</th>
                                <th>Assessment</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td><?php echo e($form->customer->customer_name); ?></td>
                                <td><?php echo e($form->customer->layanan_service); ?></td>
                                <td>
                                    <?php if($form->assessment == 'sangat_puas'): ?>
                                        <span class="badge bg-success">Sangat Puas</span>
                                    <?php elseif($form->assessment == 'puas'): ?>
                                        <span class="badge bg-warning text-dark">Puas</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Tidak Puas</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($form->created_at->format('d/m/Y')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('forms.show', $form)); ?>" class="btn btn-outline-secondary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    Belum ada data form
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Assessment Chart
    const ctx = document.getElementById('assessmentChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($assessmentData['labels']); ?>,
            datasets: [{
                data: <?php echo json_encode($assessmentData['data']); ?>,
                backgroundColor: ['#e74a3b', '#f6c23e', '#1cc88a'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jihan Saniyya\ratingPGN-app\resources\views/dashboard.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'Detail Form On Site Customer'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header no-print">
    <h1 class="page-title">
        <i class="fas fa-file-alt"></i>
        Detail Form On Site Customer
    </h1>
    <div>
        <a href="<?php echo e(route('forms.pdf', $form)); ?>" class="btn btn-danger" target="_blank">
            <i class="fas fa-file-pdf me-2"></i> PDF
        </a>
        <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print me-2"></i> Cetak
        </button>
        <?php if($form->user_id == auth()->id()): ?>
        <a href="<?php echo e(route('forms.edit', $form)); ?>" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i> Edit
        </a>
        <?php endif; ?>
        <?php if(auth()->user()->isAdmin()): ?>
        <button type="button" class="btn btn-dark" onclick="confirmDelete()">
            <i class="fas fa-trash me-2"></i> Hapus
        </button>
        <form id="delete-form" action="<?php echo e(route('forms.destroy', $form)); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>
        <?php endif; ?>
        <a href="<?php echo e(route('forms.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card mb-4" id="printArea">
    <div class="card-header bg-dark text-white text-center py-3">
        <h3 class="mb-0">Form On Site Customer</h3>
    </div>
    <div class="card-body">
        <!-- Customer Detail -->
        <div class="form-section mb-4">
            <h5 class="form-section-title">
                <i class="fas fa-user me-2"></i> Customer Detail
            </h5>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Customer Name</strong></td>
                            <td>: <?php echo e($form->customer->customer_name); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Layanan / Service</strong></td>
                            <td>: <?php echo e($form->customer->layanan_service); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Kapasitas / Capacity</strong></td>
                            <td>: <?php echo e($form->customer->kapasitas_capacity); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>No. Telp (PIC)</strong></td>
                            <td>: <?php echo e($form->customer->no_telp_pic); ?></td>
                        </tr>
                        <tr>
                            <td><strong>E-mail</strong></td>
                            <td>: <?php echo e($form->customer->email); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <!-- Address Detail -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="border rounded p-3 bg-light">
                        <strong><i class="fas fa-map-marker-alt me-2"></i>Alamat:</strong>
                        <div class="mt-2">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="20%"><strong>Provinsi</strong></td>
                                    <td>: <?php echo e($form->customer->provinsi); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Kota/Kabupaten</strong></td>
                                    <td>: <?php echo e($form->customer->kota_kabupaten); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Kecamatan</strong></td>
                                    <td>: <?php echo e($form->customer->kecamatan); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Kelurahan</strong></td>
                                    <td>: <?php echo e($form->customer->kelurahan); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat Lengkap</strong></td>
                                    <td>: <?php echo e($form->customer->alamat_lengkap); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Maintenance Device -->
        <div class="form-section mb-4">
            <h5 class="form-section-title">
                <i class="fas fa-tools me-2"></i> Maintenance Device
            </h5>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Device Name</th>
                        <th>Serial Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $form->maintenanceDevices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($device->device_name); ?></td>
                        <td><?php echo e($device->serial_number); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="2" class="text-center text-muted">Tidak ada device</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Technical Detail -->
        <div class="form-section mb-4">
            <h5 class="form-section-title">
                <i class="fas fa-cogs me-2"></i> Technical Detail
            </h5>
            
            <div class="mb-3">
                <strong>Activity:</strong>
                <div class="mt-2">
                    <?php if($form->activity_survey): ?>
                        <span class="badge bg-primary me-1"><i class="fas fa-check me-1"></i> Survey</span>
                    <?php endif; ?>
                    <?php if($form->activity_activation): ?>
                        <span class="badge bg-primary me-1"><i class="fas fa-check me-1"></i> Activation</span>
                    <?php endif; ?>
                    <?php if($form->activity_upgrade): ?>
                        <span class="badge bg-primary me-1"><i class="fas fa-check me-1"></i> Upgrade</span>
                    <?php endif; ?>
                    <?php if($form->activity_downgrade): ?>
                        <span class="badge bg-primary me-1"><i class="fas fa-check me-1"></i> Downgrade</span>
                    <?php endif; ?>
                    <?php if($form->activity_troubleshoot): ?>
                        <span class="badge bg-primary me-1"><i class="fas fa-check me-1"></i> Troubleshoot</span>
                    <?php endif; ?>
                    <?php if($form->activity_preventive_maintenance): ?>
                        <span class="badge bg-primary me-1"><i class="fas fa-check me-1"></i> Preventive Maintenance</span>
                    <?php endif; ?>
                    <?php if(empty($form->activities)): ?>
                        <span class="text-muted">Tidak ada activity yang dipilih</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <strong>Complaint:</strong>
                    <div class="border rounded p-3 bg-light mt-2">
                        <?php echo e($form->complaint ?: '-'); ?>

                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <strong>Action:</strong>
                    <div class="border rounded p-3 bg-light mt-2">
                        <?php echo e($form->action ?: '-'); ?>

                    </div>
                </div>
            </div>
        </div>

        <!-- Assessment -->
        <div class="form-section mb-4">
            <h5 class="form-section-title">
                <i class="fas fa-star me-2"></i> Assessment
            </h5>
            <div class="text-center py-4">
                <?php if($form->assessment == 'sangat_puas'): ?>
                    <i class="fas fa-smile-beam fa-5x text-success mb-3"></i>
                    <h3 class="text-success">Sangat Puas</h3>
                <?php elseif($form->assessment == 'puas'): ?>
                    <i class="fas fa-meh fa-5x text-warning mb-3"></i>
                    <h3 class="text-warning">Puas</h3>
                <?php else: ?>
                    <i class="fas fa-frown fa-5x text-danger mb-3"></i>
                    <h3 class="text-danger">Tidak Puas</h3>
                <?php endif; ?>
            </div>
        </div>

        <!-- Signatures -->
        <div class="form-section">
            <h5 class="form-section-title">
                <i class="fas fa-signature me-2"></i> Tanda Tangan
            </h5>
            <div class="text-center mb-3">
                <strong><?php echo e($form->location); ?>, <?php echo e($form->form_date ? $form->form_date->format('d F Y') : '-'); ?></strong>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="border rounded p-3">
                        <p class="mb-2"><strong>Pihak Pertama,</strong></p>
                        <p class="text-primary mb-3"><strong>PT TELEMEDIA DINAMIKA SARANA</strong></p>
                        <?php if($form->signature_first_party): ?>
                            <img src="<?php echo e($form->signature_first_party); ?>" alt="Signature" style="max-height: 100px;">
                        <?php else: ?>
                            <div style="height: 100px;"></div>
                        <?php endif; ?>
                        <hr>
                        <p class="mb-0">( <?php echo e($form->first_party_name ?: '________________'); ?> )</p>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="border rounded p-3">
                        <p class="mb-2"><strong>Pihak Kedua,</strong></p>
                        <p class="mb-3">&nbsp;</p>
                        <?php if($form->signature_second_party): ?>
                            <img src="<?php echo e($form->signature_second_party); ?>" alt="Signature" style="max-height: 100px;">
                        <?php else: ?>
                            <div style="height: 100px;"></div>
                        <?php endif; ?>
                        <hr>
                        <p class="mb-0">( <?php echo e($form->second_party_name ?: '________________'); ?> )</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    @media print {
        .sidebar, .top-navbar, .page-header, .no-print {
            display: none !important;
        }
        .main-content {
            margin-left: 0 !important;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #000 !important;
        }
        .content-wrapper {
            padding: 0 !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus form ini?')) {
            document.getElementById('delete-form').submit();
        }
    }
    
    <?php if(request('print')): ?>
        window.onload = function() {
            window.print();
        }
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jihan Saniyya\ratingPGN-app\resources\views/forms/show.blade.php ENDPATH**/ ?>
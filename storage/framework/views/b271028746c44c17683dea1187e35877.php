

<?php $__env->startSection('title', 'Buat Form On Site Customer'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-plus-circle"></i>
        Form On Site Customer
    </h1>
    <a href="<?php echo e(route('forms.index')); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<form action="<?php echo e(route('forms.store')); ?>" method="POST" id="onSiteForm" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger mb-4">
            <h6><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <!-- Customer Detail Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-user me-2"></i> Customer Detail
        </h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                <input type="text" name="customer_name" class="form-control <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('customer_name')); ?>" required>
                <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Layanan / Service <span class="text-danger">*</span></label>
                <input type="text" name="layanan_service" class="form-control <?php $__errorArgs = ['layanan_service'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('layanan_service')); ?>" required>
                <?php $__errorArgs = ['layanan_service'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <!-- Address Section with Dropdowns -->
            <div class="col-12 mb-3">
                <label class="form-label fw-bold"><i class="fas fa-map-marker-alt me-1"></i> Alamat</label>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                <select name="provinsi" id="provinsi" class="form-select <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="">-- Pilih Provinsi --</option>
                </select>
                <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kota / Kabupaten <span class="text-danger">*</span></label>
                <select name="kota_kabupaten" id="kota_kabupaten" class="form-select <?php $__errorArgs = ['kota_kabupaten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required disabled>
                    <option value="">-- Pilih Kota/Kabupaten --</option>
                </select>
                <?php $__errorArgs = ['kota_kabupaten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                <select name="kecamatan" id="kecamatan" class="form-select <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required disabled>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
                <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                <select name="kelurahan" id="kelurahan" class="form-select <?php $__errorArgs = ['kelurahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required disabled>
                    <option value="">-- Pilih Kelurahan --</option>
                </select>
                <?php $__errorArgs = ['kelurahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea name="alamat_lengkap" class="form-control <?php $__errorArgs = ['alamat_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                          rows="2" placeholder="Nama jalan, nomor rumah, RT/RW, dll..." required><?php echo e(old('alamat_lengkap')); ?></textarea>
                <?php $__errorArgs = ['alamat_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Kapasitas / Capacity <span class="text-danger">*</span></label>
                <input type="text" name="kapasitas_capacity" class="form-control <?php $__errorArgs = ['kapasitas_capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('kapasitas_capacity')); ?>" required>
                <?php $__errorArgs = ['kapasitas_capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Telp (PIC) <span class="text-danger">*</span></label>
                <input type="text" name="no_telp_pic" class="form-control <?php $__errorArgs = ['no_telp_pic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('no_telp_pic')); ?>" required>
                <?php $__errorArgs = ['no_telp_pic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">E-mail <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('email')); ?>" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <!-- Maintenance Device Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-tools me-2"></i> Maintenance Device <span class="text-danger">*</span>
        </h4>
        <div id="devices-container">
            <div class="device-row mb-3 p-3 border rounded bg-light">
                <div class="row">
                    <div class="col-md-5 mb-2">
                        <label class="form-label">Device Name <span class="text-danger">*</span></label>
                        <input type="text" name="devices[0][device_name]" class="form-control" placeholder="Masukkan nama device" required>
                    </div>
                    <div class="col-md-5 mb-2">
                        <label class="form-label">Serial Number <span class="text-danger">*</span></label>
                        <input type="text" name="devices[0][serial_number]" class="form-control" placeholder="Masukkan serial number" required>
                    </div>
                    <div class="col-md-2 mb-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove-device w-100" onclick="removeDevice(this)" disabled>
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-box me-1"></i> Foto Produk <span class="text-danger">*</span></label>
                        <input type="file" name="devices[0][product_photo]" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                        <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-sticky-note me-1"></i> Keterangan <span class="text-danger">*</span></label>
                        <textarea name="devices[0][keterangan]" class="form-control" rows="2" placeholder="Masukkan keterangan device..." required></textarea>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-outline-primary mt-2" onclick="addDevice()">
            <i class="fas fa-plus me-2"></i> Tambah Device
        </button>
    </div>

    <!-- Technical Detail Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-cogs me-2"></i> Technical Detail
        </h4>
        
        <div class="mb-4">
            <label class="form-label fw-bold">Activity <span class="text-danger">*</span></label>
            <small class="text-muted d-block mb-2">Pilih minimal satu aktivitas</small>
            <div class="row" id="activity-group">
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_survey" value="1" id="survey">
                        <label class="form-check-label" for="survey">Survey</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_activation" value="1" id="activation">
                        <label class="form-check-label" for="activation">Activation</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_upgrade" value="1" id="upgrade">
                        <label class="form-check-label" for="upgrade">Upgrade</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_downgrade" value="1" id="downgrade">
                        <label class="form-check-label" for="downgrade">Downgrade</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_troubleshoot" value="1" id="troubleshoot">
                        <label class="form-check-label" for="troubleshoot">Troubleshoot</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_preventive_maintenance" value="1" id="preventive">
                        <label class="form-check-label" for="preventive">Preventive Maintenance</label>
                    </div>
                </div>
            </div>
            <div id="activity-error" class="text-danger small mt-1" style="display: none;">Pilih minimal satu aktivitas</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Complaint <span class="text-danger">*</span></label>
            <textarea name="complaint" class="form-control <?php $__errorArgs = ['complaint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" placeholder="Masukkan keluhan customer..." required><?php echo e(old('complaint')); ?></textarea>
            <?php $__errorArgs = ['complaint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Action <span class="text-danger">*</span></label>
            <textarea name="action" class="form-control <?php $__errorArgs = ['action'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" placeholder="Masukkan tindakan yang dilakukan..." required><?php echo e(old('action')); ?></textarea>
            <?php $__errorArgs = ['action'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <!-- Assessment Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-star me-2"></i> Assessment
        </h4>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label class="assessment-option tidak-puas w-100" onclick="selectAssessment(this, 'tidak_puas')">
                    <input type="radio" name="assessment" value="tidak_puas" required>
                    <i class="fas fa-frown d-block"></i>
                    <span class="fw-bold">Tidak Puas</span>
                </label>
            </div>
            <div class="col-md-4 mb-3">
                <label class="assessment-option puas w-100" onclick="selectAssessment(this, 'puas')">
                    <input type="radio" name="assessment" value="puas">
                    <i class="fas fa-meh d-block"></i>
                    <span class="fw-bold">Puas</span>
                </label>
            </div>
            <div class="col-md-4 mb-3">
                <label class="assessment-option sangat-puas w-100" onclick="selectAssessment(this, 'sangat_puas')">
                    <input type="radio" name="assessment" value="sangat_puas">
                    <i class="fas fa-smile-beam d-block"></i>
                    <span class="fw-bold">Sangat Puas</span>
                </label>
            </div>
        </div>
        <?php $__errorArgs = ['assessment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger text-center"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Signature Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-signature me-2"></i> Tanda Tangan <span class="text-danger">*</span>
        </h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Lokasi <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('location')); ?>" placeholder="Contoh: Jakarta" required>
                <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                <input type="date" name="form_date" class="form-control <?php $__errorArgs = ['form_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('form_date', date('Y-m-d'))); ?>" required>
                <?php $__errorArgs = ['form_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-6 mb-3 d-flex">
                <div class="card w-100 <?php $__errorArgs = ['signature_first_party'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <div class="card-header bg-primary text-white text-center">
                        Pihak Pertama <span class="text-warning">*</span><br>
                        <strong>PT TELEMEDIA DINAMIKA SARANA</strong>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <input type="text" name="first_party_name" class="form-control <?php $__errorArgs = ['first_party_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Nama Pihak Pertama *" required>
                            <?php $__errorArgs = ['first_party_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="signature-pad flex-grow-1" id="signaturePad1">
                            <canvas id="canvas1"></canvas>
                        </div>
                        <input type="hidden" name="signature_first_party" id="signature_first_party" required>
                        <?php $__errorArgs = ['signature_first_party'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="clearSignature(1)">
                            <i class="fas fa-eraser me-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 d-flex">
                <div class="card w-100 <?php $__errorArgs = ['signature_second_party'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <div class="card-header bg-secondary text-white text-center">
                        Pihak Kedua <span class="text-warning">*</span><br>
                        <strong>&nbsp;</strong>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <input type="text" name="second_party_name" class="form-control <?php $__errorArgs = ['second_party_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Nama Pihak Kedua *" required>
                            <?php $__errorArgs = ['second_party_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="signature-pad flex-grow-1" id="signaturePad2">
                            <canvas id="canvas2"></canvas>
                        </div>
                        <input type="hidden" name="signature_second_party" id="signature_second_party" required>
                        <?php $__errorArgs = ['signature_second_party'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="clearSignature(2)">
                            <i class="fas fa-eraser me-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="form-section text-center">
        <button type="submit" class="btn btn-primary btn-lg px-5">
            <i class="fas fa-save me-2"></i> Simpan Form
        </button>
        <a href="<?php echo e(route('forms.index')); ?>" class="btn btn-secondary btn-lg px-5 ms-2">
            <i class="fas fa-times me-2"></i> Batal
        </a>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .signature-pad canvas {
        border: 1px solid #e3e6f0;
        border-radius: 5px;
        cursor: crosshair;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    let deviceIndex = 1;
    let signaturePad1, signaturePad2;

    // API Base URL for Indonesia regions
    const API_BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    // Initialize signature pads and load provinces
    document.addEventListener('DOMContentLoaded', function() {
        const canvas1 = document.getElementById('canvas1');
        const canvas2 = document.getElementById('canvas2');
        
        // Set canvas dimensions
        canvas1.width = canvas1.parentElement.offsetWidth - 4;
        canvas1.height = 150;
        canvas2.width = canvas2.parentElement.offsetWidth - 4;
        canvas2.height = 150;

        signaturePad1 = new SignaturePad(canvas1, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)'
        });
        
        signaturePad2 = new SignaturePad(canvas2, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)'
        });

        // Save signature data on form submit
        document.getElementById('onSiteForm').addEventListener('submit', function() {
            if (!signaturePad1.isEmpty()) {
                document.getElementById('signature_first_party').value = signaturePad1.toDataURL();
            }
            if (!signaturePad2.isEmpty()) {
                document.getElementById('signature_second_party').value = signaturePad2.toDataURL();
            }
        });

        // Load provinces
        loadProvinces();
    });

    // Load Provinces
    async function loadProvinces() {
        try {
            const response = await fetch(`${API_BASE}/provinces.json`);
            const provinces = await response.json();
            const select = document.getElementById('provinsi');
            select.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
            provinces.forEach(prov => {
                select.innerHTML += `<option value="${prov.name}" data-id="${prov.id}">${prov.name}</option>`;
            });
        } catch (error) {
            console.error('Error loading provinces:', error);
        }
    }

    // Load Cities/Regencies
    document.getElementById('provinsi').addEventListener('change', async function() {
        const selectedOption = this.options[this.selectedIndex];
        const provId = selectedOption.dataset.id;
        const kotaSelect = document.getElementById('kota_kabupaten');
        const kecSelect = document.getElementById('kecamatan');
        const kelSelect = document.getElementById('kelurahan');

        // Reset dependent dropdowns
        kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
        kotaSelect.disabled = true;
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kecSelect.disabled = true;
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        kelSelect.disabled = true;

        // Reset lokasi field when province changes
        document.querySelector('input[name="location"]').value = '';

        if (provId) {
            try {
                const response = await fetch(`${API_BASE}/regencies/${provId}.json`);
                const cities = await response.json();
                cities.forEach(city => {
                    kotaSelect.innerHTML += `<option value="${city.name}" data-id="${city.id}">${city.name}</option>`;
                });
                kotaSelect.disabled = false;
            } catch (error) {
                console.error('Error loading cities:', error);
            }
        }
    });

    // Load Districts
    document.getElementById('kota_kabupaten').addEventListener('change', async function() {
        const selectedOption = this.options[this.selectedIndex];
        const cityId = selectedOption.dataset.id;
        const cityName = selectedOption.value;
        const kecSelect = document.getElementById('kecamatan');
        const kelSelect = document.getElementById('kelurahan');

        // Reset dependent dropdowns
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kecSelect.disabled = true;
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        kelSelect.disabled = true;

        // Auto-fill lokasi berdasarkan kota yang dipilih
        const locationInput = document.querySelector('input[name="location"]');
        if (cityName) {
            // Hapus prefix KOTA/KABUPATEN jika ada
            let cleanCityName = cityName.replace(/^(KOTA |KABUPATEN |KAB\. )/i, '');
            locationInput.value = cleanCityName;
        } else {
            locationInput.value = '';
        }

        if (cityId) {
            try {
                const response = await fetch(`${API_BASE}/districts/${cityId}.json`);
                const districts = await response.json();
                districts.forEach(dist => {
                    kecSelect.innerHTML += `<option value="${dist.name}" data-id="${dist.id}">${dist.name}</option>`;
                });
                kecSelect.disabled = false;
            } catch (error) {
                console.error('Error loading districts:', error);
            }
        }
    });

    // Load Villages
    document.getElementById('kecamatan').addEventListener('change', async function() {
        const selectedOption = this.options[this.selectedIndex];
        const distId = selectedOption.dataset.id;
        const kelSelect = document.getElementById('kelurahan');

        // Reset dependent dropdown
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        kelSelect.disabled = true;

        if (distId) {
            try {
                const response = await fetch(`${API_BASE}/villages/${distId}.json`);
                const villages = await response.json();
                villages.forEach(vil => {
                    kelSelect.innerHTML += `<option value="${vil.name}">${vil.name}</option>`;
                });
                kelSelect.disabled = false;
            } catch (error) {
                console.error('Error loading villages:', error);
            }
        }
    });

    function clearSignature(padNumber) {
        if (padNumber === 1) {
            signaturePad1.clear();
        } else {
            signaturePad2.clear();
        }
    }

    function addDevice() {
        const container = document.getElementById('devices-container');
        const html = `
            <div class="device-row mb-3 p-3 border rounded bg-light">
                <div class="row">
                    <div class="col-md-5 mb-2">
                        <label class="form-label">Device Name <span class="text-danger">*</span></label>
                        <input type="text" name="devices[${deviceIndex}][device_name]" class="form-control" placeholder="Masukkan nama device" required>
                    </div>
                    <div class="col-md-5 mb-2">
                        <label class="form-label">Serial Number <span class="text-danger">*</span></label>
                        <input type="text" name="devices[${deviceIndex}][serial_number]" class="form-control" placeholder="Masukkan serial number" required>
                    </div>
                    <div class="col-md-2 mb-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove-device w-100" onclick="removeDevice(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-box me-1"></i> Foto Produk <span class="text-danger">*</span></label>
                        <input type="file" name="devices[${deviceIndex}][product_photo]" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                        <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-sticky-note me-1"></i> Keterangan <span class="text-danger">*</span></label>
                        <textarea name="devices[${deviceIndex}][keterangan]" class="form-control" rows="2" placeholder="Masukkan keterangan device..." required></textarea>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        deviceIndex++;
        updateRemoveButtons();
    }

    function removeDevice(btn) {
        btn.closest('.device-row').remove();
        updateRemoveButtons();
    }

    function updateRemoveButtons() {
        const rows = document.querySelectorAll('.device-row');
        rows.forEach((row, index) => {
            const btn = row.querySelector('.btn-remove-device');
            btn.disabled = rows.length === 1;
        });
    }

    function selectAssessment(element, value) {
        document.querySelectorAll('.assessment-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        element.classList.add('selected');
        element.querySelector('input').checked = true;
    }

    // Form validation before submit
    document.getElementById('onSiteForm').addEventListener('submit', function(e) {
        // Validate at least one activity is checked
        const activityCheckboxes = document.querySelectorAll('.activity-checkbox');
        const isAnyActivityChecked = Array.from(activityCheckboxes).some(cb => cb.checked);
        
        if (!isAnyActivityChecked) {
            e.preventDefault();
            document.getElementById('activity-error').style.display = 'block';
            document.getElementById('activity-group').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        } else {
            document.getElementById('activity-error').style.display = 'none';
        }

        // Validate signatures
        if (signaturePad1.isEmpty()) {
            e.preventDefault();
            alert('Tanda tangan Pihak Pertama wajib diisi!');
            document.getElementById('signaturePad1').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }
        
        if (signaturePad2.isEmpty()) {
            e.preventDefault();
            alert('Tanda tangan Pihak Kedua wajib diisi!');
            document.getElementById('signaturePad2').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }

        // Save signature data
        document.getElementById('signature_first_party').value = signaturePad1.toDataURL();
        document.getElementById('signature_second_party').value = signaturePad2.toDataURL();
    });

    // Hide activity error when any checkbox is checked
    document.querySelectorAll('.activity-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            const isAnyChecked = Array.from(document.querySelectorAll('.activity-checkbox')).some(c => c.checked);
            document.getElementById('activity-error').style.display = isAnyChecked ? 'none' : 'block';
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jihan Saniyya\ratingPGN-app\resources\views/forms/create.blade.php ENDPATH**/ ?>
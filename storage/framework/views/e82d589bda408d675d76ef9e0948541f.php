<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Rating Customer - Gasnet'); ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            font-size: 14px;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            border-right: 1px solid #e0e0e0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
        }

        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
            background: #fff;
        }

        .sidebar-brand h2 {
            color: #2e6b8a;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        .sidebar-brand small {
            color: #666;
            font-size: 0.75rem;
        }

        .sidebar-menu {
            padding: 15px 0;
        }

        .menu-label {
            color: #999;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 20px 8px;
            font-weight: 600;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #555;
            text-decoration: none;
            transition: all 0.2s;
            gap: 12px;
            font-size: 0.9rem;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #2e6b8a;
            color: #fff;
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* Content Wrapper */
        .content-wrapper {
            padding: 25px;
        }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .page-title {
            color: #343a40;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .page-title i {
            color: #6c757d;
        }

        /* Cards */
        .card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 20px;
            font-weight: 600;
            color: #495057;
        }

        .card-body {
            padding: 20px;
        }

        /* Stat Cards */
        .stat-card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .stat-card.primary {
            border-left: 4px solid #0d6efd;
        }

        .stat-card.success {
            border-left: 4px solid #198754;
        }

        .stat-card.warning {
            border-left: 4px solid #ffc107;
        }

        .stat-card.danger {
            border-left: 4px solid #dc3545;
        }

        .stat-card.info {
            border-left: 4px solid #0dcaf0;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #343a40;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #6c757d;
        }

        /* Form Section */
        .form-section {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .form-section-title {
            color: #343a40;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0d6efd;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section-title i {
            color: #0d6efd;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 6px;
        }

        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 10px 12px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }

        /* Buttons */
        .btn {
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
        }

        /* Table */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8f9fa;
            color: #495057;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
            padding: 12px 15px;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-color: #e9ecef;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        /* Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        /* Assessment Options */
        .assessment-option {
            cursor: pointer;
            padding: 20px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            text-align: center;
            transition: all 0.2s;
        }

        .assessment-option:hover {
            border-color: #0d6efd;
        }

        .assessment-option.selected {
            border-color: #0d6efd;
            background: rgba(13, 110, 253, 0.05);
        }

        .assessment-option i {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .assessment-option.tidak-puas i { color: #dc3545; }
        .assessment-option.puas i { color: #ffc107; }
        .assessment-option.sangat-puas i { color: #198754; }

        .assessment-option input {
            display: none;
        }

        /* Signature Pad */
        .signature-pad {
            background: #fff;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 10px;
        }

        .signature-pad canvas {
            width: 100%;
            height: 150px;
            border-radius: 6px;
        }

        /* Alerts */
        .alert {
            border-radius: 6px;
            padding: 12px 16px;
        }
        
        /* Alert Notification Styles */
        .alert-notification {
            border: none;
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            animation: slideInDown 0.5s ease-out;
        }
        
        .alert-notification .alert-icon {
            opacity: 0.9;
        }
        
        .alert-notification.alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-left: 5px solid #28a745;
        }
        
        .alert-notification.alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            border-left: 5px solid #dc3545;
        }
        
        .alert-notification.alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeeba 100%);
            border-left: 5px solid #ffc107;
        }
        
        .alert-notification.alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            border-left: 5px solid #17a2b8;
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Print Styles */
        @media print {
            .sidebar, .no-print {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
            }
            .card {
                box-shadow: none !important;
                border: 1px solid #000 !important;
            }
            body {
                background: #fff !important;
            }
            .content-wrapper {
                padding: 0 !important;
            }
        }

        <?php echo $__env->yieldPushContent('styles'); ?>
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-brand">
            <img src="<?php echo e(asset('images/logoGASNET.png')); ?>" alt="Gasnet" style="max-width: 150px; margin-bottom: 10px;">
            <h2>On-Site Gasnet</h2>
            <small>PT Telemedia Dinamika Sarana</small>
        </div>
        <div class="sidebar-menu">
            <div class="menu-label">Menu</div>
            <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="<?php echo e(route('forms.index')); ?>" class="<?php echo e(request()->routeIs('forms.*') || request()->routeIs('reports.*') ? 'active' : ''); ?>">
                <i class="fas fa-clipboard-list"></i>
                Data Formulir
            </a>
            
            <?php if(auth()->user()->isAdmin()): ?>
            <div class="menu-label">Admin</div>
            <a href="<?php echo e(route('users.index')); ?>" class="<?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>">
                <i class="fas fa-users"></i>
                Kelola Petugas
            </a>
            <?php endif; ?>
            
            <div class="menu-label">Akun</div>
            <a href="<?php echo e(route('password.change')); ?>" class="<?php echo e(request()->routeIs('password.*') ? 'active' : ''); ?>">
                <i class="fas fa-key"></i>
                Ubah Password
            </a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-wrapper">
            <!-- Alert Notifications -->
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show alert-notification" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon me-3">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="alert-heading mb-1 fw-bold">Berhasil!</h6>
                            <p class="mb-0"><?php echo e(session('success')); ?></p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show alert-notification" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon me-3">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="alert-heading mb-1 fw-bold">Terjadi Kesalahan!</h6>
                            <p class="mb-0"><?php echo e(session('error')); ?></p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('warning')): ?>
                <div class="alert alert-warning alert-dismissible fade show alert-notification" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon me-3">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="alert-heading mb-1 fw-bold">Perhatian!</h6>
                            <p class="mb-0"><?php echo e(session('warning')); ?></p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('info')): ?>
                <div class="alert alert-info alert-dismissible fade show alert-notification" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon me-3">
                            <i class="fas fa-info-circle fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="alert-heading mb-1 fw-bold">Informasi</h6>
                            <p class="mb-0"><?php echo e(session('info')); ?></p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
        
        <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Auto-hide alerts after 5 seconds -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-notification');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Jihan Saniyya\ratingPGN-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>
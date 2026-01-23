

<?php $__env->startSection('title', 'Daftar Petugas'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-users"></i>
        Daftar Petugas
    </h1>
    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Petugas
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form action="<?php echo e(route('users.index')); ?>" method="GET" class="row align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari nama atau email petugas..." value="<?php echo e(request('search')); ?>">
                    <button class="btn btn-sm btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <?php if(request('search')): ?>
                        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Dibuat</th>
                        <th class="text-center" style="min-width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($users->firstItem() + $index); ?></td>
                        <td>
                            <strong><?php echo e($user->name); ?></strong>
                        </td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->created_at->format('d/m/Y H:i')); ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-outline-secondary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-secondary" title="Hapus" 
                                        onclick="confirmDelete(<?php echo e($user->id); ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-<?php echo e($user->id); ?>" action="<?php echo e(route('users.destroy', $user)); ?>" 
                                  method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-users fa-4x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Belum ada data petugas</h5>
                            <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary mt-2">
                                <i class="fas fa-plus me-2"></i> Tambah Petugas Pertama
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if($users->hasPages()): ?>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Menampilkan <?php echo e($users->firstItem() ?? 0); ?> - <?php echo e($users->lastItem() ?? 0); ?> dari <?php echo e($users->total()); ?> data
            </div>
            <?php echo e($users->withQueryString()->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus akun petugas ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jihan Saniyya\ratingPGN-app\resources\views/users/index.blade.php ENDPATH**/ ?>
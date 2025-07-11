

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Detail Mahasiswa</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> <?php echo e($mahasiswa->nama); ?></p>
            <p><strong>NIM:</strong> <?php echo e($mahasiswa->nim); ?></p>
            <p><strong>Email:</strong> <?php echo e($mahasiswa->email); ?></p>
            <p><strong>Fakultas:</strong> <?php echo e($mahasiswa->fakultas->nama); ?></p>
            <p><strong>Jurusan:</strong> <?php echo e($mahasiswa->jurusan->nama_jurusan); ?></p>
            <a href="<?php echo e(route('mahasiswa.index')); ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sistem-keanggotaan\resources\views/mahasiswa/show.blade.php ENDPATH**/ ?>
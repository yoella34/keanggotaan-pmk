

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Mahasiswa</h1>

    <form action="<?php echo e(route('mahasiswa.update', $mahasiswa->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo e($mahasiswa->nama); ?>" required>
        </div>

        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" value="<?php echo e($mahasiswa->nim); ?>" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e($mahasiswa->email); ?>" required>
        </div>

        <div class="mb-3">
            <label>Fakultas</label>
            <select name="fakultas" id="fakultas" class="form-control" required>
                <?php $__currentLoopData = $fakultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($f->nama); ?>" <?php echo e($mahasiswa->fakultas->nama == $f->nama ? 'selected' : ''); ?>>
                        <?php echo e($f->nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Jurusan</label>
            <select name="jurusan" id="jurusan" class="form-control" required>
                <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($j->nama_jurusan); ?>" <?php echo e($mahasiswa->jurusan->nama_jurusan == $j->nama_jurusan ? 'selected' : ''); ?>>
                        <?php echo e($j->nama_jurusan); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="<?php echo e(route('mahasiswa.index')); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- Tambahkan Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#fakultas').select2({
            tags: true,
            placeholder: "-- Pilih atau ketik fakultas --",
            allowClear: true
        });

        $('#jurusan').select2({
            tags: true,
            placeholder: "-- Pilih atau ketik jurusan --",
            allowClear: true
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sistem-keanggotaan\resources\views/mahasiswa/edit.blade.php ENDPATH**/ ?>
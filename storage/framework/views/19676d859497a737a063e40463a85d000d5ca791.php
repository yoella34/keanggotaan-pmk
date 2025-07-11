

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Tambah Mahasiswa</h1>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan saat mengisi form:<br><br>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('mahasiswa.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo e(old('nama')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control" value="<?php echo e(old('nim')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="fakultas_id" class="form-label">Fakultas</label>
            <select name="fakultas_id" id="fakultas_id" class="form-control" required>
                <option value="">-- Pilih Fakultas --</option>
                <?php $__currentLoopData = $fakultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($f->id); ?>" <?php echo e(old('fakultas_id') == $f->id ? 'selected' : ''); ?>><?php echo e($f->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="form-control" required <?php echo e(old('jurusan_id') ? '' : 'disabled'); ?>>
                <?php if(old('jurusan_id')): ?>
                    
                    <?php
                        $jurusans = \App\Models\Jurusan::where('fakultas_id', old('fakultas_id'))->get();
                    ?>
                    <option value="">-- Pilih Jurusan --</option>
                    <?php $__currentLoopData = $jurusans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($jur->id); ?>" <?php echo e(old('jurusan_id') == $jur->id ? 'selected' : ''); ?>>
                            <?php echo e($jur->nama_jurusan); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <option value="">-- Pilih Fakultas terlebih dahulu --</option>
                <?php endif; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo e(route('mahasiswa.index')); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#fakultas_id').on('change', function () {
            let fakultasId = $(this).val();
            let jurusanSelect = $('#jurusan_id');

            jurusanSelect.html('<option value="">Loading...</option>').prop('disabled', true);

            if (fakultasId) {
                $.ajax({
                    url: '/get-jurusan/' + fakultasId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        jurusanSelect.empty().append('<option value="">-- Pilih Jurusan --</option>');
                        $.each(data, function (index, jurusan) {
                            jurusanSelect.append('<option value="' + jurusan.id + '">' + jurusan.nama_jurusan + '</option>');
                        });
                        jurusanSelect.prop('disabled', false);
                    },
                    error: function () {
                        jurusanSelect.html('<option value="">Gagal memuat data jurusan</option>').prop('disabled', true);
                    }
                });
            } else {
                jurusanSelect.html('<option value="">-- Pilih Fakultas terlebih dahulu --</option>').prop('disabled', true);
            }
        });

        // Pastikan jurusan tidak disabled saat submit
        $('form').on('submit', function () {
            $('#jurusan_id').prop('disabled', false);
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sistem-keanggotaan\resources\views/mahasiswa/create.blade.php ENDPATH**/ ?>
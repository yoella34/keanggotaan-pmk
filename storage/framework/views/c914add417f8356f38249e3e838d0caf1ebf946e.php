

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Sistem Keanggotaan PMK</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mb-3">
        <form action="<?php echo e(route('mahasiswa.index')); ?>" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari nama atau NIM..." value="<?php echo e(request('search')); ?>">
            <button class="btn btn-primary">Cari</button>
        </form>
        <a href="<?php echo e(route('mahasiswa.create')); ?>" class="btn btn-success">+ Tambah Mahasiswa</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Fakultas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($mhs->nama); ?></td>
                <td><?php echo e($mhs->nim); ?></td>
                <td><?php echo e($mhs->email); ?></td>
                <td>
                    <input type="text" 
                           value="<?php echo e($mhs->jurusan->nama_jurusan ?? '-'); ?>" 
                           class="form-control form-control-sm edit-field" 
                           data-id="<?php echo e($mhs->id); ?>" 
                           data-field="jurusan">
                </td>
                <td>
                    <input type="text" 
                           value="<?php echo e($mhs->fakultas->nama ?? '-'); ?>" 
                           class="form-control form-control-sm edit-field" 
                           data-id="<?php echo e($mhs->id); ?>" 
                           data-field="fakultas">
                </td>
                <td>
                    <a href="<?php echo e(route('mahasiswa.show', $mhs->id)); ?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="<?php echo e(route('mahasiswa.edit', $mhs->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?php echo e(route('mahasiswa.destroy', $mhs->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="text-center">Belum ada data mahasiswa.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        <?php echo e($mahasiswa->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('.edit-field').on('change', function() {
            let id = $(this).data('id');
            let field = $(this).data('field');
            let value = $(this).val();

            $.ajax({
                url: '<?php echo e(route("mahasiswa.updateField")); ?>',
                type: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    id: id,
                    field: field,
                    value: value
                },
                success: function(response) {
                    if (response.success) {
                        alert('Berhasil update ' + field);
                    } else {
                        alert('Gagal update');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan.');
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sistem-keanggotaan\resources\views/mahasiswa/index.blade.php ENDPATH**/ ?>
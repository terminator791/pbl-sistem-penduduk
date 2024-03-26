<?php $__env->startSection('heading'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Warga</h3>
                <p class="text-subtitle text-muted">
                    Rekap data warga asli
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Warga
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Warga Asli</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Rekap Data Warga Asli RT
                </h5>
                <button class="btn btn-primary btn-sm" onclick="window.print()">
                    <i class="fas fa-print"></i>
                    Cetak
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php $__currentLoopData = $penduduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tbody>
                            <tr>
                                <td><?php echo e($p->id); ?></td>
                                <td><?php echo e($p->NIK); ?></td>
                                <td><?php echo e($p->nama); ?></td>
                                <td><?php echo e($p->nama_jalan); ?></td>
                                <td>
                                    <!-- Tombol Toggle Edit -->
                                    <a href="<?php echo e(route('wargaAsli.update')); ?>" class="btn btn-sm btn-warning toggle-edit"
                                        data-toggle="modal">
                                        <i class="bi bi-pencil-fill text-white"></i>
                                    </a>
                                    <!-- Tombol Hapus -->
                                    <a href="<?php echo e(route('wargaAsli.delete')); ?>" class="btn btn-sm btn-danger toggle-delete"
                                        data-toggle="modal">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                               
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>

    </section>
    

    <!-- Floating Toggle -->
    <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="<?php echo e(route('wargaAsli.create')); ?>" class="btn btn-primary rounded-pill btn-lg toggle-data"
            data-toggle="modal" data-target="#tambahDataModal">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    <!-- End Floating Toggle -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default-ui', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\rudeus\Laravel\pbl-project-sistem-kependudukan\resources\views/dataWarga/wargaAsli/index.blade.php ENDPATH**/ ?>
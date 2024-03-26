<!-- resources/views/warga/index.blade.php -->

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Penduduk</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tempat Lahir</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">Pekerjaan</th>
                                    <th scope="col">Status Penghuni</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $penduduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($p->NIK); ?></td>
                                        <td><?php echo e($p->nama); ?></td>
                                        <td><?php echo e($p->jenis_kelamin); ?></td>
                                        <td><?php echo e($p->tempat_lahir); ?></td>
                                        <td><?php echo e($p->tanggal_lahir); ?></td>
                                        <td><?php echo e($p->agama); ?></td>
                                        <td><?php echo e($p->pekerjaan->jenis_pekerjaan); ?></td>
                                        <td><?php echo e($p->status_penghuni); ?></td>
                                        <td><?php echo e($p->no_hp); ?></td>
                                        <td><?php echo e($p->email); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Data Warga - Menu: <?php echo e($menu); ?></div>
                    <div class="card-body">
                        <h1>Daftar RT Penduduk</h1>
                        <!-- Your content goes here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\Users\rudeus\Laravel\pbl-project-sistem-kependudukan\resources\views/warga/index.blade.php ENDPATH**/ ?>
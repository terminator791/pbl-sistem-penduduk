<?php $__env->startSection('heading'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kos</h3>
                <p class="text-subtitle text-muted">
                    Rekap data kos
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Kos
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Bangunan Kos</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" data-parsley-validate>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">Nama Kos</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Nama kos" name="fname-column" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Pemilik</label>
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Pemilik" name="lname-column" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="city-column" class="form-label">Jumlah Penghuni</label>
                                            <input type="text" id="city-column" class="form-control"
                                                placeholder="Jumlah penghuni" name="city-column"
                                                data-parsley-restricted-city="Jakarta" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="country-floating" class="form-label">Alamat Kos</label>
                                            <input type="text" id="country-floating" class="form-control"
                                                name="country-floating" placeholder="Alamat kos"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <a href='<?php echo e(route('dataKos')); ?>' type="submit"
                                                class="btn btn-primary me-1 mb-1">
                                                Submit
                                            </a>
                                            <a type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                Reset
                                            </a>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default-ui', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\rudeus\Laravel\pbl-project-sistem-kependudukan\resources\views/dataKos/create.blade.php ENDPATH**/ ?>
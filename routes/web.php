<?php

use App\Http\Controllers\dataKosController;
use App\Http\Controllers\kesehatan;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\wargaAsliController;
use App\Http\Controllers\wargaPendatangController;
use App\Http\Controllers\ProfileController;

use App\Models\keluarga;
use App\Models\kos;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\penjabatan_RT;
use App\Models\RT;
use App\Models\bantuan;
use Illuminate\Support\Facades\Route;


Route::get('/home',[PendudukController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('/chart_fetch',[PendudukController::class, 'fetchData'])->name('chart.fetchData');
Route::get('/fetchKesehatanData',[PendudukController::class, 'fetchKesehatanData'])->name('chart.fetchKesehatanData');
Route::get('/fetchKejadianData',[PendudukController::class, 'fetchKejadianData'])->name('chart.fetchKejadianData');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/tambah-pengurus', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile/store-pengurus', [ProfileController::class, 'store'])->name('profile.store');
    Route::post('/update-profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/ganti_sandi_profile', [ProfileController::class, 'ganti_sandi_profile'])->name('profile.ganti_sandi_profile');
    Route::post('/check_password', [ProfileController::class, 'check_password'])->name('profile.check_password');
    Route::get('/kelola_akun', [ProfileController::class, 'kelola_akun'])->name('profile.kelola_akun');
    Route::get('/toggle-status-user/{id}', [ProfileController::class, 'toggle_status'])->name('profile.toggle_status');
    Route::get('/update-data-ketua/{id}', [ProfileController::class, 'updateKetua'])->name('profile.updateKetua');
    Route::get('/delete_akun/{id}', [ProfileController::class, 'delete_akun'])->name('profile.delete_akun');

    Route::post('/ganti_sandi', [ProfileController::class, 'ganti_sandi'])->name('profile.ganti_sandi');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Data Kos
    Route::get('/dataKos-print', [dataKosController::class, 'print'])->name('dataKos.print');
    Route::middleware(['LevelMiddleware'])->prefix('dataKos')->group(function (){
        Route::get('/', [dataKosController::class, 'index'])->name('dataKos');
        Route::post('/store-kos', [dataKosController::class, 'store'])->name('dataKos.store');
        Route::get('/edit-data-kos/{id}', [dataKosController::class, 'edit'])->name('dataKos.edit');
        Route::get('/toggle-status-data-kos/{id}', [dataKosController::class, 'toggle_status'])->name('dataKos.toggle_status');
        Route::post('/update-data-kos/{id}', [dataKosController::class, 'update'])->name('dataKos.update');
        Route::get('/hapus-kos/{id}', [dataKosController::class, 'delete'])->name('dataKos.delete');
        Route::get('/tambah-kos', [dataKosController::class, 'create'])->name('dataKos.create');
        Route::get('/penghuni-kos/{id}', [dataKosController::class, 'penghuni'])->name('dataKos.penghuniKos');
        Route::get('/penghuni-kos/edit-data-penghuni/{id}', [dataKosController::class, 'edit'])->name('dataKos.penghuniKos.edit');
        Route::get('/penghuni-kos/update-data-penghuni/{id}', [dataKosController::class, 'updatePenghuni'])->name('dataKos.penghuniKos.update');
        Route::get('/penghuni-kos/edit-delete-penghuni/{id}', [dataKosController::class, 'delete_penghuni'])->name('dataKos.penghuniKos.delete');
    });


// Data Warga Asli
    Route::middleware(['LevelMiddleware'])->group(function (){
        //Middleware agar hanya Ketua RT yang berhak mengubah data warga asli
        Route::get('/wargaAsli/tambah-warga-asli', [wargaAsliController::class, 'create'])->name('wargaAsli.create');
        Route::post('/wargaAsli/store-warga-asli', [wargaAsliController::class, 'simpan'])->name("wargaAsli.store");
        Route::get('/wargaAsli/edit-data-warga-asli/{id}', [wargaAsliController::class, 'edit'])->name('wargaAsli.edit');
        Route::post('/wargaAsli/update-data-warga-asli/{id}', [wargaAsliController::class, 'update'])->name('wargaAsli.update');
        Route::get('/wargaAsli/hapus-data-warga-asli/{id}', [wargaAsliController::class, 'delete'])->name('wargaAsli.delete');
    });
    Route::get('/wargaAsli', [wargaAsliController::class, 'index'])->name('wargaAsli');
    Route::get('/wargaAsli/print', [wargaAsliController::class, 'print'])->name('wargaAsli.print');
    Route::get('/wargaAsli-fetchAll', [wargaAsliController::class, 'fetchAll'])->name("wargaAsli.fetchAll");

// Data Warga Pendatang
    Route::middleware(['LevelMiddleware'])->group(function () {
        //Middleware agar hanya Ketua RT yang berhak mengubah data warga pendatang
        Route::get('/wargaPendatang/tambah-warga-pendatang', [wargaPendatangController::class, 'create'])->name('wargaPendatang.create');
        Route::post('/wargaPendatang/store-warga-pendatang', [wargaPendatangController::class, 'store'])->name("wargaPendatang.store");
        Route::get('/wargaPendatang/edit-data-warga-pendatang/{id}', [wargaPendatangController::class, 'edit'])->name('wargaPendatang.edit');
        Route::post('/wargaPendatang/update-data-warga-pendatang/{id}', [wargaPendatangController::class, 'update'])->name('wargaPendatang.update');
        Route::get('/wargaPendatang/hapus-data-warga-pendatang/{id}', [wargaPendatangController::class, 'delete'])->name('wargaPendatang.delete');
    });
    Route::get('/wargaPendatang', [wargaPendatangController::class, 'index'])->name('wargaPendatang');
    Route::get('/wargaPendatang/print', [WargaPendatangController::class, 'print'])->name('wargaPendatang.print');
    Route::get('/wargaPendatang/fetchAll', [wargaPendatangController::class, 'fetchAll'])->name("wargaPendatang.fetchAll");


// Kesehatan
    Route::get('/kesehatan', [KesehatanController::class, 'index'])->name('kesehatan');
    Route::middleware('LevelMiddleware')->group(function () {
        Route::get('/daftar_kesehatan', [KesehatanController::class, 'create']);
        Route::post('/kesehatan/store-kesehatan', [KesehatanController::class, 'store'])->name("kesehatan.store");
        Route::get('/kesehatan/hapus-kesehatan/{id}', [KesehatanController::class, 'delete'])->name('kesehatan.delete');
        Route::get('/toggle-status-kesehatan/{id}', [KesehatanController::class, 'toggle_status'])->name('kesehatan.toggle_status');
    });
    Route::get('/kesehatan/{penyakit}/print', [KesehatanController::class, 'print'])->name('kesehatan.print');

// kejadian
    Route::get('/kejadian', [KejadianController::class, 'index'])->name('kejadian');
    Route::middleware('LevelMiddleware')->group(function (){
        Route::post('/kejadian/store-kejadian', [KejadianController::class, 'store'])->name("kejadian.store");
        Route::get('/toggle-status-kejadian/{id}', [KejadianController::class, 'toggle_status'])->name('kejadian.toggle_status');
        Route::get('/kejadian/hapus-kejadian/{id}', [KejadianController::class, 'delete'])->name('kejadian.delete');
    });
    Route::get('/kejadian/{jenis_kejadian}/print', [KejadianController::class, 'print'])->name('kejadian.print');
    Route::get('/daftar_kejadian', [KejadianController::class, 'create']);
    Route::post('/tambah_kejadian', [KejadianController::class, 'store'])->name("kejadian.add");

// pendidikan
Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('pendidikan');
Route::get('/pendidikan/tambah-pendidikan/{id}', [PendidikanController::class, 'create'])->name('pendidikan.create');
Route::post('/pendidikan/store-pendidikan/{id}', [PendidikanController::class, 'store'])->name('pendidikan.store');
Route::get('/pendidikan/hapus-pendidikan/{id}', [PendidikanController::class, 'delete'])->name('pendidikan.delete');
Route::get('/pendidikan/{pendidikan}/print', [PendidikanController::class, 'print'])->name('pendidikan.print');

// Bantuan
    Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan');
    Route::middleware('LevelMiddleware')->group(function (){
        Route::post('/bantuan/store-bantuan', [BantuanController::class, 'store'])->name("bantuan.store");
        Route::get('/bantuan/hapus-bantuan/{id}', [BantuanController::class, 'delete'])->name('bantuan.delete');
    });
    Route::get('/bantuan/{bantuan}/print', [BantuanController::class, 'print'])->name('bantuan.print');
    Route::get('/bantuan', [BantuanController::class, 'index'])->name("bantuan");
    Route::get('/daftar_bantuan', [BantuanController::class, 'create']);
    Route::post('/tambah_bantuan', [BantuanController::class, 'store'])->name("bantuan.add");

    //penjabatan rt
    Route::middleware('LevelMiddleware')->group(function (){
        Route::get('/daftar-rt', [ProfileController::class, 'tampil'])->name('jabatan');
        Route::get('/toggle_tanggal_RT/{id}', [ProfileController::class, 'toggle_tanggal'])->name('toggle_tanggal_RT');
        Route::get('/delete_ketua/{id}', [ProfileController::class, 'delete_ketua'])->name('delete_ketua');
        Route::post('/update-foto-ketua/{id}', [ProfileController::class, 'updateFotoKetua'])->name('update-foto-ketua');
        // routes/web.php
        Route::post('change_password', [ProfileController::class, 'changePassword'])->name('change_password');



    });
});

require __DIR__.'/auth.php';


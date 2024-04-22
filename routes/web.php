<?php

use App\Http\Controllers\BantuanController;
use App\Http\Controllers\dataKosController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\kesehatan;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\BencanaController;
use App\Http\Controllers\SosialController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\wargaAsliController;
use App\Http\Controllers\wargaPendatangController;
use App\Models\keluarga;
use App\Models\kos;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\penjabatan_RT;
use App\Models\RT;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::get('/', [PendudukController::class, 'index'])->name('default');

Route::get('/home', [PendudukController::class, 'index'])->name('home');

//Tambah Penduduk/Warga tetap
Route::get('/data_warga', [PendudukController::class, 'create']);
Route::post('/tambah_warga', [PendudukController::class, 'store'])->name("penduduk");

//Kesehatan
Route::get('/kesehatan', [KesehatanController::class, 'index'])->name("kesehatan");
Route::get('/daftar_kesehatan', [KesehatanController::class, 'create']);
Route::post('/tambah_kesehatan', [KesehatanController::class, 'store'])->name("kesehatan.add");




Route::get('/dataKos/tambah-kos', [dataKosController::class, 'create'])->name('dataKos.create');
Route::post('/dataKos/store-kos', [dataKosController::class, 'store'])->name('dataKos.store');
Route::get('/dataKos', [dataKosController::class, 'index'])->name('dataKos');
Route::get('/dataKos/edit-data-kos/{id}', [dataKosController::class, 'edit'])->name('dataKos.edit');
Route::post('/dataKos/update-data-kos/{id}', [dataKosController::class, 'update'])->name('dataKos.update');
Route::get('/dataKos/hapus-kos/{id}', [dataKosController::class, 'delete'])->name('dataKos.delete');

// Data Warga Asli
Route::get('/wargaAsli', [wargaAsliController::class, 'index'])->name('wargaAsli');
Route::get('/wargaAsli/tambah-warga-asli', [wargaAsliController::class, 'create'])->name('wargaAsli.create');
Route::get('/wargaAsli/edit-data-warga-asli/{id}', [wargaAsliController::class, 'edit'])->name('wargaAsli.edit');
Route::post('/wargaAsli/update-data-warga-asli/{id}', [wargaAsliController::class, 'update'])->name('wargaAsli.update');
Route::get('/wargaAsli/hapus-data-warga-asli/{id}', [wargaAsliController::class, 'delete'])->name('wargaAsli.delete');
Route::get('/wargaAsli/print', [wargaAsliController::class, 'print'])->name('wargaAsli.print');
Route::get('/wargaAsli/getAllWarga', [wargaAsliController::class, 'showAllWarga'])->name('wargaAsli.getAllWarga');


// Data Warga Pendatang
Route::get('/wargaPendatang/tambah-warga-pendatang', [App\Http\Controllers\wargaPendatangController::class, 'create'])->name('wargaPendatang.create');
Route::get('/wargaPendatang', [App\Http\Controllers\wargaPendatangController::class, 'index'])->name('wargaPendatang');
Route::get('/wargaPendatang/edit-data-warga-pendatang', [App\Http\Controllers\wargaPendatangController::class, 'update'])->name('wargaPendatang.update');
Route::get('/wargaPendatang/hapus-data-warga-pendatang', [App\Http\Controllers\wargaPendatangController::class, 'delete'])->name('wargaPendatang.delete');

//Data Profil
Route::get('/login', [App\Http\Controllers\AuthloginController::class, 'index'])->name('login');

//profile
Route::get('/profile', [App\Http\Controllers\profileController::class, 'index'])->name('profile');
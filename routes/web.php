<?php

use App\Http\Controllers\dataKosController;
use App\Http\Controllers\kesehatan;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\wargaAsliController;
use App\Http\Controllers\wargaPendatangController;
use App\Models\keluarga;
use App\Models\kos;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\penjabatan_RT;
use App\Models\RT;
use Illuminate\Support\Facades\Route;



Route::get('/', [PendudukController::class, 'index'])->name('home');
//route untuk Penddikan
Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('edu');
Route::get('/tambah_pendidkan', [PendidikanController::class, 'create'])->name('logout');
Route::get('/tambah_pendidikan/save', [PendidikanController::class, 'store'])->name("pendidikan.add");

//Tambah Penduduk/Warga tetap
Route::get('/data_warga', [PendudukController::class, 'create']);
Route::post('/tambah_warga', [PendudukController::class, 'store'])->name("penduduk");

//Kesehatan
Route::get('/kesehatan', [KesehatanController::class, 'index'])->name("kesehatan");
Route::get('/daftar_kesehatan', [KesehatanController::class, 'create']);
Route::post('/tambah_kesehatan', [KesehatanController::class, 'store'])->name("kesehatan.add");


Route::get('/warga-json', function () {

    $penduduks = penduduk::all();
    $data = [];

    foreach ($penduduks as $penduduk) {
        $data[] = [
            'NIK ' => $penduduk->NIK,
            'jenis_kelamin' => $penduduk->jenis_kelamin,
            'nama' => $penduduk->nama,
            'tanggal_lahir' => $penduduk->tanggal_lahir,
            'agama' => $penduduk->agama,
            'id_pendidikan' => $penduduk->id_pendidikan,
            'tempat_lahir' => $penduduk->tempat_lahir,
            'id_rt' => $penduduk->id_rt,
            'id_rw' => $penduduk->id_rw,
            'id_pekerjaan' => $penduduk->id_pekerjaan,
            'id_status_perkawinan' => $penduduk->id_status_perkawinan,
            'nama_jalan' => $penduduk->nama_jalan,
            'id_keluarga' => $penduduk->id_keluarga,
            'status_penghuni' => $penduduk->status_penghuni,
            'no_hp' => $penduduk->no_hp,
            'email' => $penduduk->email,


        ];
    }

    // membuat array dengan kunci "data" dan kumpulan data karyawan di dalamnya
    $json_data = ['data' => $data];

    $json_data = json_encode($json_data, JSON_PRETTY_PRINT);

    $file_path = resource_path('data/table-datatable.json');

    File::put($file_path, $json_data);

    return redirect()->route('wargaAsli')->with('success', 'Penduduk added successfully!');
})->name('warga_json');



// Data Kos
Route::get('/dataKos/tambah-kos', [dataKosController::class, 'create'])->name('dataKos.create');
Route::get('/dataKos', [dataKosController::class, 'index'])->name('dataKos');
Route::get('/dataKos/edit-data-kos', [dataKosController::class, 'edit'])->name('dataKos.edit');
Route::get('/dataKos/update-data-kos', [dataKosController::class, 'update'])->name('dataKos.update');
Route::get('/dataKos/hapus-kos', [dataKosController::class, 'delete'])->name('dataKos.delete');

// Data Warga Asli
Route::get('/wargaAsli/tambah-warga-asli', [wargaAsliController::class, 'create'])->name('wargaAsli.create');
Route::post('/wargaAsli/store-warga-asli', [wargaAsliController::class, 'store'])->name("wargaAsli.store");
Route::get('/wargaAsli', [wargaAsliController::class, 'index'])->name('wargaAsli');
Route::get('/wargaAsli/edit-data-warga-asli/{id}', [wargaAsliController::class, 'edit'])->name('wargaAsli.edit');
Route::post('/wargaAsli/update-data-warga-asli/{id}', [wargaAsliController::class, 'update'])->name('wargaAsli.update');
Route::get('/wargaAsli/hapus-data-warga-asli/{id}', [wargaAsliController::class, 'delete'])->name('wargaAsli.delete');

// Data Warga Pendatang
Route::get('/wargaPendatang/tambah-warga-pendatang', [wargaPendatangController::class, 'create'])->name('wargaPendatang.create');
Route::post('/wargaPendatang/store-warga-pendatang', [wargaPendatangController::class, 'store'])->name("wargaPendatang.store");
Route::get('/wargaPendatang', [wargaPendatangController::class, 'index'])->name('wargaPendatang');
Route::get('/wargaPendatang/edit-data-warga-pendatang/{id}', [wargaPendatangController::class, 'edit'])->name('wargaPendatang.edit');
Route::post('/wargaPendatang/update-data-warga-pendatang/{id}', [wargaPendatangController::class, 'update'])->name('wargaPendatang.update');
Route::get('/wargaPendatang/hapus-data-warga-pendatang/{id}', [wargaPendatangController::class, 'delete'])->name('wargaPendatang.delete');

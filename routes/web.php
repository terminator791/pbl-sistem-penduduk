<?php

use App\Http\Controllers\BantuanController;
use App\Http\Controllers\dataKosController;
use App\Http\Controllers\KejadianController;
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



Route::get('/', [PendudukController::class, 'index'])->name('default');

Route::get('/home', [PendudukController::class, 'index'])->name('home');

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
Route::get('/wargaPendatang/tambah-warga-pendatang', [wargaPendatangController::class, 'create'])->name('wargaPendatang.create');
Route::post('/wargaPendatang/store-warga-pendatang', [wargaPendatangController::class, 'store'])->name("wargaPendatang.store");
Route::get('/wargaPendatang', [wargaPendatangController::class, 'index'])->name('wargaPendatang');
Route::get('/wargaPendatang/edit-data-warga-pendatang/{id}', [wargaPendatangController::class, 'edit'])->name('wargaPendatang.edit');
Route::post('/wargaPendatang/update-data-warga-pendatang/{id}', [wargaPendatangController::class, 'update'])->name('wargaPendatang.update');
Route::get('/wargaPendatang/hapus-data-warga-pendatang/{id}', [wargaPendatangController::class, 'delete'])->name('wargaPendatang.delete');
Route::get('/wargaPendatang/print', [WargaPendatangController::class, 'print'])->name('wargaPendatang.print');



// Kesehatan
Route::get('/kesehatan', [KesehatanController::class, 'index'])->name('kesehatan');
Route::post('/kesehatan/store-kesehatan', [KesehatanController::class, 'store'])->name("kesehatan.store");
Route::get('/kesehatan/hapus-kesehatan/{id}', [KesehatanController::class, 'delete'])->name('kesehatan.delete');
Route::get('/kesehatan/{penyakit}/print', [KesehatanController::class, 'print'])->name('kesehatan.print');


// pendidikan
Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('pendidikan');
Route::get('/pendidikan/tambah-pendidikan/{id}', [PendidikanController::class, 'create'])->name('pendidikan.create');
Route::post('/pendidikan/store-pendidikan/{id}', [PendidikanController::class, 'store'])->name('pendidikan.store');
Route::get('/pendidikan/hapus-pendidikan/{id}', [PendidikanController::class, 'delete'])->name('pendidikan.delete');


// kejadian
Route::get('/kejadian', [KejadianController::class, 'index'])->name('kejadian');
Route::post('/kejadian/store-kejadian', [KejadianController::class, 'store'])->name("kejadian.store");
Route::get('/kejadian/hapus-kejadian/{id}', [KejadianController::class, 'delete'])->name('kejadian.delete');
Route::get('/kejadian/{jenis_kejadian}/print', [KejadianController::class, 'print'])->name('kejadian.print');
Route::get('/kejadian', [KejadianController::class, 'index'])->name("kejadian");
Route::get('/daftar_kejadian', [KejadianController::class, 'create']);
Route::post('/tambah_kejadian', [KejadianController::class, 'store'])->name("kejadian.add");


// Bantuan
Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan');
Route::get('/bantuan', 'BantuanController@index')->name('bantuan.index');
Route::post('/bantuan/store-bantuan', [BantuanController::class, 'store'])->name("bantuan.store");
Route::get('/bantuan/hapus-bantuan/{id}', [BantuanController::class, 'delete'])->name('bantuan.delete');
Route::get('/bantuan/{bantuan}/print', [BantuanController::class, 'print'])->name('bantuan.print');
Route::get('/bantuan', [BantuanController::class, 'index'])->name("bantuan");
Route::get('/daftar_bantuan', [BantuanController::class, 'create']);
Route::post('/tambah_bantuan', [BantuanController::class, 'store'])->name("bantuan.add");


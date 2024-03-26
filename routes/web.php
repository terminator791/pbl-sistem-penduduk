<?php

use App\Http\Controllers\kesehatan;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PendudukController;
use App\Models\keluarga;
use App\Models\kos;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\penjabatan_RT;
use App\Models\RT;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PendudukController::class, 'index'])->name('home');

Route::get('/pendidikan', [PendidikanController::class, 'create'])->name('logout');
Route::get('/pendidikan2', [PendidikanController::class, 'store'])->name("pendidikan");

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
            'avatar' => $penduduk->avatar,
            'jenis_kelamin' => $penduduk->jenis_kelamin,
            'tempat_lahir' => $penduduk->tempat_lahir,
            'id_rt' => $penduduk->id_rt,
            'id_rw' => $penduduk->id_rw,
            'tanggal_lahir' => $penduduk->tanggal_lahir,
            'no_hp' => $penduduk->status_penghuni,
            'email' => $penduduk->email
        ];
    }

    // membuat array dengan kunci "data" dan kumpulan data karyawan di dalamnya
    $json_data = ['data' => $data];

    $json_data = json_encode($json_data, JSON_PRETTY_PRINT);

    $file_path = resource_path('data/table-datatable.json');

    File::put($file_path, $json_data);

    return response()->json(['message' => 'Data berhasil disimpan dalam format JSON.']);
});


Route::get('/tambah-kos', function () {
    $id_kos = kos::find(2);

    $penduduk = penduduk::find(2);

    $penduduk->id_kos = $id_kos->id;
    $penduduk->save();

    echo "SUKSES";
});


Route::get('/cari', function () {
    $nik = '3317120041795';

    // Mencari penduduk berdasarkan NIM
    $penduduk = Penduduk::where('NIK', $nik)->first();

    if ($penduduk) {
        return 'Penduduk dengan NIK ' . $nik . ' ditemukan: ' . $penduduk->nama;
    } else {
        return 'Penduduk dengan NIK ' . $nik . ' tidak ditemukan';
    }
});

// Data Kos
Route::get('/dataKos/tambah-kos', [App\Http\Controllers\dataKosController::class, 'create'])->name('dataKos.create');
Route::get('/dataKos', [App\Http\Controllers\dataKosController::class, 'index'])->name('dataKos');
Route::get('/dataKos/edit-data-kos', [App\Http\Controllers\dataKosController::class, 'update'])->name('dataKos.update');
Route::get('/dataKos/hapus-kos', [App\Http\Controllers\dataKosController::class, 'delete'])->name('dataKos.delete');

// Data Warga Asli
Route::get('/wargaAsli/tambah-warga-asli', [App\Http\Controllers\wargaAsliController::class, 'create'])->name('wargaAsli.create');
Route::get('/wargaAsli', [App\Http\Controllers\wargaAsliController::class, 'index'])->name('wargaAsli');
Route::get('/wargaAsli/edit-data-warga-asli', [App\Http\Controllers\wargaAsliController::class, 'update'])->name('wargaAsli.update');
Route::get('/wargaAsli/hapus-data-warga-asli', [App\Http\Controllers\wargaAsliController::class, 'delete'])->name('wargaAsli.delete');

// Data Warga Pendatang
Route::get('/wargaPendatang/tambah-warga-pendatang', [App\Http\Controllers\wargaPendatangController::class, 'create'])->name('wargaPendatang.create');
Route::get('/wargaPendatang', [App\Http\Controllers\wargaPendatangController::class, 'index'])->name('wargaPendatang');
Route::get('/wargaPendatang/edit-data-warga-pendatang', [App\Http\Controllers\wargaPendatangController::class, 'update'])->name('wargaPendatang.update');
Route::get('/wargaPendatang/hapus-data-warga-pendatang', [App\Http\Controllers\wargaPendatangController::class, 'delete'])->name('wargaPendatang.delete');

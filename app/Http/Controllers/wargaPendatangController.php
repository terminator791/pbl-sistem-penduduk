<?php

namespace App\Http\Controllers;

use App\Models\detail_pendatang;
use App\Models\kos;
use Auth;
use Illuminate\Http\Request;
use App\Models\keluarga;
use App\Models\pekerjaan;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\perkawinan;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Support\Facades\Http;
use DataTables;

class wargaPendatangController extends Controller
{
    public function index(Request $request)
    {
        $menu = $request->query('menu', 'data_warga');
        $penduduk = penduduk::with(['pekerjaan'])
            ->where('status_penghuni', 'kos')
            ->orWhere('status_penghuni', 'kontrak')
            ->get();

        return view('dataWarga.wargaPendatang.index', compact('menu', 'penduduk'));
    }

//     public function fetchAll()
// {
//     $response = Http::withHeaders([
//         'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
//     ])->get('http://localhost:9000/v1/wargaAsli');

//     $data = $response->json();

//     // Filter data sesuai kondisi yang diinginkan
//     $filteredData = collect($data)->filter(function ($item) {
//         return in_array($item['status_penghuni'], ['kos', 'kontrak']);
//     })->values()->all();

//     return $filteredData;
// }


public function fetchAll()
{
    // 1. Ambil NIK pengguna yang saat ini login
    $NIK = Auth::user()->NIK_penduduk;

    // 2. Temukan id_rt dari tabel penduduk berdasarkan NIK pengguna
    $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');

    // 3. Ambil data dari API
    $response = Http::withHeaders([
        'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
    ])->get('http://localhost:9000/v1/wargaAsli');

    // 4. Periksa apakah request berhasil
    if ($response->successful()) {
        $data = $response->json();

        // 5. Filter data sesuai kondisi yang diinginkan
        $filteredData = collect($data)->filter(function ($item) use ($id_rt) {
            return $item['id_rt'] == $id_rt && in_array($item['status_penghuni'], ['kos', 'kontrak']);
        })->values()->all();

        // 6. Mengembalikan data dalam format yang sesuai dengan DataTables
return DataTables::of($filteredData)
->addColumn('action', function ($warga) {
    // Tambahkan tombol aksi di sini sesuai kebutuhan
    return '<a href="' . route('wargaPendatang.edit', $warga['id']) . '" class="btn btn-sm btn-warning toggle-edit" data-toggle="modal">' .
        '<i class="bi bi-pencil-fill text-white"></i>' .
        '</a>&nbsp;&nbsp;' . // Spasi di sini
        '<a href="#" class="btn btn-sm btn-danger toggle-delete" onclick="confirmDelete(' . $warga['id'] . ')">' .
        '<i class="bi bi-trash-fill"></i>' .
        '</a>&nbsp;&nbsp;' . // Spasi di sini
        '<a class="btn btn-sm btn-primary toggle-detail" onclick="showWargaDetail(' . $warga['id'] . ')" data-id="' . $warga['id'] . '">' .
        '<i class="bi bi-eye-fill"></i>' .
        '</a>';
})
->rawColumns(['action']) // Menggunakan rawColumns untuk mengizinkan HTML di dalam kolom aksi
->make(true);

    } else {
        // 7. Jika request gagal, kembalikan pesan error
        return response()->json(['error' => 'Failed to fetch data from API'], 500);
    }
}

public function fetchOne($id)
    {
        // Gunakan double quotes untuk menginterpolasi variabel $id
        $response = Http::withHeaders([
            'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
        ])->get("http://localhost:9000/v1/wargaAsli/$id");

        // Periksa status respons sebelum mengakses data JSON
        if ($response->successful()) {
            $data = $response->json();
            return $data;
        } else {
            // Handle kesalahan, misalnya lempar exception
            throw new Exception("Gagal mengambil data. Kode status: " . $response->status());
        }
    }


    public function Create()
    {
        $list_pendidikan = pendidikan::all();
        $list_pekerjaan = pekerjaan::all();
        $list_perkawinan = perkawinan::all();
        $list_RT = RT::all();
        $list_RW = RW::all();
        $list_keluarga = keluarga::all();
        $list_kos = kos::all();
        return view('dataWarga.wargaPendatang.create', compact(
            'list_pendidikan',
            'list_pekerjaan',
            'list_perkawinan',
            'list_RT',
            'list_RW',
            'list_keluarga',
            'list_kos'
        ));
    }

    public function store(Request $request)
    {
        $penduduk = new penduduk();
        $penduduk->NIK = $request->input('NIK');
        $penduduk->nama = $request->input('nama');
        $penduduk->jenis_kelamin = $request->input('jenis_kelamin');
        $penduduk->tempat_lahir = $request->input('tempat_lahir');
        $penduduk->tanggal_lahir = $request->input('tanggal_lahir');
        $penduduk->agama = $request->input('agama');
        $penduduk->id_pendidikan = $request->input('id_pendidikan');
        $penduduk->id_pekerjaan = $request->input('id_pekerjaan');
        $penduduk->id_rt = $request->input('id_rt');
        $penduduk->id_rw = $request->input('id_rw');
        $penduduk->id_status_perkawinan = $request->input('id_status_perkawinan');
        $penduduk->id_keluarga = $request->input('id_keluarga');
        $penduduk->nama_jalan = "";
        $penduduk->status_penghuni = $request->input('status_penghuni');
        $penduduk->no_hp = $request->input('no_hp');
        $penduduk->email = $request->input('email');
        $penduduk->foto_ktp = $request->input('foto_ktp');

        $penduduk->save();

        $detail_pendatang = new detail_pendatang();
        $detail_pendatang->NIK = $request->input('NIK');
        $detail_pendatang->id_kos = $request->input('id_kos');
        $detail_pendatang->tanggal_masuk = $request->input('tanggal_masuk');
        $detail_pendatang->tanggal_keluar = $request->input('tanggal_keluar');
        $detail_pendatang->save();

        return redirect()->route('wargaPendatang')->with('success', 'Penduduk added successfully!');
    }

    // Update
    public function edit($id)
    {
        $penduduk = penduduk::with('detail_pendatang')->findOrFail($id);
        $detail_pendatang = $penduduk->detail_pendatang()->first();
        $list_pendidikan = pendidikan::all();
        $list_pekerjaan = pekerjaan::all();
        $list_perkawinan = perkawinan::all();
        $list_RT = RT::all();
        $list_RW = RW::all();
        $list_keluarga = keluarga::all();
        $list_kos = kos::all();
        return view('dataWarga.wargaPendatang.update', compact(
            'penduduk',
            'list_pendidikan',
            'list_pekerjaan',
            'list_perkawinan',
            'list_RT',
            'list_RW',
            'list_keluarga',
            'list_kos',
            'detail_pendatang'
        ));
    }

    public function update(Request $request, $id)
    {
        $penduduk = penduduk::where('id', $id)->first();
        $penduduk->NIK = $request->input('NIK');
        $penduduk->nama = $request->input('nama');
        $penduduk->jenis_kelamin = $request->input('jenis_kelamin');
        $penduduk->tempat_lahir = $request->input('tempat_lahir');
        $penduduk->tanggal_lahir = $request->input('tanggal_lahir');
        $penduduk->agama = $request->input('agama');
        $penduduk->id_pendidikan = $request->input('id_pendidikan');
        $penduduk->id_pekerjaan = $request->input('id_pekerjaan');
        $penduduk->id_rt = $request->input('id_rt');
        $penduduk->id_rw = $request->input('id_rw');
        $penduduk->id_status_perkawinan = $request->input('id_status_perkawinan');
        $penduduk->id_keluarga = $request->input('id_keluarga');
        $penduduk->nama_jalan = "";
        $penduduk->status_penghuni = $request->input('status_penghuni');
        $penduduk->no_hp = $request->input('no_hp');
        $penduduk->email = $request->input('email');

        $penduduk->update();

        $detail_pendatang = detail_pendatang::where('NIK', $request->input('NIK'))->first();
        $detail_pendatang->NIK = $request->input('NIK');
        $detail_pendatang->id_kos = $request->input('id_kos');
        $detail_pendatang->tanggal_masuk = $request->input('tanggal_masuk');
        $detail_pendatang->tanggal_keluar = $request->input('tanggal_keluar');
        $detail_pendatang->update();

        return redirect()->route('wargaPendatang')->with('success', 'Penduduk updated successfully!');
    }


    // Delete
    public function delete(Request $request, $id)
    {
        $penduduk = penduduk::findOrFail($id);
        $penduduk->delete();
        return redirect()->route('wargaPendatang')->with('success', 'Penduduk Deleted successfully!');
    }

    //print
    public function print()
    {
        $penduduk = Penduduk::with(['pekerjaan'])
            ->where('status_penghuni', 'kos')
            ->orWhere('status_penghuni', 'kontrak')
            ->get();
        return view('dataWarga.wargaPendatang.print', compact('penduduk'));
    }
}

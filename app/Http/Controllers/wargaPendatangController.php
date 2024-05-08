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
        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
        return view('dataWarga.wargaPendatang.index', compact('id_rt'));
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

     // 2. Temukan id_rw dari tabel penduduk berdasarkan NIK pengguna
     $id_rw = Penduduk::where('NIK', $NIK)->value('id_rw');

     $penduduk = Penduduk::where('NIK', $NIK)->first();

    // 3. Ambil data dari API
    $response = Http::withHeaders([
        'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
    ])->get('http://localhost:9000/v1/wargaAsli');

    // 4. Periksa apakah request berhasil
    if ($response->successful()) {
        $data = $response->json();

        // 6. Tentukan level pengguna saat ini
        $userLevel = Auth::user()->level;
        
          // 5. Filter data sesuai kondisi yang diinginkan
          $filteredData_rt = collect($data)->filter(function ($item) use ($id_rt) {
            return $item['id_rt'] == $id_rt && in_array($item['status_penghuni'], ['kos', 'kontrak']);
        })->values()->all();

        // 5. Filter data sesuai kondisi yang diinginkan
        $filteredData_rw = collect($data)->filter(function ($item) use ($penduduk) {
            return $item['id_rw'] == $penduduk->rw->nama_rw && in_array($item['status_penghuni'], ['kos', 'kontrak']);
        })->values()->all();

        $filteredData_admin = collect($data)->filter(function ($item) use ($id_rt) {
            return  in_array($item['status_penghuni'], ['kos', 'kontrak']);
        })->values()->all();

        // 7. Filter data sesuai dengan level pengguna
        if ($userLevel === 'admin') {
            $filteredData = $filteredData_admin;
        } elseif ($userLevel === 'RW') {
            $filteredData = $filteredData_rw;
        } elseif ($userLevel === 'RT') {
            $filteredData = $filteredData_rt;
        }

         // 8. Urutkan data berdasarkan nama sebelum mengembalikannya ke DataTables
         $sortedData = collect($filteredData)->sortBy('nama')->values()->all();

        // 6. Mengembalikan data dalam format yang sesuai dengan DataTables
return DataTables::of($sortedData)
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
        // $list_kos = kos::all();
        $list_kos = Kos::where('status', '!=', 0)->get();
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

        $kos = $request->input('id_kos');
        $nama_jalan_kos = kos::where('id', $kos)->value('alamat_kos');

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
        $penduduk->nama_jalan = $nama_jalan_kos;
        $penduduk->status_penghuni = $request->input('status_penghuni');
        $penduduk->no_hp = $request->input('no_hp');
        $penduduk->email = $request->input('email');
        $penduduk->foto_ktp = $request->input('foto_ktp');
        $penduduk->save();

        if($request->has('id_kos')){
            $detail_pendatang = new detail_pendatang();
            $detail_pendatang->NIK = $request->input('NIK');
            $detail_pendatang->id_kos = $request->input('id_kos');
            $detail_pendatang->tanggal_masuk = $request->input('tanggal_masuk');
            $detail_pendatang->tanggal_keluar = $request->input('tanggal_keluar');
            $detail_pendatang->id_kamar = 1;
            $detail_pendatang->save();
        }

        

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
        // $list_kos = kos::all();
        $list_kos = Kos::where('status', '!=', 0)->get();
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

        $kos = $request->input('id_kos');
        $nama_jalan_kos = kos::where('id', $kos)->value('alamat_kos');

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
        $penduduk->nama_jalan = $nama_jalan_kos;
        $penduduk->status_penghuni = $request->input('status_penghuni');
        $penduduk->no_hp = $request->input('no_hp');
        $penduduk->email = $request->input('email');
        $penduduk->update();
    
        if($request->has('id_kos')){
            $detail_pendatang = detail_pendatang::where('NIK', $request->input('NIK'))->first();
            if($detail_pendatang == null){
                $detail_pendatang = new detail_pendatang();
                $detail_pendatang->NIK = $request->input('NIK');
                $detail_pendatang->id_kos = $request->input('id_kos');
                $detail_pendatang->tanggal_masuk = $request->input('tanggal_masuk');
                $detail_pendatang->tanggal_keluar = $request->input('tanggal_keluar');
                $detail_pendatang->id_kamar = 1;
                
                $detail_pendatang->save();
            }
            $detail_pendatang->NIK = $request->input('NIK');
            $detail_pendatang->id_kos = $request->input('id_kos');
            $detail_pendatang->tanggal_masuk = $request->input('tanggal_masuk');
            $detail_pendatang->tanggal_keluar = $request->input('tanggal_keluar');
            $detail_pendatang->id_kamar = 1;
            $detail_pendatang->update();
        }
        
        
        

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

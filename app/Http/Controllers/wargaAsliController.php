<?php

namespace App\Http\Controllers;


use App\Models\keluarga;
use App\Models\pekerjaan;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\perkawinan;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use DataTables;

class wargaAsliController extends Controller
{
    // Read
    public function index(Request $request)
{
    $NIK = Auth::user()->NIK_penduduk;
    $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
    return view('dataWarga.wargaAsli.index', compact('id_rt'));
}

public function fetchAll()
{
    // 1. Ambil NIK pengguna yang saat ini login
    $NIK = Auth::user()->NIK_penduduk;
    
    // 2. Temukan id_rw dari tabel penduduk berdasarkan NIK pengguna
    $id_rw = Penduduk::where('NIK', $NIK)->value('id_rw');

    // 3. Temukan id_rt dari tabel penduduk berdasarkan NIK pengguna
    $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');

    // 4. Ambil data dari API
    $response = Http::withHeaders([
        'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
    ])->get('http://localhost:9000/v1/wargaAsli');

    // 5. Periksa apakah request berhasil
    if ($response->successful()) {
        $data = $response->json();
        
        // 6. Tentukan level pengguna saat ini
        $userLevel = Auth::user()->level;
        
          // 5. Filter data sesuai kondisi yang diinginkan
          $filteredData_rt = collect($data)->filter(function ($item) use ($id_rt) {
            return $item['id_rt'] == $id_rt && !in_array($item['status_penghuni'], ['kos', 'kontrak']);
        })->values()->all();

        // 5. Filter data sesuai kondisi yang diinginkan
        $filteredData_rw = collect($data)->filter(function ($item) use ($id_rw) {
            return $item['id_rw'] == $id_rw && !in_array($item['status_penghuni'], ['kos', 'kontrak']);
        })->values()->all();

        $filteredData_admin = collect($data)->filter(function ($item) use ($id_rt) {
            
            return  !in_array($item['status_penghuni'], ['kos', 'kontrak']);
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


        // 8. Mengembalikan data dalam format yang sesuai dengan DataTables
        return DataTables::of($sortedData)
        // ->addColumn('NIK', function ($warga) {

        //     $NIK = $warga['NIK'];
        //     $censoredNIK = substr_replace($NIK, 'xxxxxxxxxxx', 2, 9); // Mengganti digit ke-3 hingga ke-13 dengan 'x'
        //     return $censoredNIK;
        // })
            ->addColumn('action', function ($warga) {
                // Tambahkan tombol aksi di sini sesuai kebutuhan
                return '<a href="' . route('wargaAsli.edit', $warga['id']) . '" class="btn btn-sm btn-warning toggle-edit" data-toggle="modal">' .
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
        // 9. Jika request gagal, kembalikan pesan error
        return response()->json(['error' => 'Failed to fetch data from API'], 500);
    }
}



// public function fetchAll()
// {
//     // 1. Ambil NIK pengguna yang saat ini login
//     $NIK = Auth::user()->NIK_penduduk;

//     // 2. Temukan id_rt dari tabel penduduk berdasarkan NIK pengguna
//     $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');

//     // 3. Ambil data dari API
//     $response = Http::withHeaders([
//         'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
//     ])->get('http://localhost:9000/v1/wargaAsli');

//     // 4. Periksa apakah request berhasil
//     if ($response->successful()) {
//         $data = $response->json();

//         // 5. Filter data sesuai kondisi yang diinginkan
//         $filteredData = collect($data)->filter(function ($item) use ($id_rt) {
//             return $item['id_rt'] == $id_rt && !in_array($item['status_penghuni'], ['kos', 'kontrak']);
//         })->values()->all();

//         // 6. Mengembalikan data dalam format yang sesuai dengan DataTables
// return DataTables::of($filteredData)
// ->addColumn('action', function ($warga) {
//     // Tambahkan tombol aksi di sini sesuai kebutuhan
//     return '<a href="' . route('wargaAsli.edit', $warga['id']) . '" class="btn btn-sm btn-warning toggle-edit" data-toggle="modal">' .
//         '<i class="bi bi-pencil-fill text-white"></i>' .
//         '</a>&nbsp;&nbsp;' . // Spasi di sini
//         '<a href="#" class="btn btn-sm btn-danger toggle-delete" onclick="confirmDelete(' . $warga['id'] . ')">' .
//         '<i class="bi bi-trash-fill"></i>' .
//         '</a>&nbsp;&nbsp;' . // Spasi di sini
//         '<a class="btn btn-sm btn-primary toggle-detail" onclick="showWargaDetail(' . $warga['id'] . ')" data-id="' . $warga['id'] . '">' .
//         '<i class="bi bi-eye-fill"></i>' .
//         '</a>';
// })
// ->rawColumns(['action']) // Menggunakan rawColumns untuk mengizinkan HTML di dalam kolom aksi
// ->make(true);

//     } else {
//         // 7. Jika request gagal, kembalikan pesan error
//         return response()->json(['error' => 'Failed to fetch data from API'], 500);
//     }
// }




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


    public function showAllWarga()
{
    $response = Http::withHeaders([
        'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
    ])->get('http://localhost:9000/v1/wargaAsli');

    $data = $response->json();

    return $data;
}




    public function Create()
    {
        $list_pendidikan = pendidikan::all();
        $list_pekerjaan = pekerjaan::all();
        $list_perkawinan = perkawinan::all();
        $list_RT = RT::with(['RW'])->get();
        $list_keluarga = keluarga::all();
        $list_RW = RW::all();
        return view('dataWarga.wargaAsli.create', compact(
            'list_pendidikan',
            'list_pekerjaan',
            'list_perkawinan',
            'list_RT',
            'list_RW',
            'list_keluarga'
        ));
    }


    public function simpan(Request $request)
{
    try {
        $response = Http::withHeaders([
            'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
        ])->post('http://localhost:9000/v1/wargaAsli', $request->all());

        if ($response->successful()) {
            return redirect()->route('wargaAsli')->with('success', " berhasil ditambahkan");
        } else {
            return back()->withErrors(['message' => 'Gagal menambah penduduk.']);
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'API Post Failed: ' . $e->getMessage()], 400);
    }
}
    // Update
    public function edit($id)
    {
        $penduduk = penduduk::findOrFail($id);
        $list_pendidikan = pendidikan::all();
        $list_pekerjaan = pekerjaan::all();
        $list_perkawinan = perkawinan::all();
        $list_RT = RT::all();
        $list_RW = RW::all();
        $list_keluarga = keluarga::all();

        return view('dataWarga.wargaAsli.update', compact(
            'penduduk',
            'list_pendidikan',
            'list_pekerjaan',
            'list_perkawinan',
            'list_RT',
            'list_RW',
            'list_keluarga'
        ));
    }

    public function update(Request $request, $id)
{
    try {
        $penduduk = Penduduk::findOrFail($id);

        $response = Http::withHeaders([
            'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
        ])->put("http://localhost:9000/v1/wargaAsli/$id", $request->all());

        if ($request->hasFile('foto_ktp')) {
            // Hapus foto_ktp lama jika ada
            if ($penduduk->foto_ktp) {
                Storage::delete('public/' . $penduduk->foto_ktp);
            }

            $file = $request->file('foto_ktp');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storePubliclyAs('foto_ktp', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/foto_ktp'
            $penduduk->foto_ktp = $filepath;
            $penduduk->save();
        }

        // Periksa kode status respons
        if ($response->successful()) {
            return redirect()->route('wargaAsli')->with('success', " berhasil diedit");
        } else {
            return back()->withErrors(['message' => 'Gagal mengedit penduduk.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Gagal mengedit penduduk: ' . $e->getMessage()]);
    }
}


    // Delete
    public function delete(Request $request, $id)

{
    try {
        $response = Http::withHeaders([
            'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
        ])->delete("http://localhost:9000/v1/wargaAsli/$id");

        // Check response status code
        if ($response->successful()) {
            return redirect()->route('wargaAsli')->with('success', "Penduduk berhasil dihapus");
        } else {
            return back()->withErrors(['message' => 'Gagal menghapus penduduk.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Gagal menghapus penduduk: ' . $e->getMessage()]);
    }
}


    //print
    public function print()
    {
        $penduduk = penduduk::with(['pekerjaan'])
        ->whereNotIn('status_penghuni', ['kos', 'kontrak'])
        ->get();
        return view('dataWarga.wargaAsli.print', compact('penduduk'));
    }
}

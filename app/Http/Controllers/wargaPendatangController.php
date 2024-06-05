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
use Illuminate\Support\Facades\Storage;

class wargaPendatangController extends Controller
{
    public function index(Request $request)
    {
        try {

        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
        return view('dataWarga.wargaPendatang.index', compact('id_rt'));
    } catch (\Exception $e) {
        // Tangani pengecualian jika terjadi
        return response()->view('errors.error-500', [], 500);
    }
    
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
    try {
        // 1. Ambil NIK pengguna yang saat ini login
        $NIK = Auth::user()->NIK_penduduk;

        // 2. Temukan penduduk berdasarkan NIK pengguna
        $penduduk = Penduduk::with(['rw'])->where('NIK', $NIK)->first();

        // 3. Ambil id_rw dan id_rt dari penduduk
        $id_rw = optional($penduduk)->id_rw;
        $id_rt = optional($penduduk)->id_rt;

        // 4. Ambil data dari API
        $response = Http::withHeaders([
            'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
        ])->get('http://localhost:9000/v1/wargaAsli');

        // 5. Periksa apakah request berhasil
        if ($response->successful()) {
            $data = $response->json();

            // 6. Tentukan level pengguna saat ini
            $userLevel = Auth::user()->level;

            // 7. Filter data sesuai dengan level pengguna
            $filteredData = collect($data)->filter(function ($item) use ($userLevel, $id_rw, $id_rt) {
                // Exclude 'kos' and 'kontrak' status
                if (!in_array($item['status_penghuni'], ['kos', 'kontrak'])) {
                    return false;
                }
                // Admin level access
                if ($userLevel === 'admin') {
                    return true;
                }
                // RW level access
                elseif ($userLevel === 'RW') {
                    return true;
                }
                // RT level access
                elseif ($userLevel === 'RT') {
                    return $item['id_rt'] == $id_rt;
                }
                return false;
            })->values()->all();

            // 8. Urutkan data berdasarkan nama sebelum mengembalikannya ke DataTables
            $sortedData = collect($filteredData)->sortBy('nama')->values()->all();

            // 9. Mengembalikan data dalam format yang sesuai dengan DataTables
            return DataTables::of($sortedData)
                ->addColumn('action', function ($warga) {
                    return 
                        '<a href="' . route('wargaPendatang.edit', $warga['id']) . '" class="btn btn-sm btn-warning toggle-edit" data-toggle="modal">' .
                        '<i class="bi bi-pencil-fill text-white"></i>' .
                        '</a>&nbsp;&nbsp;' . 
                        '<a href="#" class="btn btn-sm btn-danger toggle-delete" onclick="confirmDelete(' . $warga['id'] . ')">' .
                        '<i class="bi bi-trash-fill"></i>' .
                        '</a>&nbsp;&nbsp;' . 
                        '<a class="btn btn-sm btn-primary toggle-detail" onclick="showWargaDetail(' . $warga['id'] . ')" data-id="' . $warga['id'] . '">' .
                        '<i class="bi bi-eye-fill"></i>' .
                        '</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            // 10. Jika request gagal, kembalikan pesan error
            return response()->json(['error' => 'Failed to fetch data from API'], 500);
        }
    } catch (\Exception $e) {
        // Log the error for debugging purposes
        return response()->json(['error' => 'An error occurred while processing the request'], 500);
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
        
        $list_RW = RW::all();
        $list_keluarga = keluarga::all();

        $NIK = Auth::user()->NIK_penduduk;

        $userLevel = Auth::user()->level;
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');
        

        if ($userLevel === 'admin') {
            $list_RT = RT::with(['RW'])->get();
        } elseif ($userLevel === 'RW') {
            $list_RT = RT::with(['RW'])->get();
        } elseif ($userLevel === 'RT') {
            $list_RT = RT::where('id', $id_rt)->get();
        }
        
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
        try {
        $kos = $request->input('id_kos');
        $nama_jalan_kos = kos::where('id', $kos)->value('alamat_kos');

        $existingNIK = Penduduk::where('NIK', $request->input('NIK'))->where('id', '!=', $request->NIK)->exists();
        if ($existingNIK) {
            return back()->withErrors(['message' => 'NIK sudah ada. Harap gunakan NIK yang berbeda.']);
        }

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
            $detail_pendatang->save();
        }

        // Handle the foto_ktp update if a file is uploaded
        if ($request->hasFile('foto_ktp')) {
            // Delete the old foto_ktp if it exists
            if ($penduduk->foto_ktp) {
                Storage::delete('public/' . $penduduk->foto_ktp);
            }

            // Store the new foto_ktp
            $file = $request->file('foto_ktp');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storePubliclyAs('foto_ktp_pendatang', $fileName, 'public');
            $penduduk->foto_ktp = $filepath;
            $penduduk->save();
        }
        

        return redirect()->route('wargaPendatang')->with('success', 'Penduduk added successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal mengedit penduduk: ' . $e->getMessage()]);
        }

    }

    // Update
    public function edit($id)
    {
        
        
        $penduduk = penduduk::with('detail_pendatang')->findOrFail($id);
        $detail_pendatang = $penduduk->detail_pendatang()->first();
        $list_pendidikan = pendidikan::all();
        $list_pekerjaan = pekerjaan::all();
        $list_perkawinan = perkawinan::all();
        
        $list_RW = RW::all();
        $list_keluarga = keluarga::all();

        $NIK = Auth::user()->NIK_penduduk;

        $userLevel = Auth::user()->level;
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');
        

        if ($userLevel === 'admin') {
            $list_RT = RT::with(['RW'])->get();
        } elseif ($userLevel === 'RW') {
            $list_RT = RT::with(['RW'])->get();
        } elseif ($userLevel === 'RT') {
            $list_RT = RT::where('id', $id_rt)->get();
        }
        
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
    // dd($request->all());

    try {
        $kos = $request->input('id_kos');
        $nama_jalan_kos = kos::where('id', $kos)->value('alamat_kos');

        // Check for duplicate NIK
        $existingNIK = penduduk::where('NIK', $request->input('NIK'))->where('id', '!=', $id)->exists();
        if ($existingNIK) {
            return back()->withErrors(['message' => 'NIK sudah ada. Harap gunakan NIK yang berbeda.']);
        }

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

        if ($request->has('id_kos')) {
            $detail_pendatang = detail_pendatang::where('NIK', $request->input('NIK'))->first();
            if ($detail_pendatang == null) {
                $detail_pendatang = new detail_pendatang();
                $detail_pendatang->NIK = $request->input('NIK');
                $detail_pendatang->id_kos = $request->input('id_kos');
                $detail_pendatang->tanggal_masuk = $request->input('tanggal_masuk');
                $detail_pendatang->tanggal_keluar = $request->input('tanggal_keluar');

                $detail_pendatang->save();
            } else {
                $detail_pendatang->NIK = $request->input('NIK');
                $detail_pendatang->id_kos = $request->input('id_kos');
                $detail_pendatang->tanggal_masuk = $request->input('tanggal_masuk');
                $detail_pendatang->tanggal_keluar = $request->input('tanggal_keluar');
                $detail_pendatang->update();
            }
        }

        if ($request->hasFile('foto_ktp')) {
            // Hapus foto_ktp lama jika ada
            if ($penduduk->foto_ktp) {
                Storage::delete('public/' . $penduduk->foto_ktp);
            }

            $file = $request->file('foto_ktp');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storePubliclyAs('foto_ktp_pendatang', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/foto_ktp'
            $penduduk->foto_ktp = $filepath;
            $penduduk->save();
        }

        return redirect()->route('wargaPendatang')->with('success', 'Penduduk updated successfully!');

    } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Gagal mengedit penduduk: ' . $e->getMessage()]);
    }

    
}

    // Delete
    public function delete(Request $request, $id)
{
    try {
        $penduduk = Penduduk::findOrFail($id);
        $penduduk->delete();
        return redirect()->route('wargaPendatang')->with('success', 'Penduduk berhasil dihapus!');
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() === '23000') {
            // Integrity constraint violation
            return back()->withErrors(['message' => 'Anda tidak dapat menghapus ini, Anda harus menghilangkan data tersebut dalam seluruh data umum dan data kos']);
        }
        return back()->withErrors(['message' => 'Gagal mengedit penduduk: ' . $e->getMessage()]);
    } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Gagal mengedit penduduk: ' . $e->getMessage()]);
    }
}


    //print
    public function print()
    {
        // Ambil NIK pengguna yang saat ini login
        $NIK = Auth::user()->NIK_penduduk;
    
        // Temukan data penduduk berdasarkan NIK pengguna
        $pengguna = penduduk::where('NIK', $NIK)->first();
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');

        $penduduk_all = Penduduk::with(['pekerjaan'])
            ->where('status_penghuni', 'kos')
            ->orWhere('status_penghuni', 'kontrak')
            ->get();

        $penduduk_rt = Penduduk::with(['pekerjaan'])
            ->where('status_penghuni', 'kos')
            ->where('id_rt', $id_rt)
            ->orWhere('status_penghuni', 'kontrak')
            ->get();

        if (Auth::user()->level === 'admin') {
            $nama_pengguna = "Admin";
            $penduduk = $penduduk_all;
        }elseif (Auth::user()->level === 'RW') {
            $nama_pengguna = $pengguna->nama;
            $penduduk = $penduduk_all;
        } elseif (Auth::user()->level === 'RT') {
            $nama_pengguna = $pengguna->nama;
            $penduduk = $penduduk_rt;
        }else{
            $nama_pengguna = "";
            $penduduk = $penduduk_all;
        }

        return view('dataWarga.wargaPendatang.print', compact('penduduk', 'nama_pengguna'));
    }
}

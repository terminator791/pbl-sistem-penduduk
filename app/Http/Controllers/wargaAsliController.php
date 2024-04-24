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


class wargaAsliController extends Controller
{

    // Read
    public function index(Request $request)
{
    // 1. Ambil NIK pengguna yang saat ini login
    $NIK = Auth::user()->NIK_penduduk;

    // 2. Temukan id_rt dari tabel penduduk berdasarkan NIK pengguna
    $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');

    // 3. Ambil data penduduk yang memiliki id_rt yang sesuai dan status_penghuni yang bukan 'kos' atau 'kontrak'
    $penduduk_rt = penduduk::where('id_rt', $id_rt)
                            ->whereNotIn('status_penghuni', ['kos', 'kontrak'])
                            ->get();

    // Kirim data penduduk ke view
    return view('dataWarga.wargaAsli.index', compact('penduduk_rt'));
}


public function fetchAll()
{
    // 1. Ambil NIK pengguna yang saat ini login
    $NIK =  Auth::user()->NIK_penduduk;

    // 2. Temukan id_rt dari tabel penduduk berdasarkan NIK pengguna
    $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');

    // 3. Ambil data dari API
    $response = Http::withHeaders([
        'Authorization' => 'eb22cfaa-8fc7-4d5e-bcdf-d12c9dc456d9',
    ])->get('http://localhost:9000/v1/wargaAsli');

    $data = $response->json();

    // 4. Filter data sesuai kondisi yang diinginkan
    $filteredData = collect($data)->filter(function ($item) use ($id_rt) {
        return $item['id_rt'] == $id_rt && !in_array($item['status_penghuni'], ['kos', 'kontrak']);
    })->values()->all();

    return $filteredData;
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

        // Check response status code
        if ($response->status() === 200) {
            return response()->json(['message' => 'API Post Success'], 200);
        } else {
            return response()->json(['message' => 'API Post Failed'], $response->status());
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

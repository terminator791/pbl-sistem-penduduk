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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class wargaAsliController extends Controller
{

    // Read
    public function index(Request $request)
    {
        return view('dataWarga.wargaAsli.index');
    }

    public function fetchAll()
{
    $response = Http::withHeaders([
        'Authorization' => '197b827e-bb8b-468c-944a-7932d2ad544f',
    ])->get('http://localhost:9000/v1/wargaAsli');

    $data = $response->json();

    // Filter data sesuai kondisi yang diinginkan
    $filteredData = collect($data)->filter(function ($item) {
        return !in_array($item['status_penghuni'], ['kos', 'kontrak']);
    })->values()->all();

    return $filteredData;
}

public function showAllWarga()
{
    $response = Http::withHeaders([
        'Authorization' => '197b827e-bb8b-468c-944a-7932d2ad544f',
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
            'Authorization' => '197b827e-bb8b-468c-944a-7932d2ad544f',
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
            'Authorization' => '197b827e-bb8b-468c-944a-7932d2ad544f',
        ])->put("http://localhost:9000/v1/wargaAsli/$id", $request->all());

        if ($request->hasFile('foto_ktp')) {
            // Hapus foto_ktp lama jika ada
            if ($penduduk->foto_ktp) {
                Storage::delete('public/' . $penduduk->foto_ktp);
            }

            $file = $request->file('foto_ktp');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storeAs('foto_ktp', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/foto_ktp'
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
            'Authorization' => '197b827e-bb8b-468c-944a-7932d2ad544f',
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

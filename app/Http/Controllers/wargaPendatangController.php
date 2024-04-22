<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\keluarga;
use App\Models\pekerjaan;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\perkawinan;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Support\Facades\Http;


class wargaPendatangController extends Controller
{
    public function index(Request $request)
    {
        $menu = $request->query('menu', 'data_warga');
        $penduduk = Penduduk::with(['pekerjaan'])
            ->where('status_penghuni', 'kos')
            ->orWhere('status_penghuni', 'kontrak')
            ->get();

        return view('dataWarga.wargaPendatang.index', compact('menu', 'penduduk'));
    }

    public function fetchAll()
{
    $response = Http::withHeaders([
        'Authorization' => '197b827e-bb8b-468c-944a-7932d2ad544f',
    ])->get('http://localhost:9000/v1/wargaAsli');

    $data = $response->json();

    // Filter data sesuai kondisi yang diinginkan
    $filteredData = collect($data)->filter(function ($item) {
        return in_array($item['status_penghuni'], ['kos', 'kontrak']);
    })->values()->all();

    return $filteredData;
}


    public function Create()
    {
        $list_pendidikan = pendidikan::all();
        $list_pekerjaan = pekerjaan::all();
        $list_perkawinan = perkawinan::all();
        $list_RT = RT::all();
        $list_RW = RW::all();
        $list_keluarga = keluarga::all();
        return view('dataWarga.wargaPendatang.create', compact(
            'list_pendidikan',
            'list_pekerjaan',
            'list_perkawinan',
            'list_RT',
            'list_RW',
            'list_keluarga'
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
        $penduduk->nama_jalan = $request->input('nama_jalan');
        $penduduk->status_penghuni = $request->input('status_penghuni');
        $penduduk->no_hp = $request->input('no_hp');
        $penduduk->email = $request->input('email');
        $penduduk->foto_ktp = $request->input('foto_ktp');


        $penduduk->save();

        return redirect()->route('wargaPendatang')->with('success', 'Penduduk added successfully!');
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

        return view('dataWarga.wargaPendatang.update', compact(
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
        $penduduk->nama_jalan = $request->input('nama_jalan');
        $penduduk->status_penghuni = $request->input('status_penghuni');
        $penduduk->no_hp = $request->input('no_hp');
        $penduduk->email = $request->input('email');

        $penduduk->update();

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

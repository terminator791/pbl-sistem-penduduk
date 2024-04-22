<?php

namespace App\Http\Controllers;

use App\Models\detail_pendatang;
use App\Models\kos;
use App\Models\RT;
use Illuminate\Http\Request;

class dataKosController extends Controller
{
    // Create
    public function Create()
    {
        $data_kos = kos::all();
        $list_RT = RT::all();
        return view('dataKos.create', compact( 'data_kos', 'list_RT'));
    }

    // Read
    public function index(Request $request)
{
    $menu = $request->query('menu', 'data_warga');
    $data_kos = kos::all();
    $jumlah_penghuni = []; // array untuk menyimpan jumlah penghuni untuk setiap kos
    foreach ($data_kos as $kos) {
        // Hitung jumlah penghuni untuk setiap kos
        $jumlah_penghuni[$kos->id] = detail_pendatang::where('id_kos', $kos->id)->count();
    }
    return view('dataKos.index', compact('menu', 'data_kos', 'jumlah_penghuni'));
}


    public function store(Request $request)
    {
        $data_kos = new kos();
        $data_kos->id_rt = $request->input('id_rt');
        $data_kos->pemilik_kos = $request->input('pemilik_kos');
        $data_kos->nama_kos = $request->input('nama_kos');
        $data_kos->alamat_kos = $request->input('alamat_kos');
        $data_kos->jumlah_penghuni = $request->input('jumlah_penghuni');
        $data_kos->no_hp_pemilik = $request->input('no_hp_pemilik');
        $data_kos->email_pemilik = $request->input('email_pemilik');

        $data_kos->save();

    // Redirect kembali ke halaman 'wargaAsli'
    return redirect()->route('dataKos')->with('success', 'data_kos added successfully!');
    }

    // Update
    public function edit($id)
    {
        $data_kos = kos::findOrFail($id);
        $list_RT = RT::all();
        return view('dataKos.update', compact('data_kos', 'list_RT'));
    }
    public function update(Request $request, $id)
    {
        $data_kos = kos::where('id', $id)->first();
        $data_kos->id_rt = $request->input('id_rt');
        $data_kos->pemilik_kos = $request->input('pemilik_kos');
        $data_kos->nama_kos = $request->input('nama_kos');
        $data_kos->alamat_kos = $request->input('alamat_kos');
        $data_kos->jumlah_penghuni = $request->input('jumlah_penghuni');
        $data_kos->no_hp_pemilik = $request->input('no_hp_pemilik');
        $data_kos->email_pemilik = $request->input('email_pemilik');
        $data_kos->update();

        return redirect()->route('dataKos')->with('success', 'data_kos added successfully!');
    }

    // Delete
    public function delete($id)
    {
        $data_kos = kos::findOrFail($id);
        $data_kos->delete();
        return redirect()->route('dataKos')->with('success', 'Penduduk Deleted successfully!');
    }
}

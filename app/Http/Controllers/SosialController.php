<?php

namespace App\Http\Controllers;

use App\Models\bantuan;
use App\Models\jenis_bantuan;
use App\Models\jenis_penyakit;
use App\Models\kesehatan;
use App\Models\penduduk;
use Illuminate\Http\Request;

class SosialController extends Controller
{
    public function index()
    {
        //
        $list_penduduk = penduduk::all();
        $bantuan = bantuan::with(['penduduk', 'jenis_bantuan'])->get();
        $list_bantuan = jenis_bantuan::all();

        return view('social.index', compact('bantuan', 'list_bantuan', 'list_penduduk'));
    }

    public function create()
    {
        $list_penduduk = penduduk::all();
        $list_bantuan = jenis_bantuan::all();
        return view('social.tambah', compact('list_bantuan', 'list_penduduk'));
    }

    public function store(Request $request)
    {
        $bantuan = new bantuan();
        $bantuan->NIK_penduduk = $request->input('NIK_penduduk');
        $bantuan->id_bantuan = $request->input('id_bantuan');

        $bantuan->save();

        return redirect()->route('sosial')->with('success', 'Bantuan added successfully!');
    }

    public function delete(Request $request, $id)
    {
        $bantuan = bantuan::findOrFail($id);
        
        $bantuan->delete();
        return redirect()->route('Bantuan')->with('success', 'Bantuan Deleted successfully!');
    }
}

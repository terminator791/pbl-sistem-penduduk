<?php

namespace App\Http\Controllers;

use App\Models\pendidikan;
use App\Models\penduduk;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function index()
    {
        //
        $list_penduduk = penduduk::all();
        $kesehatan = kesehatan::with(['penduduk', 'jenis_penyakit'])->get();
        $list_penyakit = jenis_penyakit::all();

        return view('pendidikan.index', compact('kesehatan', 'list_penyakit', 'list_penduduk'));
    }

    public function create()
    {
        $list_penduduk = penduduk::all();
        $list_penyakit = jenis_penyakit::all();
        return view('pendidikan.tambah', compact('list_penyakit', 'list_penduduk'));
    }

    public function store(Request $request)
    {
        $kesehatan = new kesehatan();
        $kesehatan->NIK_penduduk = $request->input('NIK_penduduk');
        $kesehatan->tanggal_terdampak = $request->input('tanggal_terdampak');
        $kesehatan->id_penyakit = $request->input('id_penyakit');

        $kesehatan->save();

        return redirect()->route('pendidikan')->with('success', 'Kesehatan added successfully!');
    }

    public function delete(Request $request, $id)
    {
        $kesehatan = kesehatan::findOrFail($id);
        $kesehatan->delete();
        return redirect()->route('pendidikan')->with('success', 'Kesehatan Deleted successfully!');
    }

}

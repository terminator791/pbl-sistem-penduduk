<?php

namespace App\Http\Controllers;

use App\Models\jenis_kejadian;
use App\Models\kejadian;
use Illuminate\Http\Request;
use App\Models\jenis_penyakit;
use App\Models\kesehatan;
use App\Models\penduduk;
use Illuminate\Support\Facades\Auth;

class BencanaController extends Controller
{
    public function index()
    {
        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');

        $list_penduduk = Penduduk::where('id_rt', $id_rt)->get();
        $kesehatan = kesehatan::with(['penduduk', 'jenis_penyakit'])->get();
        $list_penyakit = jenis_penyakit::all();

        return view('kesehatan.index', compact('kesehatan', 'list_penyakit', 'list_penduduk'));
    }

    public function create()
    {
        $list_penduduk = penduduk::all();
        $list_penyakit = jenis_penyakit::all();
        return view('kesehatan.tambah', compact('list_penyakit', 'list_penduduk'));
    }

    public function store(Request $request)
    {
        $kesehatan = new kesehatan();
        $kesehatan->NIK_penduduk = $request->input('NIK_penduduk');
        $kesehatan->tanggal_terdampak = $request->input('tanggal_terdampak');
        $kesehatan->id_penyakit = $request->input('id_penyakit');

        $kesehatan->save();

        return redirect()->route('kesehatan')->with('success', 'Kesehatan added successfully!');
    }

    public function delete(Request $request, $id)
    {
        //
        $kesehatan = kesehatan::findOrFail($id);
        $kesehatan->delete();
        return redirect()->route('kesehatan')->with('success', 'Kesehatan Deleted successfully!');
    }
}

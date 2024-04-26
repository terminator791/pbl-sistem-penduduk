<?php

namespace App\Http\Controllers;

use App\Models\jenis_penyakit;
use App\Models\kesehatan;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KesehatanController extends Controller
{
    //
    public function index()
{
    $NIK = Auth::user()->NIK_penduduk;
    $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');
    
    $list_penduduk = Penduduk::where('id_rt', $id_rt)->get();
    $kesehatan = Kesehatan::with(['penduduk', 'jenis_penyakit'])->get();
    $list_penyakit = jenis_penyakit::all();

    return view('kesehatan.index', compact('kesehatan', 'list_penyakit', 'list_penduduk'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $list_penduduk = penduduk::all();
        $list_penyakit = jenis_penyakit::all();
        return view('kesehatan.tambah', compact('list_penyakit', 'list_penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'tanggal_terdampak' => 'required', // Memastikan tanggal terdampak diisi
    ]);

    try {
        // Buat instance kesehatan
        $kesehatan = new kesehatan();
        $kesehatan->NIK_penduduk = $request->input('NIK_penduduk');
        $kesehatan->tanggal_terdampak = $request->input('tanggal_terdampak');
        $kesehatan->id_penyakit = $request->input('id_penyakit');

        // Simpan data
        $kesehatan->save();

        return redirect()->route('kesehatan')->with('success', 'Kesehatan added successfully!');
    } catch (\Exception $e) {
        // Tangani pengecualian jika terjadi
        return redirect()->back()->with('error', $e->getMessage());
    }
}



    /**
     * Show the form for editing the specified resource.
     */
    public function delete(Request $request, $id)
    {
        //
        $kesehatan = kesehatan::findOrFail($id);
        $kesehatan->delete();
        return redirect()->route('kesehatan')->with('success', 'Kesehatan Deleted successfully!');
    }

    //print
    //print
    public function print(jenis_penyakit $penyakit)
    {
        // Ambil data kesehatan berdasarkan kategori penyakit
        $kesehatan = kesehatan::where('id_penyakit', $penyakit->id)->with('penduduk')->get();

        // Kembalikan view print dengan data kesehatan
        return view('kesehatan.print', compact('kesehatan', 'penyakit'));
    }
}

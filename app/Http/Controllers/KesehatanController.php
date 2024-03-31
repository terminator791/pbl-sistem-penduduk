<?php

namespace App\Http\Controllers;

use App\Models\jenis_penyakit;
use App\Models\kesehatan;
use App\Models\penduduk;
use Illuminate\Http\Request;

class KesehatanController extends Controller
{
    //
    public function index()
    {
        //
        $list_penduduk = penduduk::all();
        $kesehatan = kesehatan::with(['penduduk', 'jenis_penyakit'])->get();
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
        return view('kesehatan.tambah', compact( 'list_penyakit','list_penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $kesehatan = new kesehatan();
        $kesehatan->NIK_penduduk = $request->input('NIK_penduduk');
        $kesehatan->tanggal_terdampak = $request->input('tanggal_terdampak');
        $kesehatan->id_penyakit = $request->input('id_penyakit');

        $kesehatan->save();

        return redirect()->route('kesehatan')->with('success', 'Kesehatan added successfully!');
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


}

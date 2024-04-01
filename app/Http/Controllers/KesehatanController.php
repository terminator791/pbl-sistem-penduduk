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
        $kesehatan = kesehatan::with(['penduduk', 'jenis_penyakit'])->get();
        
        return view('kesehatan.index', compact('kesehatan'));
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
    public function edit(s $s)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, s $s)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(s $s)
    {
        //
    }
}

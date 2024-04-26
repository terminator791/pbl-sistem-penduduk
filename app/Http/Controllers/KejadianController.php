<?php

namespace App\Http\Controllers;

use App\Models\jenis_kejadian;
use App\Models\kejadian;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KejadianController extends Controller
{
    //
    public function index()
    {
        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');

        $list_penduduk = Penduduk::where('id_rt', $id_rt)->get();
        $kejadian = kejadian::with(['penduduk', 'jenis_kejadian'])->get();
        $list_jenis_kejadian = jenis_kejadian::all();

        return view('kejadian.index', compact('kejadian', 'list_jenis_kejadian', 'list_penduduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $list_penduduk = penduduk::all();
        $list_jenis_kejadian = jenis_kejadian::all();
        return view('kejadian.tambah', compact('list_jenis_kejadian', 'list_penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $kejadian = new kejadian();
        $kejadian->NIK_penduduk = $request->input('NIK_penduduk');
        $kejadian->jenis_kejadian = $request->input('id_jenis_kejadian');
        $kejadian->tanggal_kejadian = $request->input('tanggal_kejadian');
        $kejadian->tempat_kejadian = $request->input('tempat_kejadian');
        $kejadian->deskripsi_kejadian = $request->input('deskripsi_kejadian');

        $kejadian->save();

        return redirect()->route('kejadian')->with('success', 'kejadian added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function delete(Request $request, $id)
    {
        //
        $kejadian = kejadian::findOrFail($id);
        $kejadian->delete();
        return redirect()->route('kejadian')->with('success', 'kejadian Deleted successfully!');
    }

    //print
    public function print(jenis_kejadian $jenis_kejadian)
    {
        // Ambil data kejadian berdasarkan kategori jenis_kejadian
        $kejadian = kejadian::where('jenis_kejadian', $jenis_kejadian->id)->with('penduduk')->get();

        // Kembalikan view print dengan data kejadian
        return view('kejadian.print', compact('kejadian', 'jenis_kejadian'));
    }
}

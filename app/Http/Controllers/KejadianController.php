<?php

namespace App\Http\Controllers;

use App\Models\kejadian;
use Illuminate\Http\Request;

class KejadianController extends Controller
{
    //
    public function index(Request $request)
{
    $menu = $request->query('pageload', 'kejadian');
    $kejadian = kejadian::with(['penduduk'])->get();
    
    return view('kejadian.index', compact('menu', 'kejadian'));
}

    public function create()
    {

        return view('kejadian.create');
    }

    public function store(Request $request)
    {

        $kejadian = new kejadian();
        $kejadian->tanggal_kejadian = $request->input('tanggal_kejadian');
        $kejadian->tempat_kejadian = $request->input('tempat_kejadian');
        $kejadian->deskripsi_kejadian = $request->input('deskripsi_kejadian');
        $kejadian->NIK_penduduk = $request->input('NIK_penduduk');

        $kejadian->save();

        return redirect()->route('warga.index')->with('success', 'Penduduk added successfully!');
    }

}

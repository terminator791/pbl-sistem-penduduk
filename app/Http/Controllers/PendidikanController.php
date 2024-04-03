<?php

namespace App\Http\Controllers;

use App\Models\pendidikan;
use App\Models\penduduk;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
   public function index(Request $request){
       $pendidikan = $request->input('tingkat');
       $penduduk = penduduk::where('id_pendidikan',$pendidikan)->get();
       return view('pendidikan.index', compact('penduduk'));
   }

public function create()
{
    return view('warga.tambah');
}



public function store(Request $request)
{

    $pendidikan = new pendidikan();
    $pendidikan->jenis_pendidikan = $request->input('jenis_pendidikan');

    $pendidikan->save();

    return redirect()->route('dashboard')->with('success', 'Penduduk added successfully!');
}
}


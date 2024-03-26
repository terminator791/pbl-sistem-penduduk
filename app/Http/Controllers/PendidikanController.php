<?php

namespace App\Http\Controllers;

use App\Models\pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    //
    
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


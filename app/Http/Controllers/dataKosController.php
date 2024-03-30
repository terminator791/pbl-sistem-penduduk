<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dataKosController extends Controller
{
    // Create
    public function Create()
    {
        return view('dataKos.create');
    }

    // Read
    public function index(Request $request)
{
    $menu = $request->query('menu', 'data_warga');
    $penduduk = Penduduk::with(['pekerjaan'])
                    ->whereNotIn('status_penghuni', ['kos', 'kontrak'])
                    ->get();
    
    return view('dataWarga.wargaAsli.index', compact('menu', 'penduduk'));
}

    // Update
    public function update()
    {
        return view('dataKos.update');
    }

    // Delete
    public function delete()
    {
        return view('dataKos.index');
    }
}

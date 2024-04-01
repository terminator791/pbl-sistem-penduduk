<?php

namespace App\Http\Controllers;

use App\Models\keluarga;
use App\Models\pekerjaan;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\perkawinan;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Http\Request;

class wargaAsliController extends Controller
{
    // Create
    public function Create()
    {
        return view('dataWarga.wargaAsli.create');
    }

    // Read
    public function index(Request $request)
    {
        $menu = $request->query('menu', 'data_warga');
    $penduduk = penduduk::with(['pekerjaan'])->get();
    
        return view('dataWarga.wargaAsli.index', compact('menu', 'penduduk'));
    }

    // Update
    public function update()
    {
        return view('dataWarga.wargaAsli.update');
    }

    // Delete
    public function delete()
    {
        return view('dataWarga.wargaAsli.index');
    }
}

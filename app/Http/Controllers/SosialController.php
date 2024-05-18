<?php

namespace App\Http\Controllers;

use App\Models\bantuan;
use App\Models\jenis_bantuan;
use App\Models\jenis_penyakit;
use App\Models\kesehatan;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SosialController extends Controller
{
    public function index()
    {
        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');
        $id_rw = Penduduk::where('NIK', $NIK)->value('id_rw');

        $userLevel = Auth::user()->level;
    
    $list_penduduk_rt = Penduduk::where('id_rt', $id_rt)->get();
    $list_penduduk_rw = Penduduk::where('id_rw', $id_rw)->get();
    $list_penduduk_admin = Penduduk::all();

    if ($userLevel === 'admin') {
        $list_penduduk = $list_penduduk_admin;
    } elseif ($userLevel === 'RW') {
        $list_penduduk = $list_penduduk_rw;
    } elseif ($userLevel === 'RT') {
        $list_penduduk = $list_penduduk_rt;
    }
    
        $bantuan = bantuan::with(['penduduk', 'jenis_bantuan'])->get();
        $list_bantuan = jenis_bantuan::all();

        return view('social.index', compact('bantuan', 'list_bantuan', 'list_penduduk'));
    }

    public function create()
    {
        $list_penduduk = penduduk::all();
        $list_bantuan = jenis_bantuan::all();
        return view('social.tambah', compact('list_bantuan', 'list_penduduk'));
    }

    public function store(Request $request)
    {
        $bantuan = new bantuan();
        $bantuan->NIK_penduduk = $request->input('NIK_penduduk');
        $bantuan->id_bantuan = $request->input('id_bantuan');

        $bantuan->save();

        return redirect()->route('sosial')->with('success', 'Bantuan added successfully!');
    }

    public function delete(Request $request, $id)
    {
        $bantuan = bantuan::findOrFail($id);
        
        $bantuan->delete();
        return redirect()->route('Bantuan')->with('success', 'Bantuan Deleted successfully!');
    }
}

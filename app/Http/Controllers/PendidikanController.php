<?php

namespace App\Http\Controllers;

use App\Models\pendidikan;

use App\Models\kesehatan;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\FlareMiddleware\AddContext;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class PendidikanController extends Controller
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

    // $pendidikan = pendidikan::whereHas('penduduk', function ($query) use ($id_rt) {
    //     $query->where('id_rt', $id_rt);
    // })->paginate(10);

    $pendidikan = pendidikan::with('penduduk')->get();

    return view('pendidikan.index', compact('pendidikan', 'list_penduduk', 'id_rt', 'id_rw'));
}



    public function create()
    {
        $list_penduduk = penduduk::all();
        $pendidikan = pendidikan::all();
        return view('pendidikan.tambah', compact('pendidikan', 'list_penduduk'));
    }

    public function store(Request $request, $id)
    {
        try {
            $pendidikan = penduduk::findOrFail($id);
            $pendidikan->id_pendidikan = $request->input('id_pendidikan');
            $pendidikan->update();
            
            return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data pendidikan: ' . $e->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        $pendidikan = penduduk::findOrFail($id);
        $pendidikan->id_pendidikan = null;
        $pendidikan->update();
        return redirect()->route('pendidikan')->with('success', 'Kesehatan Deleted successfully!');
    }
}
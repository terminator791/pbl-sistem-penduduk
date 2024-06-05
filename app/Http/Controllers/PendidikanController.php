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

    public function print(pendidikan $pendidikan)
    {
        // dd($pendidikan->penduduk->pluck('id_pendidikan'));
        // Ambil NIK pengguna yang saat ini login
        $NIK = Auth::user()->NIK_penduduk;
    
        // Temukan data penduduk berdasarkan NIK pengguna
        $pengguna = penduduk::where('NIK', $NIK)->first();

        // Dapatkan id_rt berdasarkan NIK
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');

        $pendidikan_all = penduduk::whereIn('id_pendidikan', $pendidikan->penduduk->pluck('id_pendidikan'))
                    ->with('pendidikan')
                    ->get();

        // Ambil data pendidikan berdasarkan id_rt
        $pendidikan_rt = Penduduk::where('id_rt', $id_rt)
                            ->whereIn('id_pendidikan', $pendidikan->penduduk->pluck('id_pendidikan'))
                            ->with('pendidikan')
                            ->get();

        if (Auth::user()->level === 'admin') {
            $nama_pengguna = "Admin";
            $pendidikan = $pendidikan_all;

        }elseif (Auth::user()->level === 'RW') {
            $nama_pengguna = $pengguna->nama;
            $pendidikan = $pendidikan_all;

        } elseif (Auth::user()->level === 'RT') {
            $nama_pengguna = $pengguna->nama;
            $pendidikan = $pendidikan_rt;
        }else{
            $nama_pengguna = "";
            $pendidikan = $pendidikan_all;
        }

        // dd($pendidikan->penduduk->pluck('id_pendidikan'));

        // Kembalikan view print dengan data kesehatan
        return view('pendidikan.print', compact('pendidikan', 'pendidikan', 'nama_pengguna'));
    }

    public function delete(Request $request, $id)
    {
        $pendidikan = penduduk::findOrFail($id);
        $pendidikan->id_pendidikan = null;
        $pendidikan->update();
        return redirect()->route('pendidikan')->with('success', 'Kesehatan Deleted successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\pendidikan;
<<<<<<< HEAD

=======
use App\Models\jenis_penyakit;
>>>>>>> cd51e9395601dcfe5cf8d4a4ee67ef333c57786f
use App\Models\kesehatan;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\FlareMiddleware\AddContext;

class PendidikanController extends Controller
{
    public function index()
<<<<<<< HEAD
{
    $list_penduduk = penduduk::all();
    $pendidikan = pendidikan::with('penduduk')->get();

    return view('pendidikan.index', compact('pendidikan', 'list_penduduk'));
}


    public function create()
    {
        $list_penduduk = penduduk::all();
        $pendidikan = pendidikan::all();
        return view('pendidikan.tambah', compact('pendidikan', 'list_penduduk'));
    }

    public function store(Request $request, $id)
    {
        $pendidikan = penduduk::findOrFail($id);
        $pendidikan->id_pendidikan = $request->input('id_pendidikan');

        $pendidikan->update();

        return redirect()->route('pendidikan')->with('success', 'Kesehatan added successfully!');
    }

    public function delete(Request $request, $id)
    {
        $pendidikan = penduduk::findOrFail($id);
        $pendidikan->id_pendidikan = null;
        $pendidikan->update();
        return redirect()->route('pendidikan')->with('success', 'Kesehatan Deleted successfully!');
    }
}
=======
    {
        //
        $list_penduduk = penduduk::all();
        $kesehatan = kesehatan::with(['penduduk', 'jenis_penyakit'])->get();
        $list_penyakit = jenis_penyakit::all();

        return view('pendidikan.index', compact('kesehatan', 'list_penyakit', 'list_penduduk'));
    }

    public function create()
    {
        $list_penduduk = penduduk::all();
        $list_penyakit = jenis_penyakit::all();
        return view('pendidikan.tambah', compact('list_penyakit', 'list_penduduk'));
    }

    public function store(Request $request)
    {
        $kesehatan = new kesehatan();
        $kesehatan->NIK_penduduk = $request->input('NIK_penduduk');
        $kesehatan->tanggal_terdampak = $request->input('tanggal_terdampak');
        $kesehatan->id_penyakit = $request->input('id_penyakit');

        $kesehatan->save();

        return redirect()->route('pendidikan')->with('success', 'Kesehatan added successfully!');
    }

    public function delete(Request $request, $id)
    {
        $kesehatan = kesehatan::findOrFail($id);
        $kesehatan->delete();
        return redirect()->route('pendidikan')->with('success', 'Kesehatan Deleted successfully!');
    }
}
>>>>>>> cd51e9395601dcfe5cf8d4a4ee67ef333c57786f

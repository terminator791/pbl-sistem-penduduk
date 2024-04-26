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

    $list_penduduk = Penduduk::where('id_rt', $id_rt)->get();

    $pendidikan = pendidikan::whereHas('penduduk', function ($query) use ($id_rt) {
        $query->where('id_rt', $id_rt);
    })->paginate(10);

    return view('pendidikan.index', compact('pendidikan', 'list_penduduk', 'id_rt'));
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
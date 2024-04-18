<?php

namespace App\Http\Controllers;

use App\Models\pendidikan;

use App\Models\kesehatan;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\FlareMiddleware\AddContext;

class PendidikanController extends Controller
{
    public function index()
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
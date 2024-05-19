<?php

namespace App\Http\Controllers;

use App\Models\jenis_penyakit;
use App\Models\kesehatan;
use App\Models\penduduk;
use App\Models\RT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class KesehatanController extends Controller
{
    //
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

    $kesehatan = kesehatan::all();

    $list_penyakit = jenis_penyakit::all();

    

    return view('kesehatan.index', compact( 'list_penyakit', 'list_penduduk', 'id_rt', 'kesehatan', 'id_rw'));
}

public function toggle_status(Request $request, $id)
{
    $penduduk = Penduduk::findOrFail($id);

    $kesehatan = Kesehatan::findOrFail($id);

    // Cek status awal
    $statusAwal = $kesehatan->status;

    // Jika ditekan lama, ubah status menjadi 'meninggal'
    // Jika ditekan lama, ubah status menjadi 'meninggal'
if ($request->has('long_press')) {
    $kesehatan->status = 'meninggal';

    // Cari penduduk terkait
    $penduduk = $kesehatan->penduduk;
    // Ubah status penghuni menjadi 'meninggal'
    $penduduk->status_penghuni = 'meninggal';
    // Simpan perubahan status penghuni
    $penduduk->save();

} else {
    // Jika ditekan sekali, toggle status antara 'sembuh' dan 'sakit'
    $kesehatan->status = ($statusAwal == 'sembuh') ? 'sakit' : 'sembuh';
}


    // Simpan perubahan status
    
    $kesehatan->save();

    return redirect()->route('kesehatan')->with('success', 'berhasil mengganti status!');
}


    public function create()
    {
        //
        
        $list_penduduk = penduduk::all();
        $list_penyakit = jenis_penyakit::all();
        return view('kesehatan.tambah', compact('list_penyakit', 'list_penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'tanggal_terdampak' => 'required', // Memastikan tanggal terdampak diisi
    ]);

    try {
        // Buat instance kesehatan
        $kesehatan = new kesehatan();
        $kesehatan->NIK_penduduk = $request->input('NIK_penduduk');
        $kesehatan->tanggal_terdampak = $request->input('tanggal_terdampak');
        $kesehatan->id_penyakit = $request->input('id_penyakit');

        // Simpan data
        $kesehatan->save();

        return redirect()->route('kesehatan')->with('success', 'Kesehatan added successfully!');
    } catch (\Exception $e) {
        // Tangani pengecualian jika terjadi
        return redirect()->back()->with('error', $e->getMessage());
    }
}



    /**
     * Show the form for editing the specified resource.
     */
    public function delete(Request $request, $id)
    {
        //
        $kesehatan = kesehatan::findOrFail($id);
        $kesehatan->delete();
        return redirect()->route('kesehatan')->with('success', 'Kesehatan Deleted successfully!');
    }

    //print
    //print
    public function print(jenis_penyakit $penyakit)
    {
        // Ambil data kesehatan berdasarkan kategori penyakit
        $kesehatan = kesehatan::where('id_penyakit', $penyakit->id)->with('penduduk')->get();

        // Kembalikan view print dengan data kesehatan
        return view('kesehatan.print', compact('kesehatan', 'penyakit'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\bantuan;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BantuanController extends Controller
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
        $list_bantuan = bantuan::all();

        return view('bantuan.index', compact('list_bantuan', 'list_penduduk'));
    }


    public function create()
    {
        $list_bantuan = bantuan::all();
        $list_penduduk = penduduk::all();
        return view('bantuan.tambah', compact('list_bantuan', 'list_penduduk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIK_penduduk' => 'required|exists:penduduk,NIK',
            'id_bantuan' => 'required|exists:bantuan,id', // assuming bantuans is the table name
        ]);

        // Find the penduduk by NIK
        $penduduk = Penduduk::where('NIK', $request->NIK_penduduk)->first();
        if ($penduduk) {
            // Set or update the id_bantuan (foreign key in penduduk table)
            $penduduk->id_bantuan = $request->id_bantuan;
            $penduduk->save();
        }

        return redirect()->route('bantuan')->with('success', 'Bantuan berhasil ditambahkan!');
    }


    public function delete($id)
    {
        // Find the penduduk by ID
        $penduduk = Penduduk::findOrFail($id);

        // Set the id_bantuan to null
        $penduduk->id_bantuan = null;
        $penduduk->save();

        // Redirect back with a success message
        return redirect()->route('bantuan')->with('success', 'Status bantuan berhasil dihapus!');
    }

    public function print(bantuan $bantuan)
    {
        // Ambil NIK pengguna yang saat ini login
        $NIK = Auth::user()->NIK_penduduk;
    
        // Temukan data penduduk berdasarkan NIK pengguna
        $pengguna = penduduk::where('NIK', $NIK)->first();
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');

        $sosial = Penduduk::where('id_rt', $id_rt)
                  ->where('id_bantuan', $bantuan->id)
                  ->with('bantuan')
                  ->get();

        if (Auth::user()->level === 'admin') {
            $nama_pengguna = "Admin";
        }elseif (Auth::user()->level === 'RW') {
            $nama_pengguna = $pengguna->nama;
        } elseif (Auth::user()->level === 'RT') {
            $nama_pengguna = $pengguna->nama;
        }else{
            $nama_pengguna = "";
        }


        // // Ambil data kejadian berdasarkan kategori jenis_kejadian
        // $sosial = penduduk::where('id_bantuan', $bantuan->id)->with('bantuan')->get();

        // Kembalikan view print dengan data kejadian
        return view('bantuan.print', compact('sosial', 'bantuan', 'nama_pengguna'));
    }
}

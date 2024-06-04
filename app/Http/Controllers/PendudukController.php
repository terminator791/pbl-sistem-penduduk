<?php

namespace App\Http\Controllers;

use App\Imports\PendudukImport;
use App\Models\keluarga;
use App\Models\pekerjaan;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\perkawinan;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Excel;

// Import Facade File

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $NIK_user = Auth::user()->NIK_penduduk;

        $roles = penduduk::where('NIK', $NIK_user)->first();
        // dd($roles);

        $menu = $request->query('menu', 'data_warga');
        $penduduk = penduduk::with(['pekerjaan'])->get();

        return view('home', compact('menu', 'penduduk', 'roles'));
    }

    public function create()
    {
        $list_pendidikan = pendidikan::all();
        $list_pekerjaan = pekerjaan::all();
        $list_perkawinan = perkawinan::all();
        $list_RT = RT::all();
        $list_RW = RW::all();
        $list_keluarga = keluarga::all();
        return view('warga.add', compact(
            'list_pendidikan',
            'list_pekerjaan',
            'list_perkawinan',
            'list_RT',
            'list_RW',
            'list_keluarga'
        ));
    }



    public function store(Request $request)
    {

        $penduduk = new penduduk();
        $penduduk->NIK = $request->input('NIK');
        $penduduk->nama = $request->input('nama');
        $penduduk->jenis_kelamin = $request->input('jenis_kelamin');
        $penduduk->tempat_lahir = $request->input('tempat_lahir');
        $penduduk->tanggal_lahir = $request->input('tanggal_lahir');
        $penduduk->agama = $request->input('agama');
        $penduduk->id_pendidikan = $request->input('id_pendidikan');
        $penduduk->id_pekerjaan = $request->input('id_pekerjaan');
        $penduduk->id_rt = $request->input('id_rt');
        $penduduk->id_rw = $request->input('id_rw');
        $penduduk->id_status_perkawinan = $request->input('id_status_perkawinan');
        $penduduk->id_keluarga = $request->input('id_keluarga');
        $penduduk->nama_jalan = $request->input('nama_jalan');
        $penduduk->status_penghuni = $request->input('status_penghuni');
        $penduduk->no_hp = $request->input('no_hp');
        $penduduk->email = $request->input('email');

        $penduduk->save();

        return redirect()->route('dashboard')->with('success', 'Penduduk berhasil ditambahkan!');
    }

    public function import(Request $request){
        //validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        //menangkap file excel
        $file = $request->file('file');

        //membuat nama file
        $nama_file = time() . $file->getClientOriginalName();

        //upload ke folder file_penduduk di folder public
        $file->move('file_penduduk', $nama_file);

        Excel::import(new PendudukImport, public_path("/file_penduduk/$nama_file"));
        return redirect('/wargaAsli');
    }
}

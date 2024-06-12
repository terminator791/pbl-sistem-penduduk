<?php

namespace App\Http\Controllers;

use App\Models\jenis_kejadian;
use App\Models\kejadian;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KejadianController extends Controller
{
    //
    public function index()
    {
        try{

        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');
        $id_rw = Penduduk::where('NIK', $NIK)->value('id_rw');

        $userLevel = Auth::user()->level;
    
    $list_penduduk_rt = Penduduk::where('id_rt', $id_rt)->get();
    $list_penduduk_rw = Penduduk::where('id_rw', $id_rw)->get();
    $list_penduduk_admin = Penduduk::all();

    $kejadian_all = kejadian::with(['penduduk', 'jenis_kejadian'])->get();

    $kejadian_rt = Kejadian::whereHas('penduduk', function($query) use ($id_rt) {
        $query->where('id_rt', $id_rt);
    })->with(['penduduk', 'jenis_kejadian'])->get();


    if ($userLevel === 'admin') {
        $list_penduduk = $list_penduduk_admin;
        $kejadian = $kejadian_all;
    } elseif ($userLevel === 'RW') {
        $list_penduduk = $list_penduduk_rw;
        $kejadian = $kejadian_all;
    } elseif ($userLevel === 'RT') {
        $list_penduduk = $list_penduduk_rt;
        $kejadian = $kejadian_rt;
    }
    
        $list_jenis_kejadian = jenis_kejadian::all();

        return view('kejadian.index', compact('kejadian', 'list_jenis_kejadian', 'list_penduduk', 'id_rt'));

    } catch (\Exception $e) {
        // Tangani pengecualian jika terjadi
        return response()->view('errors.error-500', [], 500);
    }
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $list_penduduk = penduduk::all();
        $list_jenis_kejadian = jenis_kejadian::all();
        return view('kejadian.tambah', compact('list_jenis_kejadian', 'list_penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new kejadian instance
        try{
            $request->validate([
                'foto_kejadian' => 'image|mimes:jpeg,png,jpg|max:10240',
            ]);

        $kejadian = new Kejadian();
        $kejadian->NIK_penduduk = $request->input('NIK_penduduk');
        $kejadian->jenis_kejadian = $request->input('id_jenis_kejadian');
        $kejadian->tanggal_kejadian = $request->input('tanggal_kejadian');
        $kejadian->tempat_kejadian = $request->input('tempat_kejadian');
        $kejadian->deskripsi_kejadian = $request->input('deskripsi_kejadian');
        if ($request->hasFile('foto_kejadian')) {
            $file = $request->file('foto_kejadian');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storeAs('foto_kejadian', $fileName, 'public'); // Store in 'storage/app/public/foto_kejadian'
            $kejadian->foto_kejadian = $filepath;
        }

        $kejadian->save();

        return redirect()->route('kejadian')->with('success', 'Kejadian added successfully!');

    } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Gagal memasukkan data: ' . $e->getMessage()]);
    }

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function delete(Request $request, $id)
    {
        //
        $kejadian = kejadian::findOrFail($id);
        $kejadian->delete();
        return redirect()->route('kejadian')->with('success', 'kejadian Deleted successfully!');
    }

    //print
    public function print(jenis_kejadian $jenis_kejadian)
    {
        // Ambil NIK pengguna yang saat ini login
        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');
    
        // Temukan data penduduk berdasarkan NIK pengguna
        $pengguna = penduduk::where('NIK', $NIK)->first();

        $kejadian_rt = kejadian::where('jenis_kejadian', $jenis_kejadian->id)
        ->whereHas('penduduk', function($query) use ($id_rt) {
            $query->where('id_rt', $id_rt);
        })
        ->with('penduduk')
        ->with('jenis_kejadian')
        ->get();

        $kejadian_all = kejadian::where('jenis_kejadian', $jenis_kejadian->id)->with('penduduk')->get();
    
        if (Auth::user()->level === 'admin') {
            $nama_pengguna = "Admin";
            $kejadian = $kejadian_all;
        }elseif (Auth::user()->level === 'RW') {
            $nama_pengguna = $pengguna->nama;
            $kejadian = $kejadian_all;
        } elseif (Auth::user()->level === 'RT') {
            $nama_pengguna = $pengguna->nama;
            $kejadian = $kejadian_rt;
        }else{
            $nama_pengguna = "";
            $kejadian = $kejadian_all;
        }

        // Ambil data kejadian berdasarkan kategori jenis_kejadian
        // $kejadian = kejadian::where('jenis_kejadian', $jenis_kejadian->id)->with('penduduk')->get();
        
        // Kembalikan view print dengan data kejadian
        return view('kejadian.print', compact('kejadian', 'jenis_kejadian', 'nama_pengguna'));
    }

    public function toggle_status(Request $request, $id)
    {
        $kejadian = kejadian::findOrFail($id);

        // Mengubah status menjadi kebalikan dari nilai sebelumnya
        $kejadian->status = !$kejadian->status;

        $kejadian->update();

        return redirect()->route('kejadian')->with('success', 'berhasil mengganti status!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\detail_pendatang;
use App\Models\kos;
use App\Models\penduduk;
use App\Models\penjabatan_RT;
use App\Models\RT;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class dataKosController extends Controller
{
    // Create
    public function Create()
    {
        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');
        $id_rw = Penduduk::where('NIK', $NIK)->value('id_rw');

        $userLevel = Auth::user()->level;
        
        $list_penduduk_admin = Penduduk::all();
        $list_penduduk_rw = Penduduk::where('id_rw', $id_rw)->get();
        $list_penduduk_rt = Penduduk::where('id_rt', $id_rt)->get();
        $list_penduduk_kos = kos::where('NIK_pemilik_kos', $NIK)->get();

        if ($userLevel === 'admin') {
            $list_penduduk = $list_penduduk_admin;
        } elseif ($userLevel === 'RW') {
            $list_penduduk = $list_penduduk_rw;
        } elseif ($userLevel === 'RT') {
            $list_penduduk = $list_penduduk_rt;
        } elseif ($userLevel === 'pemilik_kos') {
            $list_penduduk = $list_penduduk_kos;
        }

        $data_kos = kos::all();
        $list_RT = RT::all();
        return view('dataKos.create', compact( 'data_kos', 'list_RT', 'list_penduduk'));
    }

    // Read
    public function index(Request $request)
{
    $NIK = Auth::user()->NIK_penduduk;
    $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
    $username = Auth::user()->username;
    
    $data_kos_pemilik = kos::where('NIK_pemilik_kos', $NIK)->get();
    $data_kos_RT = kos::where('id_rt', $id_rt)->get();
    $data_kos = kos::all();
    
    $jumlah_penghuni = []; // array untuk menyimpan jumlah penghuni untuk setiap kos
    foreach ($data_kos as $kos) {
        // Hitung jumlah penghuni untuk setiap kos
        $jumlah_penghuni[$kos->id] = detail_pendatang::where('id_kos', $kos->id)->count();
    }

    return view('dataKos.index', compact('data_kos', 'jumlah_penghuni', 'data_kos_pemilik', 'data_kos_RT', 'id_rt', 'username'));
}

public function penghuni($id)
{
    // Ambil data kos berdasarkan ID
    $kos = Kos::find($id);
    
    // Ambil data penduduk berdasarkan id_kos yang diberikan
    $penghuni = detail_pendatang::where('id_kos', $id)->with('penduduk')->get();

    // Return view dengan data yang dibutuhkan
    return view('dataKos.penghuniKos', compact('kos', 'penghuni'));
}



public function updatePenghuni(Request $request, $id)
{
    // dd($request->all());

    // Ambil data penduduk berdasarkan id_ yang diberikan
    $penghuni = detail_pendatang::where('id', $id)->with('penduduk')->first();

    
    if($request->has('deskripsi')){
        $penghuni->deskripsi = $request->input('deskripsi');
    }elseif($request->has('tanggal_keluar')){
        $penghuni->tanggal_keluar = $request->input('tanggal_keluar');
    }elseif($request->has('tanggal_masuk')){
        $penghuni->tanggal_masuk = $request->input('tanggal_masuk');
    }

    
    $penghuni->save();

    

    return redirect()->back()->with('success', 'Data penghuni berhasil diperbarui.');
}


    public function store(Request $request)
    {
        // dd($request->all());

        $pemilik_kos_asli_NIK = $request->input('NIK_pemilik_kos_asli');
        $pemilik_kos_asli = penduduk::where('NIK', $pemilik_kos_asli_NIK)->first();

        $NIK_pemilik_kos = $request->input('NIK_pemilik_kos');
        

        $data_kos = new kos();
        $data_kos->id_rt = $request->input('id_rt');
        $data_kos->nama_kos = $request->input('nama_kos');
        $data_kos->alamat_kos = $request->input('alamat_kos');
        $data_kos->no_hp_pemilik = $request->input('no_hp_pemilik');
        $data_kos->email_pemilik = $request->input('email_pemilik');

        if ($request->input('pemilik_kos')) {
            $user_cek = User::where('NIK_penduduk', $NIK_pemilik_kos)->where('level', 'pemilik_kos')->first();
            if($user_cek){
                $data_kos->pemilik_kos = $request->input('pemilik_kos');
                $data_kos->NIK_pemilik_kos = $NIK_pemilik_kos;
            }else{
                $user = new User();
                $user->level = 'pemilik_kos';
                $data_kos->pemilik_kos = $request->input('pemilik_kos');
                $data_kos->NIK_pemilik_kos = $NIK_pemilik_kos;
                $user->username = $request->input('NIK_pemilik_kos');
                $user->NIK_penduduk = $request->input('NIK_pemilik_kos');
                $user->password = $request->input('NIK_pemilik_kos');
                $user->save();
            }
        } else {
            $user_cek = User::where('NIK_penduduk', $pemilik_kos_asli_NIK)->where('level', 'pemilik_kos')->first();
            if($user_cek){
                $data_kos->pemilik_kos = $pemilik_kos_asli->nama;
                $data_kos->NIK_pemilik_kos = $request->input('NIK_pemilik_kos_asli');
            }else{
                $user = new User();
                $user->level = 'pemilik_kos';
                $data_kos->pemilik_kos = $pemilik_kos_asli->nama;
                $data_kos->NIK_pemilik_kos = $request->input('NIK_pemilik_kos_asli');
                $user->username = $request->input('NIK_pemilik_kos_asli');
                $user->NIK_penduduk = $request->input('NIK_pemilik_kos_asli');
                $user->password = $request->input('NIK_pemilik_kos_asli');
                $user->save();
            }
        }

        if ($request->hasFile('foto_kos')) {
            $file = $request->file('foto_kos');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storePubliclyAs('foto_kos', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/'
            $data_kos->foto_kos = $filepath;
            $data_kos->save();
        }

        $data_kos->save();

    // Redirect kembali ke halaman 'wargaAsli'
    return redirect()->route('dataKos')->with('success', 'kos ' . $data_kos->nama_kos .'berhasil ditambahkan!');
    }

    // Update
    public function edit($id)
    {
        $NIK = Auth::user()->NIK_penduduk;
        $id_rw = Penduduk::where('NIK', $NIK)->value('id_rw');

        $list_penduduk = Penduduk::where('id_rw', $id_rw)->get();
        $list_NIK_penduduk = Penduduk::where('id_rw', $id_rw)->pluck('NIK')->toArray();

        $data_kos = kos::findOrFail($id);

        // Periksa apakah pemilik kos termasuk dalam daftar penduduk yang memiliki kosan di RW tersebut
        if (in_array($data_kos->NIK_pemilik_kos, $list_NIK_penduduk)) {
            $pemilik_kos_asli = true; // Tandai bahwa pemilik kos adalah warga asli
        } else {
            $pemilik_kos_asli = false; // Tandai bahwa pemilik kos bukan warga asli
        }
        
        $list_RT = RT::all();
        return view('dataKos.update', compact('data_kos', 'list_RT', 'list_penduduk', 'pemilik_kos_asli', 'list_NIK_penduduk'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $data_kos = kos::findOrFail($id);

        $data_kos->id_rt = $request->input('id_rt');
        $data_kos->nama_kos = $request->input('nama_kos');
        $data_kos->alamat_kos = $request->input('alamat_kos');
        $data_kos->no_hp_pemilik = $request->input('no_hp_pemilik');
        $data_kos->email_pemilik = $request->input('email_pemilik');

        if ($request->hasFile('foto_kos')) {
            // Hapus  lama jika ada
            if ($data_kos->foto_kos) {
                Storage::delete('public/' . $data_kos->foto_kos);
            }

            $file = $request->file('foto_kos');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storePubliclyAs('foto_kos', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/'
            $data_kos->foto_kos = $filepath;
            $data_kos->save();
        }

        $data_kos->update();

        return redirect()->route('dataKos')->with('success', 'data_kos added successfully!');
    }

    public function toggle_status(Request $request, $id)
{
    $data_kos = Kos::findOrFail($id);

    // Mengubah status menjadi kebalikan dari nilai sebelumnya
    $data_kos->status = !$data_kos->status;

    $data_kos->update();

    return redirect()->route('dataKos')->with('success', 'berhasil mengganti status!');
}


    

    public function print()
    {
        // Mengambil semua data kos
        $data_kos = kos::all();
        
        // Kembalikan view print dengan data kos
        return view('dataKos.print', compact('data_kos'));
    }

    // Delete
    public function delete($id)
{
    
    $data_kos = Kos::findOrFail($id);
    $NIK_pemilik_kos = $data_kos->NIK_pemilik_kos;
    
    $data_kos->delete();

    $kos_cek = Kos::where('NIK_pemilik_kos', $NIK_pemilik_kos)->exists();

    if(!$kos_cek) {
        $user = User::where('NIK_penduduk', $NIK_pemilik_kos)->where('level', 'pemilik_kos')->first();
        
        if($user) {
            $user->delete();
            if (Auth::user()->level == 'pemilik_kos'){
                return redirect()->route('login')->with('warning', 'Akun tidak akan bisa digunakan lagi karena tidak adanya kos yang ada di akun ini, Hubungi Admin lebih lanjut!');
            }
            else{
                return redirect()->route('dataKos')->with('success', 'Kos ' . $data_kos->nama_kos .' berhasil dihapus!')->with('warning', "Akun " .$user->username. " tidak akan bisa digunakan lagi karena tidak adanya kos yang ada di akun ini, Hubungi Admin lebih lanjut!");
            }
            }
           
    }
}
    




    public function delete_penghuni($id)
    {
        $data_penghuni = detail_pendatang::findOrFail($id);
        $data_penghuni->delete();
        return redirect()->route('dataKos')->with('success', 'Deleted successfully!');
    }

    
}

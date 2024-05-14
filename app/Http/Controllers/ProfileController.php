<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\penduduk;
use App\Models\penjabatan_RT;
use App\Models\RT;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(){
        $NIK = Auth::user()->NIK_penduduk;
        $username = Auth::user()->username;
        $nama = penduduk::where('NIK', $NIK)->value('nama');
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
        $id_rw = penduduk::where('NIK', $NIK)->value('id_rw');
        $no_hp = penduduk::where('NIK', $NIK)->value('no_hp');
        $email = penduduk::where('NIK', $NIK)->value('email');
        $jabatan = Auth::user()->level;

        $list_RT = RT::all();
        return view('profile.index', compact(['list_RT', 'id_rt', 'NIK', 'username', 'nama', 'no_hp', 'email', 'jabatan', 'id_rw']));
    }
    
     public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function toggle_tanggal(Request $request, $id)
{
    // Temukan data ketua RT berdasarkan ID
    $ketua_rt = penjabatan_RT::where('id_penjabatan', $id)->first();
    // dd($ketua_rt);
    $ketua_rt->tanggal_diberhentikan = $request->input('tanggal_diberhentikan');
    
    $ketua_rt->update();
    // Redirect dengan pesan sukses
    return redirect()->route('jabatan')->with('success', 'Berhasil mengganti status!');
}


    public function create(){
        $NIK = Auth::user()->NIK_penduduk;
        $username = Auth::user()->username;
        $nama = penduduk::where('NIK', $NIK)->value('nama');
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
        $no_hp = penduduk::where('NIK', $NIK)->value('no_hp');
        $email = penduduk::where('NIK', $NIK)->value('email');
        $jabatan = Auth::user()->level;

        $list_penduduk = Penduduk::where('id_rt', $id_rt)->get();
        $list_RT = RT::all();
        return view('profile.create',compact(['list_RT', 'id_rt', 'NIK', 'username', 'nama', 'no_hp', 'email', 'jabatan', 'list_penduduk']));
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function store(Request $request)
    {
        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');

        // Menghitung jumlah penjabatan hari ini
        $today = Carbon::today();
        $countToday = penjabatan_RT::whereDate('created_at', $today)->count();

        // Membuat id_penjabatan dengan angka unik hari ini
        $id_penjabatan = $today->format('Ymd') . str_pad($countToday + 1, 2, '0', STR_PAD_LEFT);

        $penjabatan = new penjabatan_RT();
        $penjabatan->id_penjabatan = $id_penjabatan;
        $penjabatan->NIK_ketua_rt = $request->input('NIK_penduduk');
        $penjabatan->tanggal_dilantik = $request->input('tanggal_dilantik');
        $penjabatan->id_rt = $id_rt;

        $user = new User();
        $user->username = $request->input('username');
        $user->NIK_penduduk = $request->input('NIK_penduduk');
        $user->level = $request->input('level');
        $user->password = $request->input('NIK_penduduk');

        $penjabatan->save();
        $user->save();

        return redirect()->route('profile')->with('success', 'User berhasil diperbarui!');
    }



    public function update(Request $request)
    {
        $NIK = Auth::user()->NIK_penduduk;
        $level = Auth::user()->level;
        // $id = penduduk::where('NIK', $NIK)->value('id');

        $user = User::where('NIK_penduduk' , $NIK)->where('level', $level)->first();
        // $penjabatan = User::where('NIK_penduduk' , $NIK)->first();
       
        $user->username = $request->input('username');
        $user->NIK_penduduk = $request->input('NIK_penduduk');
        $user->level = $level;

        $user->status_akun = 1;
        // dd($user);
        $user->update();

        return redirect()->route('profile')->with('success', 'User Updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // menampilkan daftar RT yang pernah menjabat
    public function tampil()
{
    if (Auth::user()->level == 'RT') {
        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
        $list_ketua = penjabatan_RT::where('id_rt', $id_rt)
        ->orderByRaw('tanggal_diberhentikan IS NULL DESC')
        ->orderBy('tanggal_dilantik', 'desc')
        ->get();
        $nama_ketua = DB::table('penduduk')
            ->whereExists(function ($query) use ($id_rt) {
                $query->select()
                    ->from('penjabatan_rt')
                    ->whereRaw('penduduk.nik = penjabatan_rt.NIK_ketua_rt')
                    ->where('id_rt', '=', $id_rt);
            })
            ->get();
    } else {
        $id_rt = RT::pluck('id'); // Mengambil semua id RT
        $list_ketua = penjabatan_RT::whereIn('id_rt', $id_rt)
        ->orderByRaw('tanggal_diberhentikan IS NULL DESC')
        ->orderBy('tanggal_dilantik', 'desc')
        ->get();
        $nama_ketua = DB::table('penduduk')
            ->whereExists(function ($query) {
                $query->select()
                    ->from('penjabatan_rt')
                    ->whereRaw('penduduk.nik = penjabatan_rt.NIK_ketua_rt')
                    ->whereIn('id_rt', RT::pluck('id'));
            })
            ->get();
    }
    return view('penjabatan.index', compact('id_rt', 'list_ketua', 'nama_ketua'));
}

public function ganti_sandi_profile(){
    $NIK = Auth::user()->NIK_penduduk;
    $username = Auth::user()->username;
    $jabatan = Auth::user()->level;
    $password = Auth::user()->password;

    $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
    // dd($password);


    return view('profile.ganti_sandi',compact(['NIK', 'username','jabatan', 'password', 'id_rt']));
}

public function ganti_sandi(Request $request){

    // dd($request->all());
    // Validasi input dari formulir
    $request->validate([
        'password_lama' => 'required',
        'password_baru' => 'required', // Misalnya, membutuhkan minimal 8 karakter untuk kata sandi baru
    ]);

    // Ambil pengguna saat ini
    $user = Auth::user();

    // Periksa apakah kata sandi lama cocok dengan kata sandi pengguna saat ini
    if (!Hash::check($request->password_lama, $user->password)) {
        return back()->with('error', 'Kata sandi lama salah.');
    }

    // Jika kata sandi lama cocok, update kata sandi pengguna dengan kata sandi baru
    $user->password = Hash::make($request->password_baru);
    $user->save();

    // Redirect pengguna ke halaman profile atau ke halaman lain yang sesuai
    return redirect()->route('profile')->with('success', 'Kata sandi berhasil diperbarui.');
}


public function check_password(Request $request){
    $password_lama = $request->password_lama;
    $password_asli = Auth::user()->getAuthPassword();

    if (Hash::check($password_lama, $password_asli)) {
        return "valid";
    } else {
        return "invalid";
    }
    
}

public function delete_ketua($id)
{
    $ketua_rt = penjabatan_RT::where('id_penjabatan', $id);
    $ketua_rt->delete();

    return redirect()->route('jabatan')->with('success', 'Deleted successfully!');
}

public function kelola_akun()
{

    $users = User::all();
    $uniqueLevels = $users->pluck('level')->unique();

    $list_users_admin = User::byLevel('admin')->get();
    $list_users_RT = User::byLevel('RT')->get();
    $list_users_RW = User::byLevel('RW')->get();
    $list_users_pemilik_kos = User::byLevel('pemilik_kos')->get();

    return view('profile.kelola_akun', compact('users', 'uniqueLevels', 'list_users_admin', 'list_users_RT', 'list_users_RW', 'list_users_pemilik_kos'));
}

public function toggle_status(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Mengubah status menjadi kebalikan dari nilai sebelumnya
    $user->status_akun = !$user->status_akun;

    $user->update();

    return redirect()->route('profile.kelola_akun')->with('success', 'berhasil mengganti status!');
}

public function delete_akun($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('profile.kelola_akun')->with('success', 'Deleted successfully!');
}




}

<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProfileUpdateRequest;
use App\Models\penduduk;
use App\Models\penjabatan_RT;
use App\Models\RT;
use App\Models\RW;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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

        try{

        $NIK = Auth::user()->NIK_penduduk;
        $username = Auth::user()->username;
        $id_penjabatan_users = Auth::user()->id_penjabatan_users;

        $nama = penduduk::where('NIK', $NIK)->value('nama');
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
        $id_rw = penduduk::where('NIK', $NIK)->value('id_rw');
        $no_hp = penduduk::where('NIK', $NIK)->value('no_hp');
        $email = penduduk::where('NIK', $NIK)->value('email');
        $jabatan = Auth::user()->level;

        $ketua_rw = RW::first();
        $ketua_rt = penjabatan_RT::where('id_penjabatan', $id_penjabatan_users)->first();

        $list_RT = RT::all();
        return view('profile.index', compact(['list_RT', 'id_rt', 'NIK', 'username', 'nama', 'no_hp', 'email', 'jabatan', 'id_rw', 'ketua_rw', 'ketua_rt']));

    } catch (\Exception $e) {
        // Tangani pengecualian jika terjadi
        return response()->view('errors.error-500', [], 500);
    }

    }
    
     public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function toggle_tanggal(Request $request, $id)
{
    try{

    // Temukan data ketua RT berdasarkan ID
    $ketua_rt = penjabatan_RT::where('id_penjabatan', $id)->first();
    $NIK_ketua_rt = penjabatan_RT::where('id_penjabatan', $id)->value('NIK_ketua_rt');
    $users = User::where('NIK_penduduk', $NIK_ketua_rt)->where('level', 'RT')->get();

    // Mengubah status_akun untuk setiap user menjadi false
    foreach ($users as $user) {
        $user->status_akun = false;
        $user->save();
    }

    // Mengupdate tanggal_diberhentikan pada $ketua_rt
    $ketua_rt->tanggal_diberhentikan = $request->input('tanggal_diberhentikan');
    $ketua_rt->update();

    // Redirect dengan pesan sukses
    return redirect()->route('jabatan')->with('success', 'Berhasil mengganti status!');

} catch (\Exception $e) {
    return back()->withErrors(['message' => 'Gagal mengganti status: ' . $e->getMessage()]);
}

}



    public function create(){

        try{

        $NIK = Auth::user()->NIK_penduduk;
        $username = Auth::user()->username;
        $nama = penduduk::where('NIK', $NIK)->value('nama');
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
        $id_rw = penduduk::where('NIK', $NIK)->value('id_rw');
        $no_hp = penduduk::where('NIK', $NIK)->value('no_hp');
        $email = penduduk::where('NIK', $NIK)->value('email');
        $jabatan = Auth::user()->level;

        $list_penduduk_admin = Penduduk::all();
        $list_penduduk_rw = Penduduk::where('id_rw', $id_rw)->get();
        // $list_penduduk_rt = Penduduk::where('id_rt', $id_rt)->get();

        if ($jabatan === 'admin') {
            $list_penduduk = $list_penduduk_admin;
        } elseif ($jabatan === 'RW') {
            $list_penduduk = $list_penduduk_rw;
        }

        $list_RT = RT::all();
        return view('profile.create',compact(['list_RT', 'id_rt', 'NIK', 'username', 'nama', 'no_hp', 'email', 'jabatan', 'list_penduduk']));

    } catch (\Exception $e) {
        // Tangani pengecualian jika terjadi
        return response()->view('errors.error-500', [], 500);
    }

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
        try {
            $request->validate([
                'foto_ketua' => 'image|mimes:jpeg,png,jpg|max:10240',
            ]);

        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');

        // Menghitung jumlah penjabatan hari ini
        $today = Carbon::today();
        $countToday = penjabatan_RT::whereDate('created_at', $today)->count();

        // Membuat id_penjabatan dengan angka unik hari ini
        $id_penjabatan = $today->format('Ymd') . str_pad($countToday + 1, 2, '0', STR_PAD_LEFT);
        $id_penjabatan= $id_penjabatan+10;
        $NewUser = new User();

        if($request->input('level') == 'RW'){
            $NIK_rw = $request->input('nama');
            $nama = penduduk::where('NIK', $NIK_rw)->value('nama');
            
            $penjabatan = RW::first();
            $penjabatan->nama_rw = '13';
            $penjabatan->ketua_rw = $nama;
            if ($request->hasFile('foto_ketua')) {
                $file = $request->file('foto_ketua');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filepath = $file->storePubliclyAs('foto_ketua_rw', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/'
                $penjabatan->foto_ketua_rw = $filepath;
            }
            $users = User::where('level', 'RW')->get();

            // Mengubah status_akun untuk setiap user menjadi false
            foreach ($users as $user) {
                $user->status_akun = false;
                $user->save();
            }
            $penjabatan->save();

        }elseif ($request->input('level') == 'RT') {
            $penjabatan = new penjabatan_RT();
            $penjabatan->id_penjabatan = $id_penjabatan;
            $penjabatan->NIK_ketua_rt = $request->input('NIK_penduduk');

            $NIk_ketua = $request->input('NIK_penduduk');

            $id_rt_ketua = penduduk::where('NIK', $NIk_ketua)->value('id_rt');

            $penjabatan->tanggal_dilantik = $request->input('tanggal_dilantik');
            $penjabatan->id_rt = $id_rt_ketua;
            // dd($id_rt_ketua);
            if ($request->hasFile('foto_ketua')) {
                $file = $request->file('foto_ketua');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filepath = $file->storePubliclyAs('foto_ketua_rt', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/'
                $penjabatan->foto_ketua_rt = $filepath;
            }
            $NewUser->id_penjabatan_users = $id_penjabatan;
            $penjabatan->save();
            $id_penjabatan++;
        }


        $NewUser->username = $request->input('username');
        $NewUser->NIK_penduduk = $request->input('nama');
        $NewUser->level = $request->input('level');
        $NewUser->password = $request->input('nama');

        $NewUser->save();

        return redirect()->route('profile.create')->with('success', 'Berhasil Dibuat!');

    } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Gagal mengedit Data Profile: ' . $e->getMessage()]);
    }

    }



    public function update(Request $request)
    {
        // dd($request->all());

        try{

        $request->validate([
            'foto_ketua_rt' => 'image|mimes:jpeg,png,jpg|max:10240',
            'foto_ketua_rw' => 'image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $NIK = Auth::user()->NIK_penduduk;
        $level = Auth::user()->level;
        $id_penjabatan_users = Auth::user()->id_penjabatan_users;

        //penduduk
        $penduduk_cek = penduduk::where('NIK', $NIK)->exists();
        $penduduk = penduduk::where('NIK', $NIK)->first();
        if($penduduk_cek == true){
            $penduduk->no_hp = $request->input('no_hp');
        $penduduk->email = $request->input('email');
        $penduduk->save();

        }
        

        $user = User::where('NIK_penduduk' , $NIK)->where('level', $level)->first();
        // $penjabatan = User::where('NIK_penduduk' , $NIK)->first();
       
        $user->username = $request->input('username');
        $user->NIK_penduduk = $request->input('NIK_penduduk');
        $user->level = $level;

        $user->status_akun = 1;

        if ($request->hasFile('foto_ketua_rw')) {
            $penjabatan = RW::first();
            $file = $request->file('foto_ketua_rw');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            $filepath = $file->storePubliclyAs('foto_ketua_rw', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/'
            
            if ($penjabatan->foto_ketua_rw) {
                Storage::disk('public')->delete($penjabatan->foto_ketua_rw);
            }

            $penjabatan->foto_ketua_rw = $filepath;
            $penjabatan->save();

        }elseif ($request->hasFile('foto_ketua_rt')){
            $penjabatan = penjabatan_RT::where('id_penjabatan', $id_penjabatan_users)->first();
            $file = $request->file('foto_ketua_rt');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            $filepath = $file->storePubliclyAs('foto_ketua_rt', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/'
            // Delete old photo if exists
            if ($penjabatan->foto_ketua_rt) {
                Storage::disk('public')->delete($penjabatan->foto_ketua_rt);
            }
            $penjabatan->foto_ketua_rt = $filepath;
            $penjabatan->save();
        }

        // dd($user);
        $user->update();

        return redirect()->route('profile')->with('success', 'User Updated successfully!');

    } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Gagal mengedit Data Profile: ' . $e->getMessage()]);
    }

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
    try{

    if (Auth::user()->level == 'RT') {
        $NIK = Auth::user()->NIK_penduduk;
        $id_rt = penduduk::where('NIK', $NIK)->value('id_rt');
        // dd($id_rt);
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

        // Ensure id_rt is in an array format for the view
        $id_rt = [$id_rt];
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

} catch (\Exception $e) {
        // Tangani pengecualian jika terjadi
        return response()->view('errors.error-500', [], 500);
    }

}

public function updateKetua(Request $request, $id)
{
    try{

        $request->validate([
            'foto_ketua' => 'image|mimes:jpeg,png,jpg|max:10000',
        ]);

    // Ambil data penduduk berdasarkan id_ yang diberikan
    $ketua = penjabatan_RT::where('id', $id)->first();

    // dd($request->all());
    if($request->has('tanggal_dilantik')){
        $ketua->tanggal_dilantik = $request->input('tanggal_dilantik');
    }elseif ($request->hasFile('foto_ketua')) {
        $file = $request->file('foto_ketua');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filepath = $file->storePubliclyAs('foto_ketua_rt', $fileName, 'public'); // Simpan di dalam folder 'storage/app/public/'
        $ketua->foto_ketua_rt = $filepath;
    }elseif ($request->has('tanggal_diberhentikan')) {
        $ketua->tanggal_diberhentikan = $request->input('tanggal_diberhentikan');
    }
    
    $ketua->save();

    return redirect()->back()->with('success', 'Data berhasil diperbarui.');

} catch (\Exception $e) {
    return back()->withErrors(['message' => 'Gagal mengedit Data: ' . $e->getMessage()]);
}

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

public function changePassword(Request $request)
{
    $request->validate([
        'new_password' => 'required|string|min:6',
        'confirm_password' => 'required|string|same:new_password',
    ]);

    $user = User::findOrFail($request->user_id);
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->back()->with('success', 'Kata sandi berhasil diubah');
}

public function ganti_sandi(Request $request){

    // dd($request->all());
    // Validasi input dari formulir
    try{

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

} catch (\Exception $e) {
    return back()->withErrors(['message' => 'Gagal Mengganti Sandi: ' . $e->getMessage()]);
}

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
    try{
    $ketua_rt = penjabatan_RT::where('id_penjabatan', $id);
    $ketua_rt->delete();

    return redirect()->route('jabatan')->with('success', 'Deleted successfully!');

} catch (\Exception $e) {
    return back()->withErrors(['message' => 'Gagal Menghapus Data: ' . $e->getMessage()]);
}

}

public function kelola_akun()
{
    try{

    $users = User::all();
    $uniqueLevels = $users->pluck('level')->unique();

    $list_users_admin = User::byLevel('admin')->get();
    $list_users_RT = User::byLevel('RT')->get();
    $list_users_RW = User::byLevel('RW')->get();
    $list_users_pemilik_kos = User::byLevel('pemilik_kos')->get();

    return view('profile.kelola_akun', compact('users', 'uniqueLevels', 'list_users_admin', 'list_users_RT', 'list_users_RW', 'list_users_pemilik_kos'));

} catch (\Exception $e) {
    // Tangani pengecualian jika terjadi
    return response()->view('errors.error-500', [], 500);
}

}


public function toggle_status(Request $request, $id)
{
    try{

    $user = User::findOrFail($id);

    // Mengubah status menjadi kebalikan dari nilai sebelumnya
    $user->status_akun = !$user->status_akun;

    $user->update();

    return redirect()->route('profile.kelola_akun')->with('success', 'berhasil mengganti status!');

} catch (\Exception $e) {
    return back()->withErrors(['message' => 'Gagal mengganti Status: ' . $e->getMessage()]);
}

}

public function delete_akun($id)
{
    try{

    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('profile.kelola_akun')->with('success', 'Deleted successfully!');

} catch (\Exception $e) {
    return back()->withErrors(['message' => 'Gagal menghapus Akun: ' . $e->getMessage()]);
}

}

public function updateFotoKetua(Request $request, $id)
{
    try{

    $request->validate([
        'foto_ketua' => 'image|mimes:jpeg,png,jpg|max:10000',
    ]);

    $ketua = penjabatan_RT::find($id);

    if ($request->hasFile('foto_ketua')) {
        $file = $request->file('foto_ketua');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('foto_ketua_rt', $filename, 'public');

        // Delete old photo if exists
        if ($ketua->foto_ketua_rt) {
            Storage::disk('public')->delete($ketua->foto_ketua_rt);
        }

        $ketua->foto_ketua_rt = $path;
        $ketua->save();
    }

    // Set a session flash message
    session()->flash('message', 'Foto berhasil diubah');
    return response()->json(['message' => 'Foto berhasil diubah'], 200);

    } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Gagal mengedit Data: ' . $e->getMessage()]);
    }

 }


}

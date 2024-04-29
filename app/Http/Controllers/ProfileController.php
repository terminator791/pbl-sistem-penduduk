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
        $no_hp = penduduk::where('NIK', $NIK)->value('no_hp');
        $email = penduduk::where('NIK', $NIK)->value('email');
        $jabatan = Auth::user()->level;

        $list_RT = RT::all();
        return view('profile.index', compact(['list_RT', 'id_rt', 'NIK', 'username', 'nama', 'no_hp', 'email', 'jabatan']));
    }
     public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
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
        $id = penduduk::where('NIK', $NIK)->value('id');
        
        $user = User::findOrFail($id);
        $user->username = $request->input('username');
        $user->NIK_penduduk = $request->input('NIK_penduduk');
        $user->level = $request->input('level');
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
}

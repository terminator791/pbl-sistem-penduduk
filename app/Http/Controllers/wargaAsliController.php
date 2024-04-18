<?php

namespace App\Http\Controllers;

use App\Http\Requests\WargaCreateRequest;
use App\Http\Resources\WargaResource;
use App\Models\keluarga;
use App\Models\pekerjaan;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\perkawinan;
use App\Models\RT;
use App\Models\RW;
use GuzzleHttp\Client;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class wargaAsliController extends Controller
{

    // Read
    public function index(Request $request)
    {
        $menu = $request->query('menu', 'data_warga');
        $penduduk = penduduk::with(['pekerjaan'])
            ->whereNotIn('status_penghuni', ['kos', 'kontrak'])
            ->get();
        $list_RT = RT::with(['RW'])->get();
        return view('dataWarga.wargaAsli.index', compact('menu', 'penduduk', 'list_RT'));
    }

    public function fetchAll()
{
    $penduduk = penduduk::with(['pekerjaan'])
        ->whereNotIn('status_penghuni', ['kos', 'kontrak'])
        ->get();

    // Pastikan data penduduk tidak kosong
    if ($penduduk->isEmpty()) {
        return response()->json(['message' => 'Data penduduk tidak ditemukan'], 404);
    }


    // Kirim data penduduk dalam bentuk JSON
    return response()->json($penduduk, 200);
}

public function showAllWarga()
{
    $response = Http::get('http://localhost:8000/api/v1/wargaAsli');

    $data = $response->json();

    return $data;
}





    public function Create()
    {
        $list_pendidikan = pendidikan::all();
        $list_pekerjaan = pekerjaan::all();
        $list_perkawinan = perkawinan::all();
        $list_RT = RT::with(['RW'])->get();
        $list_keluarga = keluarga::all();
        $list_RW = RW::all();
        return view('dataWarga.wargaAsli.create', compact(
            'list_pendidikan',
            'list_pekerjaan',
            'list_perkawinan',
            'list_RT',
            'list_RW',
            'list_keluarga'
        ));
    }

    public function store(WargaCreateRequest $request) 
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
        
        // Buat instance WargaResource
    $wargaResource = new WargaResource($penduduk);

    // Redirect ke route yang diinginkan dengan membawa data dari WargaResource
    return redirect()->route('wargaAsli')->with('warga', $wargaResource);
    }


    public function simpan(Request $request){
        try{
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

        return response()->json(['message' => 'API Post Success'],200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'API Post gagal',
                
            ],400);
        }
    }


    // Update
    public function edit($id)
    {
        $penduduk = penduduk::findOrFail($id);
        $list_pendidikan = pendidikan::all();
        $list_pekerjaan = pekerjaan::all();
        $list_perkawinan = perkawinan::all();
        $list_RT = RT::all();
        $list_RW = RW::all();
        $list_keluarga = keluarga::all();

        return view('dataWarga.wargaAsli.update', compact(
            'penduduk',
            'list_pendidikan',
            'list_pekerjaan',
            'list_perkawinan',
            'list_RT',
            'list_RW',
            'list_keluarga'
        ));
    }

    public function postData(Request $request){
        $client = new Client();
        try{
            $response = $client->request('POST', route('wargaAsli.store'),[
                'form_params' =>[
                    "NIK"=> "cobaPostApi",
                    "nama"=> "string",
                    "jenis_kelamin"=> "pria",
                    "tempat_lahir"=> "string",
                    "tanggal_lahir"=> "2024-04-17",
                    "agama"=> "islam",
                    "id_pendidikan"=> 1,
                    "id_pekerjaan"=> 2,
                    "id_status_perkawinan"=> 1,
                    "id_rt"=> 2,
                    "id_rw"=> 2,
                    "id_bantuan"=> null,
                    "id_keluarga"=> 1,
                    "nama_jalan"=> "string",
                    "status_penghuni"=> "tetap",
                    "tanggal_peristiwa"=> null,
                    "foto_ktp"=> null,
                    "no_hp"=> "string",
                    "email"=> "string@mail.com"
                ]
                ]);
                dd($response);
            $statusCode = $response->getStatusCode();

            
            if ($statusCode == 200) {
                return redirect()->route('wargaAsli');
            }
            else{
                return redirect()->route('wargaAsli.create');
            }
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        $penduduk = penduduk::where('id', $id)->first();
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

        $penduduk->update();

        return redirect()->route('wargaAsli')->with('success', "$penduduk->nama berhasil diedit");
    }


    // Delete
    public function delete(Request $request, $id)
    {
        $penduduk = penduduk::findOrFail($id);
        $penduduk->delete();
        return redirect()->route('wargaAsli')->with('success', "$penduduk->nama berhasil dihapus");
    }

    //print
    public function print()
    {
        $penduduk = penduduk::with(['pekerjaan'])
        ->whereNotIn('status_penghuni', ['kos', 'kontrak'])
        ->get();
        return view('dataWarga.wargaAsli.print', compact('penduduk'));
    }
}

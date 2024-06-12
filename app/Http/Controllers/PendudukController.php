<?php

namespace App\Http\Controllers;

use App\Models\bantuan;
use App\Models\detail_pendatang;
use App\Models\jenis_kejadian;
use App\Models\jenis_penyakit;
use App\Models\kejadian;
use App\Models\keluarga;
use App\Models\kesehatan;
use App\Models\kos;
use App\Models\pekerjaan;
use App\Models\pendidikan;
use App\Models\penduduk;
use App\Models\penjabatan_RT;
use App\Models\perkawinan;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; // Import Facade File

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $NIK_user = Auth::user()->NIK_penduduk;
        $id_rt = Penduduk::where('NIK', $NIK_user)->value('id_rt');
        $id_rw = Penduduk::where('NIK', $NIK_user)->value('id_rw');

        $roles = penduduk::where('NIK', $NIK_user)->first();
        // dd($roles);
        
        $menu = $request->query('menu', 'data_warga');

        $userLevel = Auth::user()->level;
    
        $list_penduduk_rt = Penduduk::where('id_rt', $id_rt)->get();
        $list_penduduk_rw = Penduduk::where('id_rw', $id_rw)->get();
        $list_penduduk_admin = Penduduk::all();

        $ketuaRTs = penjabatan_RT::whereNull('tanggal_diberhentikan')
        ->join('penduduk', 'penjabatan_RT.NIK_ketua_rt', '=', 'penduduk.NIK')
        ->select('penjabatan_RT.*', 'penduduk.nama AS nama_ketua_rt')
        ->orderBy('id_rt', 'ASC')
        ->get();

        $ketuaRT = penjabatan_RT::whereNull('tanggal_diberhentikan')
    ->join('penduduk', 'penjabatan_RT.NIK_ketua_rt', '=', 'penduduk.NIK')
    ->select('penjabatan_RT.*', 'penduduk.nama AS nama_ketua_rt')
    ->where('penjabatan_RT.id_rt', $id_rt)
    ->get();
    
        $list_ketua_all = penjabatan_RT::all();

        $NIK = Auth::user()->NIK_penduduk;
        $years = detail_pendatang::distinct()->selectRaw('YEAR(tanggal_masuk) as year')->pluck('year')->toArray();
        $years_kesehatan_all = kesehatan::distinct()->selectRaw('YEAR(tanggal_terdampak) as year')->pluck('year')->toArray();
        $years_kejadian_all = kejadian::distinct()->selectRaw('YEAR(tanggal_kejadian) as year')->pluck('year')->toArray();

        $years_kesehatan_rt = kesehatan::whereHas('penduduk', function ($query) use ($id_rt) {
            $query->where('id_rt', $id_rt);
        })->distinct()->selectRaw('YEAR(tanggal_terdampak) as year')->pluck('year')->toArray();
        
        $years_kejadian_rt = kejadian::whereHas('penduduk', function ($query) use ($id_rt) {
            $query->where('id_rt', $id_rt);
        })->distinct()->selectRaw('YEAR(tanggal_kejadian) as year')->pluck('year')->toArray();

        // Ensure years arrays have at least 0 if empty
$years = empty($years) ? [0] : $years;
$years_kesehatan_all = empty($years_kesehatan_all) ? [0] : $years_kesehatan_all;
$years_kejadian_all = empty($years_kejadian_all) ? [0] : $years_kejadian_all;
$years_kesehatan_rt = empty($years_kesehatan_rt) ? [0] : $years_kesehatan_rt;
$years_kejadian_rt = empty($years_kejadian_rt) ? [0] : $years_kejadian_rt;
    
        // Temukan data penduduk berdasarkan NIK pengguna
        $pengguna = penduduk::where('NIK', $NIK)->first();

        if ($userLevel === 'admin') {
            $list_penduduk = $list_penduduk_admin;
            $list_ketua_rt = $ketuaRTs;
            $years_kesehatan = $years_kesehatan_all;
            $years_kejadian = $years_kejadian_all;

        } elseif ($userLevel === 'RW') {
            $list_penduduk = $list_penduduk_rw;
            $list_ketua_rt = $ketuaRTs;
            $years_kesehatan = $years_kesehatan_all;
            $years_kejadian = $years_kejadian_all;

        } elseif ($userLevel === 'RT') {
            $list_penduduk = $list_penduduk_rt;
            $list_ketua_rt = $ketuaRT;
            $years_kesehatan = $years_kesehatan_rt;
            $years_kejadian = $years_kejadian_rt;

        }elseif ($userLevel === 'pemilik_kos') {
            $list_penduduk = $list_penduduk_admin;
            $list_ketua_rt = $ketuaRTs;
            $years_kesehatan = $years_kesehatan_all;
            $years_kejadian = $years_kejadian_all;
        }


        if (Auth::user()->level === 'admin') {
            $nama_pengguna = "Admin";
        
        }elseif (Auth::user()->level === 'RW') {
            $nama_pengguna = $pengguna->nama;
        
        } elseif (Auth::user()->level === 'RT') {
            $nama_pengguna = $pengguna->nama;
          
        }else{
            $nama_pengguna = Auth::user()->username;
           
        }

        // Ambil NIK penduduk yang relevan berdasarkan level user
            $nik_penduduk = $list_penduduk->pluck('NIK');

            // Hitung jumlah penduduk berdasarkan pendidikan untuk penduduk yang relevan
            $educationLevels = pendidikan::withCount(['penduduk' => function ($query) use ($nik_penduduk) {
                $query->whereIn('NIK', $nik_penduduk);
            }])->get();

            // Persiapkan data untuk grafik
            $labels_pendidikan = [];
            $data_pendidikan = [];
            foreach ($educationLevels as $item) {
                $labels_pendidikan[] = $item->jenis_pendidikan;
                $data_pendidikan[] = $item->penduduk_count;
            }

            $maxValue_kesehatan = kesehatan::all()->count();

            //SOSIALCHART
            $SosialLevels = bantuan::withCount(['penduduk' => function ($query) use ($nik_penduduk) {
                $query->whereIn('NIK', $nik_penduduk);
            }])->get();

            // Persiapkan data untuk grafik
            $labels_sosial = [];
            $data_sosial = [];
            foreach ($SosialLevels as $item) {
                $labels_sosial[] = $item->jenis_bantuan;
                $data_sosial[] = $item->penduduk_count;
            }

            //KEJADIANCHART
            $jenis_kejadian = jenis_kejadian::all();
            // Get the count of residents for each disease type
            $data_kejadian = [];
            foreach ($jenis_kejadian as $kejadian) {
                $count = kejadian::where('jenis_kejadian', $kejadian->id)
                    ->whereHas('penduduk', function ($query) use ($nik_penduduk) {
                        $query->whereIn('NIK', $nik_penduduk);
                    })
                    ->count();
                $data_kejadian[$kejadian->jenis_kejadian] = $count;
            }
            $maxValue_kejadian = kejadian::all()->count();

            // Prepare labels and data for the chart
            $labels_kejadian = $jenis_kejadian->pluck('jenis_kejadian');
            $data_kejadian = array_values($data_kejadian);


        // Calculate the maximum value from all years
        $maxValue = detail_pendatang::all()->count();
        // Calculate the maximum value from all years
        $maxpenduduk = penduduk::all()->count();


        // Mendefinisikan semua agama yang mungkin
        $allAgamas = ['islam', 'kristen', 'hindhu', 'Budha', 'konghucu', 'katolik', 'belum terdaftar'];

        // Mendapatkan penduduk yang bukan berstatus 'kos' atau 'kontrak'
        $warga_asli = penduduk::whereNotIn('status_penghuni', ['kos', 'kontrak'])->get();

        // Mengelompokkan penduduk berdasarkan agama dan menghitung jumlahnya
        $jumlah_penghuni_berdasarkan_agama = $warga_asli->groupBy(function ($item) {
            return $item->agama ?? 'belum terdaftar';
        })->map(function ($group) {
            return $group->count();
        });


        // Inisialisasi array dengan semua agama dan set nilai awalnya ke 0
        $agamaCounts = array_fill_keys($allAgamas, 0);

        // Mengupdate jumlah penghuni berdasarkan hasil pengelompokan
        foreach ($jumlah_penghuni_berdasarkan_agama as $agama => $jumlah) {
            $agamaCounts[$agama] = $jumlah;
        }

        // Mendapatkan penduduk yang bukan berstatus 'kos' atau 'kontrak'
        $warga_pendatang = penduduk::whereIn('status_penghuni', ['kos', 'kontrak'])->get();

        // Mengelompokkan penduduk berdasarkan agama dan menghitung jumlahnya
        $jumlah_warga_pendatang_berdasarkan_agama = $warga_pendatang->groupBy(function ($item) {
            return $item->agama ?? 'belum terdaftar';
        })->map(function ($group) {
            return $group->count();
        });

        // Inisialisasi array dengan semua agama dan set nilai awalnya ke 0
        $agamaCounts2 = array_fill_keys($allAgamas, 0);

        // Mengupdate jumlah penghuni berdasarkan hasil pengelompokan
        foreach ($jumlah_warga_pendatang_berdasarkan_agama as $agama2 => $jumlah) {
            $agamaCounts2[$agama2] = $jumlah;
        }

        
        // dd($agamaCounts2);

        return view('home', compact('menu', 'roles', 'labels_pendidikan', 'data_pendidikan', 'id_rt', 'id_rw',  'labels_sosial', 'data_sosial', 'labels_kejadian', 'data_kejadian', 'years', 'maxValue', 'allAgamas', 'agamaCounts', 'agamaCounts2', 'maxpenduduk', 'years_kesehatan', 'maxValue_kesehatan', 'years_kejadian', 'maxValue_kejadian', 'list_ketua_rt', 'ketuaRTs','nama_pengguna'));
    }

    public function fetchKesehatanData(Request $request)
{
    $year = $request->input('year');
    $NIK = Auth::user()->NIK_penduduk;
    $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');
    // Ambil data kesehatan per tahun
    $jenis_penyakit = jenis_penyakit::all();
    $data_kesehatan = [];

    

    if (Auth::user()->level === 'admin') {

        foreach ($jenis_penyakit as $penyakit) {
            $count = Kesehatan::where('id_penyakit', $penyakit->id)
                ->whereHas('penduduk', function ($query) use ($year) {
                    $query->whereYear('tanggal_terdampak', $year);
                })
                ->count();
            $data_kesehatan[$penyakit->nama_penyakit] = $count;
        }
    
    }elseif (Auth::user()->level === 'RW') {

        foreach ($jenis_penyakit as $penyakit) {
            $count = Kesehatan::where('id_penyakit', $penyakit->id)
                ->whereHas('penduduk', function ($query) use ($year) {
                    $query->whereYear('tanggal_terdampak', $year);
                })
                ->count();
            $data_kesehatan[$penyakit->nama_penyakit] = $count;
        }
    
    } elseif (Auth::user()->level === 'RT') {

        foreach ($jenis_penyakit as $penyakit) {
            $count = Kesehatan::where('id_penyakit', $penyakit->id)
                ->whereHas('penduduk', function ($query) use ($year, $id_rt) {
                    $query->where('id_rt', $id_rt)
                          ->whereYear('tanggal_terdampak', $year);
                })
                ->count();
            $data_kesehatan[$penyakit->nama_penyakit] = $count;
        }
      
    }else{

        foreach ($jenis_penyakit as $penyakit) {
            $count = Kesehatan::where('id_penyakit', $penyakit->id)
                ->whereHas('penduduk', function ($query) use ($year) {
                    $query->whereYear('tanggal_terdampak', $year);
                })
                ->count();
            $data_kesehatan[$penyakit->nama_penyakit] = $count;
        }
    }
       


    return response()->json(['labels' => array_keys($data_kesehatan), 'data' => array_values($data_kesehatan)]);
}

public function fetchKejadianData(Request $request)
{
    $year = $request->input('year');
    $NIK = Auth::user()->NIK_penduduk;
    $id_rt = Penduduk::where('NIK', $NIK)->value('id_rt');

    // Ambil data kesehatan per tahun
    $jenis_penyakit = jenis_kejadian::all();
    $data_kesehatan = [];

    if (Auth::user()->level === 'admin') {

        foreach ($jenis_penyakit as $penyakit) {
            $count = kejadian::where('jenis_kejadian', $penyakit->id)
                ->whereHas('penduduk', function ($query) use ($year) {
                    $query->whereYear('tanggal_kejadian', $year);
                })
                ->count();
            $data_kesehatan[$penyakit->jenis_kejadian] = $count;
        }
  
    
    }elseif (Auth::user()->level === 'RW') {

        foreach ($jenis_penyakit as $penyakit) {
            $count = kejadian::where('jenis_kejadian', $penyakit->id)
                ->whereHas('penduduk', function ($query) use ($year) {
                    $query->whereYear('tanggal_kejadian', $year);
                })
                ->count();
            $data_kesehatan[$penyakit->jenis_kejadian] = $count;
        }
        
    
    } elseif (Auth::user()->level === 'RT') {

        foreach ($jenis_penyakit as $penyakit) {
            $count = kejadian::where('jenis_kejadian', $penyakit->id)
                ->whereHas('penduduk', function ($query) use ($year, $id_rt) {
                    $query->where('id_rt', $id_rt)
                          ->whereYear('tanggal_kejadian', $year);
                })
                ->count();
            $data_kesehatan[$penyakit->jenis_kejadian] = $count;
        }
        
      
    }else{

        foreach ($jenis_penyakit as $penyakit) {
            $count = kejadian::where('jenis_kejadian', $penyakit->id)
                ->whereHas('penduduk', function ($query) use ($year) {
                    $query->whereYear('tanggal_kejadian', $year);
                })
                ->count();
            $data_kesehatan[$penyakit->jenis_kejadian] = $count;
        }
        
       
    }

    return response()->json(['labels' => array_keys($data_kesehatan), 'data' => array_values($data_kesehatan)]);
}



public function fetchData(Request $request)
{
    $year = $request->input('year');

    // Determine the latest year and month from both tanggal_masuk and tanggal_keluar columns
    $latestMasukEntry = detail_pendatang::selectRaw('YEAR(tanggal_masuk) as year, MONTH(tanggal_masuk) as month')
        ->orderBy('tanggal_masuk', 'desc')
        ->first();

    $latestKeluarEntry = detail_pendatang::selectRaw('YEAR(tanggal_keluar) as year, MONTH(tanggal_keluar) as month')
        ->whereNotNull('tanggal_keluar')
        ->orderBy('tanggal_keluar', 'desc')
        ->first();

    if ($latestMasukEntry && $latestKeluarEntry) {
        if ($latestMasukEntry->year > $latestKeluarEntry->year || ($latestMasukEntry->year == $latestKeluarEntry->year && $latestMasukEntry->month > $latestKeluarEntry->month)) {
            $latestYear = $latestMasukEntry->year;
            $latestMonth = $latestMasukEntry->month;
        } else {
            $latestYear = $latestKeluarEntry->year;
            $latestMonth = $latestKeluarEntry->month;
        }
    } elseif ($latestMasukEntry) {
        $latestYear = $latestMasukEntry->year;
        $latestMonth = $latestMasukEntry->month;
    } elseif ($latestKeluarEntry) {
        $latestYear = $latestKeluarEntry->year;
        $latestMonth = $latestKeluarEntry->month;
    } else {
        // Handle case where there are no entries
        $latestYear = null;
        $latestMonth = null;
    }

    // Fetch the cumulative count of inhabitants up to the end of the previous year
    $previousYear = $year - 1;
    $previousYearInCount = detail_pendatang::join('penduduk', 'detail_pendatang.NIK', '=', 'penduduk.NIK')
        ->whereYear('tanggal_masuk', '<=', $previousYear)
        ->whereNull('tanggal_keluar') // Only count entries that haven't left yet
        ->count();

    $previousYearOutCount = detail_pendatang::join('penduduk', 'detail_pendatang.NIK', '=', 'penduduk.NIK')
        ->whereNotNull('tanggal_keluar')
        ->whereYear('tanggal_keluar', '<=', $previousYear)
        ->count();

    $previousYearCount = $previousYearInCount - $previousYearOutCount;

    // Fetch data from the database based on the selected year
    $monthlyInCounts = detail_pendatang::join('penduduk', 'detail_pendatang.NIK', '=', 'penduduk.NIK')
        ->selectRaw('MONTH(tanggal_masuk) as month, COUNT(*) as count')
        ->whereYear('tanggal_masuk', $year)
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

    $monthlyOutCounts = detail_pendatang::join('penduduk', 'detail_pendatang.NIK', '=', 'penduduk.NIK')
        ->selectRaw('MONTH(tanggal_keluar) as month, COUNT(*) as count')
        ->whereYear('tanggal_keluar', $year)
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

    // Initialize arrays for labels and data
    $labels = [];
    $data = [];
    $cumulativeCount = $previousYearCount;

    // Populate arrays with fetched data
    for ($month = 1; $month <= 12; $month++) {
        $monthLabel = date('F', mktime(0, 0, 0, $month, 1));
        $labels[] = $monthLabel;

        // Check if the selected year is the latest year and the month is after the latest month
        if ($year == $latestYear && $month > $latestMonth) {
            // Data after the latest month should be null if the selected year is the latest year
            $data[] = null;
        } else {
            // Otherwise, continue adding data
            $monthInData = $monthlyInCounts->firstWhere('month', $month);
            $monthOutData = $monthlyOutCounts->firstWhere('month', $month);

            if ($monthInData) {
                $cumulativeCount += $monthInData->count;
            }
            if ($monthOutData) {
                $cumulativeCount -= $monthOutData->count;
            }

            $data[] = $cumulativeCount;
        }
    }

    // If you need to prepare the response as JSON
    return response()->json([
        'labels' => $labels,
        'data' => $data
    ]);
}





//     public function fetchData(Request $request)
// {
//     $year = $request->input('year');

//     // Determine the latest year and month from detail_pendatang table
//     $latestEntry = detail_pendatang::selectRaw('YEAR(tanggal_masuk) as year, MONTH(tanggal_masuk) as month')
//         ->orderBy('tanggal_masuk', 'desc')
//         ->first();

//     $latestYear = $latestEntry->year;
//     $latestMonth = $latestEntry->month;

//     // Fetch the cumulative count of inhabitants up to the end of the previous year
//     $previousYear = $year - 1;
//     $previousYearCount = detail_pendatang::join('penduduk', 'detail_pendatang.NIK', '=', 'penduduk.NIK')
//         ->whereYear('tanggal_masuk', '<=', $previousYear)
//         ->count();

//     // Fetch data from the database based on the selected year
//     $monthlyCounts = detail_pendatang::join('penduduk', 'detail_pendatang.NIK', '=', 'penduduk.NIK')
//         ->selectRaw('MONTH(tanggal_masuk) as month, COUNT(*) as count')
//         ->whereYear('tanggal_masuk', $year)
//         ->groupBy('month')
//         ->orderBy('month', 'asc')
//         ->get();

//     // Initialize arrays for labels and data
//     $labels = [];
//     $data = [];
//     $cumulativeCount = $previousYearCount;

//     // Populate arrays with fetched data
//     for ($month = 1; $month <= 12; $month++) {
//         $monthLabel = date('F', mktime(0, 0, 0, $month, 1));
//         $labels[] = $monthLabel;

//         // Check if the selected year is the latest year and the month is after the latest month
//         if ($year == $latestYear && $month > $latestMonth) {
//             // Data after the latest month should be null if the selected year is the latest year
//             $data[] = null;
//         } else {
//             // Otherwise, continue adding data
//             $monthData = $monthlyCounts->firstWhere('month', $month);
//             if ($monthData) {
//                 $cumulativeCount += $monthData->count;
//             }
//             $data[] = $cumulativeCount;
//         }
//     }
//         // If you need to prepare the response as JSON
//         return response()->json([
//             'labels' => $labels,
//             'data' => $data
//         ]);

// }




    public function fetchData_pertumbuhan_kos(Request $request)
{
    $year = $request->input('year');
    
    // Fetch data from the database based on the selected year
    $monthlyCounts = detail_pendatang::join('penduduk', 'detail_pendatang.NIK', '=', 'penduduk.NIK')
        ->selectRaw('MONTH(tanggal_masuk) as month, COUNT(*) as count')
        ->whereYear('tanggal_masuk', $year)
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

    // Initialize arrays for labels and data with 12 months
    $labels = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    $data = array_fill(0, 12, 0);

    // Populate arrays with fetched data
    foreach ($monthlyCounts as $count) {
        $data[$count->month - 1] = $count->count;
    }

    return response()->json([
        'labels' => $labels,
        'data' => $data
    ]);
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

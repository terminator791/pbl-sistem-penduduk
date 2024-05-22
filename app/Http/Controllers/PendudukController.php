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

        if ($userLevel === 'admin') {
            $list_penduduk = $list_penduduk_admin;
        } elseif ($userLevel === 'RW') {
            $list_penduduk = $list_penduduk_rw;
        } elseif ($userLevel === 'RT') {
            $list_penduduk = $list_penduduk_rt;
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

            //KESEHATANCHART
            $jenis_penyakit = jenis_penyakit::all();
            // Get the count of residents for each disease type
            $data_kesehatan = [];
            foreach ($jenis_penyakit as $penyakit) {
                $count = kesehatan::where('id_penyakit', $penyakit->id)
                    ->whereHas('penduduk', function ($query) use ($nik_penduduk) {
                        $query->whereIn('NIK', $nik_penduduk);
                    })
                    ->count();
                $data_kesehatan[$penyakit->nama_penyakit] = $count;
            }
            // Prepare labels and data for the chart
            $labels_kesehatan = $jenis_penyakit->pluck('nama_penyakit');
            $data_kesehatan = array_values($data_kesehatan);

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
            // Prepare labels and data for the chart
            $labels_kejadian = $jenis_kejadian->pluck('jenis_kejadian');
            $data_kejadian = array_values($data_kejadian);

            $years = detail_pendatang::distinct()->selectRaw('YEAR(tanggal_masuk) as year')->pluck('year')->toArray();

        return view('home', compact('menu', 'roles', 'labels_pendidikan', 'data_pendidikan', 'id_rt', 'id_rw', 'labels_kesehatan', 'data_kesehatan', 'labels_sosial', 'data_sosial', 'labels_kejadian', 'data_kejadian', 'years'));
    }

    public function fetchData(Request $request)
{
    $year = $request->input('year');

// Determine the latest year and month from detail_pendatang table
$latestEntry = detail_pendatang::selectRaw('YEAR(tanggal_masuk) as year, MONTH(tanggal_masuk) as month')
    ->orderBy('tanggal_masuk', 'desc')
    ->first();

$latestYear = $latestEntry->year;
$latestMonth = $latestEntry->month;

// Fetch the cumulative count of inhabitants up to the end of the previous year
$previousYear = $year - 1;
$previousYearCount = detail_pendatang::join('penduduk', 'detail_pendatang.NIK', '=', 'penduduk.NIK')
    ->whereYear('tanggal_masuk', '<=', $previousYear)
    ->count();

// Fetch data from the database based on the selected year
$monthlyCounts = detail_pendatang::join('penduduk', 'detail_pendatang.NIK', '=', 'penduduk.NIK')
    ->selectRaw('MONTH(tanggal_masuk) as month, COUNT(*) as count')
    ->whereYear('tanggal_masuk', $year)
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
        $monthData = $monthlyCounts->firstWhere('month', $month);
        if ($monthData) {
            $cumulativeCount += $monthData->count;
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
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\jenis_penyakit;
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
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $tanggal_lahir = Carbon::createFromFormat('Y-m-d', '2004-06-15');

        keluarga::create([
            'status_keluarga' => 'kepala keluarga'
        ],);

        keluarga::create([
            'status_keluarga' => 'istri'
        ],);

        keluarga::create([
            'status_keluarga' => 'anak'
        ],);
        


        perkawinan::create([
            'status_perkawinan' => 'Nikah',
        ]);
        perkawinan::create([
            'status_perkawinan' => 'Belum Nikah',
        ]);

        pendidikan::create([
            'jenis_pendidikan' => 'SD',
        ]);
        pendidikan::create([
            'jenis_pendidikan' => 'SMP',
        ]);
        pendidikan::create([
            'jenis_pendidikan' => 'SMA/SMK',
        ]);
        pendidikan::create([
            'jenis_pendidikan' => 'Sarjana',
        ]);

        pekerjaan::create([
            'jenis_pekerjaan' => 'PNS',
        ]);

        pekerjaan::create([
            'jenis_pekerjaan' => 'kerja rodi',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Mengurus Rumah Tangga',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pelajar/Mahasiswa',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Belum/Tidak Bekerja',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pensiunan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pegawai Negeri Sipil',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tentara Nasional Indonesia',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Perdagangan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Petani/Pekebun',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Peternak',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Nelayan/Perikanan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Industri',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Konstruksi',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Transportasi',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Karyawan Swasta',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Karyawan Honorer',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Buruh Harian Lepas',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Buruh Tani/Perkebunan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Buruh Nelayan/Perikanan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Buruh Peternakan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pembantu Rumah Tangga',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tukang Cukur',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tukang Listrik',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tukang Batu',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tukang Kayu',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tukang Sol Sepatu',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tukang Las/Pandai Besi',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tukang Jahit',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tukang Gigi',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Penata Rias',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Penata Busana',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Penata Rambut',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Mekanik',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Seniman',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Tabib',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Paraji',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Perancang Busana',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Penterjemah',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Imam Mesjid',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pendeta',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pastor',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Wartawan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Ustadz/Mubaligh',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Juru Masak',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Promotor Acara',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Anggota DPR-RI',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Anggota DPD',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Anggota BPK',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Presiden',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Wakil Presiden',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Anggota Mahkamah Konstitusi',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Anggota Kabinet/Kementerian',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Duta Besar',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Gubernur',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Wakil Gubernur',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Bupati',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Wakil Bupati',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Walikota',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Wakil Walikota',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Anggota DPRD Provinsi',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Anggota DPRD Kabupaten/Kota',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Dosen',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Guru',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pilot',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pengacara',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Notaris',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Arsitek',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Akuntan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Konsultan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Dokter',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Bidan',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Perawat',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Apoteker',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Psikiater/Psikolog',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Penyiar Televisi',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Penyiar Radio',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pelaut',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Peneliti',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Sopir',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Pialang',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Paranormal',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Kepala Desa',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Biarawati',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Wiraswasta',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Polri',
        ]);
        pekerjaan::create([
            'jenis_pekerjaan' => 'Lain-lain',
        ]);



        RW::create([
            'nama_rw' => '01',
            'ketua_rw' => 'Rifqi'
           
        ],);
        RW::create([
            'nama_rw' => '02',
            'ketua_rw' => 'Iqbal'
           
        ],);
        RW::create([
            'nama_rw' => '03',
            'ketua_rw' => 'Husein'
           
        ],);


        RT::create([
            'nama_rt' => '01',
            'id_rw' => '1',
            
        ],);
        RT::create([
            'nama_rt' => '02',
            'id_rw' => '1',
            
        ],);
        RT::create([
            'nama_rt' => '03',
            'id_rw' => '2',
           
        ],);
        RT::create([
            'nama_rt' => '04',
            'id_rw' => '2',
            
        ],);
        RT::create([
            'nama_rt' => '05',
            'id_rw' => '3',
            
        ],);




        jenis_penyakit::create([
            'nama_penyakit' => 'HIV/AIDS'
        ],);
        jenis_penyakit::create([
            'nama_penyakit' => 'COVID-19'
        ],);
        jenis_penyakit::create([
            'nama_penyakit' => 'Stunting'
        ],);
        jenis_penyakit::create([
            'nama_penyakit' => 'Demam Berdarah'
        ],);
        jenis_penyakit::create([
            'nama_penyakit' => 'Kanker'
        ],);

        

        penduduk::create([
            'NIK' => '3317120041795',
            'nama' => "Mohammad Iqbal Bagus",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Rembang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 1,
            'id_status_perkawinan' => 1,
            'id_rt' => 1,
            'id_keluarga' => 1,
            'status_penghuni' => 'meninggal',
            'nama_jalan' => 'Jl Galang Sewu No. 1',
            'email' => 'iqbalbagus@mail.com',
            'no_hp' => '0895423630600',

        ],);
        

        penduduk::create([
            'NIK' => '3317120041796',
            'nama' => "Rifqi haezul",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Rembang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 2,
            'id_status_perkawinan' => 2,
            'id_rt' => 2,
            'id_keluarga' => 2,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl nirwana sari no 30',
            'email' => 'rifqi.haezul@mail.com',
            'no_hp' => '0895423630600',

        ],);

        kesehatan::create([
            'id_penyakit' => '2',
            'NIK_penduduk' => '3317120041796',
            'tanggal_terdampak' => $tanggal_lahir,
        ],);
        kesehatan::create([
            'id_penyakit' => '4',
            'NIK_penduduk' => '3317120041795',
            'tanggal_terdampak' => $tanggal_lahir,
        ],);
        
    }
}

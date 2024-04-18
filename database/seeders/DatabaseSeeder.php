<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\bantuan;
use App\Models\detail_pendatang;
use App\Models\jenis_kejadian;
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


        
        jenis_kejadian::create([
            'jenis_kejadian' => 'Banjir'
        ],);
        jenis_kejadian::create([
            'jenis_kejadian' => 'Tanah_Longsor'
        ],);
        jenis_kejadian::create([
            'jenis_kejadian' => 'Gempa_Bumi'
        ],);
        jenis_kejadian::create([
            'jenis_kejadian' => 'Gunung_Meletus'
        ],);
        jenis_kejadian::create([
            'jenis_kejadian' => 'Tsunami'
        ],);
        jenis_kejadian::create([
            'jenis_kejadian' => 'Lain-lain'
        ],);

        bantuan::create([
            'jenis_bantuan' => 'Prakerja'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'PKH'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'Miskin'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'BPNT'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'BSU'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'Yatim_Piatu'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'Disabilitas'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'BLT'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'Yatim'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'Piatu'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'PBI/JKN'
        ],);
        bantuan::create([
            'jenis_bantuan' => 'BPNT/PKM'
        ],);





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
            'nama_penyakit' => 'Demam_Berdarah'
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
            'id_rw' => 1,
            'id_keluarga' => 1,
            'status_penghuni' => 'meninggal',
            'nama_jalan' => 'Jl Galang Sewu No. 1',
            'email' => 'iqbalbagus@mail.com',
            'no_hp' => '0895423630500',

        ],);
        penduduk::create([
            'NIK' => '3317120041796',
            'nama' => "Sandra",
            'jenis_kelamin' => 'wanita',
            'tempat_lahir' => 'Pematang Siantar',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'katolik',
            'id_pendidikan' => 3,
            'id_pekerjaan' => 5,
            'id_status_perkawinan' => 2,
            'id_rt' => 2,
            'id_rw' => 1,
            'id_keluarga' => 2,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl Galang Sewu No. 30',
            'email' => 'sandra@mail.com',
            'no_hp' => '0895423630600',

        ],);
        penduduk::create([
            'NIK' => '3317120041797',
            'nama' => "Rifqi haezul",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Rembang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 13,
            'id_status_perkawinan' => 2,
            'id_rt' => 4,
            'id_rw' => 2,
            'id_keluarga' => 2,
            'status_penghuni' => 'kos',
            'nama_jalan' => 'Jl nirwana sari no 30',
            'email' => 'rifqi.haezul@mail.com',
            'no_hp' => '0895423630600',

        ],);
        penduduk::create([
            'NIK' => '3317120041798',
            'nama' => "Dandy",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 13,
            'id_status_perkawinan' => 2,
            'id_rt' => 5,
            'id_rw' => 1,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl mulawarman',
            'email' => 'dandy@mail.com',
            'no_hp' => '089582476573',
        ],);

        penduduk::create([
            'NIK' => '3317120041799',
            'nama' => "Arip",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Sragen',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 12,
            'id_status_perkawinan' => 2,
            'id_rt' => 4,
            'id_rw' => 3,
            'id_keluarga' => 3,
            'status_penghuni' => 'kos',
            'nama_jalan' => 'Jl gondang',
            'email' => 'arip@mail.com',
            'no_hp' => '089529377482',
        ],);

        penduduk::create([
            'NIK' => '3317120041800',
            'nama' => "Ryvanio",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 8,
            'id_status_perkawinan' => 1,
            'id_rt' => 2,
            'id_rw' => 1,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl sampangan',
            'email' => 'ripans@mail.com',
            'no_hp' => '089552439685',
        ],);

        penduduk::create([
            'NIK' => '3317120041801',
            'nama' => "Farhan",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 9,
            'id_status_perkawinan' => 2,
            'id_rt' => 1,
            'id_rw' => 3,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl cipto',
            'email' => 'farhan@mail.com',
            'no_hp' => '089598764567',
        ],);

        penduduk::create([
            'NIK' => '3317120041802',
            'nama' => "Gavrilla",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 4,
            'id_status_perkawinan' => 2,
            'id_rt' => 5,
            'id_rw' => 1,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl majapahit',
            'email' => 'gavrill@mail.com',
            'no_hp' => '089509878971',
        ],);

        penduduk::create([
            'NIK' => '3317120041803',
            'nama' => "Arya",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Meteseh',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 9,
            'id_status_perkawinan' => 2,
            'id_rt' => 2,
            'id_rw' => 3,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl pahlawan',
            'email' => 'aryacihuy@mail.com',
            'no_hp' => '089543527589',
        ],);

        penduduk::create([
            'NIK' => '3317120041804',
            'nama' => "yasir",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => '',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 8,
            'id_status_perkawinan' => 2,
            'id_rt' => 3,
            'id_rw' => 2,
            'id_keluarga' => 1,
            'status_penghuni' => 'kos',
            'nama_jalan' => 'Jl antasari',
            'email' => 'yasir@mail.com',
            'no_hp' => '089553649163',
        ],);

        penduduk::create([
            'NIK' => '3317120041805',
            'nama' => "Diva",
            'jenis_kelamin' => 'wanita',
            'tempat_lahir' => 'Malang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'kristen',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 5,
            'id_status_perkawinan' => 2,
            'id_rt' => 2,
            'id_rw' => 2,
            'id_keluarga' => 3,
            'status_penghuni' => 'kos',
            'nama_jalan' => 'Jl suhat',
            'email' => 'diva@mail.com',
            'no_hp' => '089574659283',
        ],);

        penduduk::create([
            'NIK' => '3317120041806',
            'nama' => "Haezul",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 1,
            'id_status_perkawinan' => 2,
            'id_rt' => 5,
            'id_rw' => 3,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl veteran',
            'email' => 'haezul@mail.com',
            'no_hp' => '089575920984',
        ],);

        penduduk::create([
            'NIK' => '3317120041807',
            'nama' => "Della",
            'jenis_kelamin' => 'wanita',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 17,
            'id_status_perkawinan' => 2,
            'id_rt' => 4,
            'id_rw' => 2,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl dukuhturi',
            'email' => 'della@mail.com',
            'no_hp' => '089563728573',
        ],);

        penduduk::create([
            'NIK' => '3317120041808',
            'nama' => "Bila",
            'jenis_kelamin' => 'wanita',
            'tempat_lahir' => 'Rembang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 1,
            'id_status_perkawinan' => 2,
            'id_rt' => 1,
            'id_rw' => 3,
            'id_keluarga' => 3,
            'status_penghuni' => 'kos',
            'nama_jalan' => 'Jl wisma',
            'email' => 'bila@mail.com',
            'no_hp' => '089562749786',
        ],);

        penduduk::create([
            'NIK' => '3317120041809',
            'nama' => "Harkas",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 21,
            'id_status_perkawinan' => 2,
            'id_rt' => 5,
            'id_rw' => 1,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl gajahmada',
            'email' => 'harkas@mail.com',
            'no_hp' => '089576859372',
        ],);

                penduduk::create([
            'NIK' => '3317120041810',
            'nama' => "Rayhan",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'katolik',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 1,
            'id_status_perkawinan' => 1,
            'id_rt' => 3,
            'id_rw' => 2,
            'id_keluarga' => 1,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl pemuda',
            'email' => 'rayhan@mail.com',
            'no_hp' => '089562538697',
        ],);

        penduduk::create([
            'NIK' => '3317120041811',
            'nama' => "Abil",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 3,
            'id_status_perkawinan' => 2,
            'id_rt' => 4,
            'id_rw' => 2,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl antari',
            'email' => 'abil@mail.com',
            'no_hp' => '089596855243',
        ],);

        penduduk::create([
            'NIK' => '3317120041812',
            'nama' => "Rahmat",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 24,
            'id_status_perkawinan' => 2,
            'id_rt' => 5,
            'id_rw' => 1,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl diponegoro',
            'email' => 'rahmat@mail.com',
            'no_hp' => '089565748675',
        ],);

        penduduk::create([
            'NIK' => '3317120041813',
            'nama' => "Jeedan",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 15,
            'id_status_perkawinan' => 2,
            'id_rt' => 4,
            'id_rw' => 1,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl veteran',
            'email' => 'jeedan@mail.com',
            'no_hp' => '089553427586',
        ],);

        penduduk::create([
            'NIK' => '3317120041814',
            'nama' => "Hasan",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'hindhu',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 10,
            'id_status_perkawinan' => 2,
            'id_rt' => 2,
            'id_rw' => 2,
            'id_keluarga' => 3,
            'status_penghuni' => 'tetap',
            'nama_jalan' => 'Jl diponegoro',
            'email' => 'hasan@mail.com',
            'no_hp' => '089582476527',
        ],);

        penduduk::create([
            'NIK' => '3317120041815',
            'nama' => "Dandy",
            'jenis_kelamin' => 'pria',
            'tempat_lahir' => '',
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => 'islam',
            'id_pendidikan' => 4,
            'id_pekerjaan' => 4,
            'id_status_perkawinan' => 2,
            'id_rt' => 3,
            'id_rw' => 2,
            'id_keluarga' => 1,
            'status_penghuni' => 'kos',
            'nama_jalan' => 'Jl mulawarman',
            'email' => 'dandy@mail.com',
            'no_hp' => '089582476573',
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


        kos::create([
            'id_rt' => 1,
            'pemilik_kos' => 'iqbal bagus',
            'nama_kos' => 'Baskoro 69',
            'alamat_kos' => 'Jalan Galang Sewu No. 1',
            'jumlah_penghuni' => 8,
            'no_hp_pemilik' => '0895423630500',
            'email_pemilik' => 'iqbal@mail.com',
            'status' => true,
            
        ],);

        kos::create([
            'id_rt' => 2,
            'pemilik_kos' => 'iqbal bagus',
            'nama_kos' => 'Baskoro 70',
            'alamat_kos' => 'Jalan Galang Sewu No. 1',
            'jumlah_penghuni' => 11,
            'no_hp_pemilik' => '0895423630500',
            'email_pemilik' => 'iqbal@mail.com',
            'status' => false,
        ],);

        kos::create([
            'id_rt' => '5',
            'pemilik_kos' => 'Rifqi',
            'nama_kos' => 'Norma House',
            'alamat_kos' => 'Jalan Nirwana Sari No. 30',
            'jumlah_penghuni' => 19,
            'no_hp_pemilik' => '08213131231',
            'email_pemilik' => 'rifqi@mail.com',
            'status' => true,
        ],);

        detail_pendatang::create([
            'NIK' => '3317120041795',
            'id_kos' => 1,
            'tanggal_masuk' => $tanggal_lahir,
            'tanggal_keluar' => $tanggal_lahir,
        ],);

        detail_pendatang::create([
            'NIK' => '3317120041796',
            'id_kos' => 1,
            'tanggal_masuk' => $tanggal_lahir,
            'tanggal_keluar' => $tanggal_lahir,
        ],);

        detail_pendatang::create([
            'NIK' => '3317120041797',
            'id_kos' => 2,
            'tanggal_masuk' => $tanggal_lahir,
            'tanggal_keluar' => $tanggal_lahir,
        ],);
        
    }
}

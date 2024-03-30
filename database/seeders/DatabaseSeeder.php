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
            'status_penghuni' => 'mati',
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
            'status_penghuni' => 'hidup',
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

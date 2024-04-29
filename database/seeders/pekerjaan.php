<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penduduk; // Import model Penduduk
use Faker\Factory as Faker;

class Pekerjaan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate random names
$maleNames = ["Jeedan", "Hasan", "Dandy", "Farhan", "Rizky", "Dika", "Arif", "Galih", "Fajar", "Ryan", "Aldi", "Budi", "Andi", "Eko", "Hendro", "Irfan", "Joko", "Krisna", "Lukman", "Maman"];
$femaleNames = ["Siti", "Rina", "Dewi", "Reni", "Ani", "Maya", "Sari", "Diana", "Nia", "Eva", "Ratna", "Lia", "Fitri", "Indah", "Putri", "Wulan", "Tika", "Yuni", "Rita", "Nina"];
$agamas = ['islam', 'kristen', 'hindhu', 'Budha', 'konghucu', 'katolik'];
$status_penghuni_options = ['kos', 'kontrak', 'tetap', 'pindah'];
// Generate random data
$data = [];
for ($i = 0; $i < 50; $i++) {
    $NIK = '33' . sprintf('%010d', $i + 1);
    $nama = $i % 2 == 0 ? $maleNames[array_rand($maleNames)] : $femaleNames[array_rand($femaleNames)];
    $jenis_kelamin = $i % 2 == 0 ? 'pria' : 'wanita';
    $tempat_lahir = 'Semarang'; // You can change this if needed
    $tanggal_lahir = '2004-01-01'; // You can change this if needed
    $agama = $agamas[array_rand($agamas)];
    $id_pendidikan = mt_rand(1, 4);
    $id_pekerjaan = mt_rand(1, 25);
    $id_status_perkawinan = mt_rand(1, 2);
    $id_rt = mt_rand(1, 5);
    $id_rw = mt_rand(1, 2);
    $id_keluarga = mt_rand(1, 3);
    $status_penghuni = $status_penghuni_options[array_rand($status_penghuni_options)];
    $nama_jalan = 'Jl ' . ($id_rt == 5 ? 'veteran' : ($id_rt == 4 ? 'diponegoro' : 'mulawarman')); // Assuming different streets for different RTs
    $email = strtolower($nama) . "@mail.com"; // Assuming email format based on name
    $no_hp = '089' . mt_rand(100000000, 999999999);

    $data[] = [
        'NIK' => $NIK,
        'nama' => $nama,
        'jenis_kelamin' => $jenis_kelamin,
        'tempat_lahir' => $tempat_lahir,
        'tanggal_lahir' => $tanggal_lahir,
        'agama' => $agama,
        'id_pendidikan' => $id_pendidikan,
        'id_pekerjaan' => $id_pekerjaan,
        'id_status_perkawinan' => $id_status_perkawinan,
        'id_rt' => $id_rt,
        'id_rw' => $id_rw,
        'id_keluarga' => $id_keluarga,
        'status_penghuni' => $status_penghuni,
        'nama_jalan' => $nama_jalan,
        'email' => $email,
        'no_hp' => $no_hp,
    ];
}

// Insert data into database
foreach ($data as $row) {
    penduduk::create($row);
}

        // $faker = Faker::create('id_ID');

        // // Fungsi untuk mendapatkan NIK berikutnya
        // function getNextNIK($currentNIK) {
        //     $prefix = substr($currentNIK, 0, -1);
        //     $suffix = intval(substr($currentNIK, -1));
        //     $suffix++;
        //     return $prefix . $suffix;
        // }
        

        // $nik = '331712014200'; // NIK awal

        // for ($i = 0; $i < 20; $i++) {
        //     do {
        //         $nik = getNextNIK($nik);
        //     } while (Penduduk::where('NIK', $nik)->exists()); // Periksa apakah NIK sudah ada di dalam tabel
        
        //     $nama = $faker->name;
        //     $jenis_kelamin = $faker->randomElement(['pria', 'wanita']);
        //     $tempat_lahir = $faker->city;
        //     $tanggal_lahir = $faker->date($format = 'Y-m-d', $max = 'now');
        //     $agama = $faker->randomElement(['islam', 'kristen', 'hindhu', 'Budha', 'konghucu','katolik']);
        //     $id_pendidikan = $faker->numberBetween(1, 4);
        //     $id_pekerjaan = $faker->numberBetween(1, 25);
        //     $id_status_perkawinan = $faker->numberBetween(1, 2);
        //     $id_rt = $faker->numberBetween(1, 5);
        //     $id_rw = $faker->numberBetween(1, 2);
        //     $id_keluarga = $faker->numberBetween(1, 3);
        //     $status_penghuni = $faker->randomElement(['tetap', 'kos', 'kontrak', 'pindah']);
        //     $nama_jalan = $faker->streetName;
        //     $email = $faker->email;
        //     $no_hp = $faker->phoneNumber;

        //     // Simpan data ke dalam tabel penduduks
        //     Penduduk::create([
        //         'NIK' => $nik,
        //         'nama' => $nama,
        //         'jenis_kelamin' => $jenis_kelamin,
        //         'tempat_lahir' => $tempat_lahir,
        //         'tanggal_lahir' => $tanggal_lahir,
        //         'agama' => $agama,
        //         'id_pendidikan' => $id_pendidikan,
        //         'id_pekerjaan' => $id_pekerjaan,
        //         'id_status_perkawinan' => $id_status_perkawinan,
        //         'id_rt' => $id_rt,
        //         'id_rw' => $id_rw,
        //         'id_keluarga' => $id_keluarga,
        //         'status_penghuni' => $status_penghuni,
        //         'nama_jalan' => $nama_jalan,
        //         'email' => $email,
        //         'no_hp' => $no_hp,
        //     ]);
        // }
    }
}

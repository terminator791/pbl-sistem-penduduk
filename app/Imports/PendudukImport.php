<?php

namespace App\Imports;

use App\Models\penduduk;
use Maatwebsite\Excel\Concerns\ToModel;

class PendudukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new penduduk([
            "NIK" => $row["NIK"],
            "nama" => $row["nama"],
            "jenis_kelamin" => $row["jenis_kelamin"],
            "tempat_lahir" => $row["tempat_lahir"],
            "tanggal_lahir" => $row["tanggal lahor"],
            "agama" => $row["agama"],
            "id_pendidikan" => $row["pendidikan"],
            "id_pekerjaan" => $row["pekerjaan"],
            "id_status_perkawinan" => $row["status_perkawinan"],
            "id_rt" => $row["rt"],
            "id_rw" => $row["rw"],
            "id_bantuan" => $row["bantuan"],
            "nama_jalan" => $row["alamat"],
            "status_penghuni" => $row["status_penghuni"],
            "no_hp" => $row["no_hp"],
            "email" => $row["email"]
        ]);
    }
}

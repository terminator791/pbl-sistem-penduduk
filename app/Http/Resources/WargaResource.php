<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WargaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'NIK' => $this->NIK,
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'agama' => $this->agama,
            'id_pendidikan' => $this->id_pendidikan,
            'id_pekerjaan' => $this->id_pekerjaan,
            'id_status_perkawinan' => $this->id_status_perkawinan,
            'id_rt' => $this->id_rt,
            'id_rw' => $this->id_rw,
            'id_bantuan' => $this->id_bantuan,
            'id_keluarga' => $this->id_keluarga,
            'nama_jalan' => $this->nama_jalan,
            'status_penghuni' => $this->status_penghuni,
            'tanggal_peristiwa' => $this->tanggal_peristiwa,
            'foto_ktp' => $this->foto_ktp, // Tidak termasuk dalam contoh karena berupa binary
            'no_hp' => $this->no_hp,
            'email' => $this->email,
        ];
    }
}

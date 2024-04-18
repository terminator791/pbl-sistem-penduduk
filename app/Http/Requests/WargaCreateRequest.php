<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WargaCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'NIK' => ['required', 'string', 'max:255', 'unique:penduduk,NIK'], 
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'string', 'in:pria,wanita'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'agama' => ['required', 'string', 'in:islam,kristen,hindhu,Budha,konghucu,katolik'],
            'id_pendidikan' => ['nullable', 'integer'],
            'id_pekerjaan' => ['required', 'integer'],
            'id_status_perkawinan' => ['nullable', 'integer'],
            'id_rt' => ['nullable', 'integer'],
            'id_rw' => ['nullable', 'integer'],
            'id_bantuan' => ['nullable', 'integer'],
            'id_keluarga' => ['nullable', 'integer'],
            'nama_jalan' => ['required', 'string', 'max:255'],
            'status_penghuni' => ['required', 'string', 'in:kos,kontrak,tetap,pindah,meninggal'],
            'tanggal_peristiwa' => ['nullable', 'date'],
            'foto_ktp' => ['nullable', 'binary'], // Aturan validasi untuk foto KTP
            'no_hp' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'max:255'],
        ];
    }
}

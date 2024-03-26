<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_penyakit extends Model
{
    use HasFactory;

    protected $table = 'jenis_penyakit';

    protected $guarded = ['id'];

    public function penduduk(){
        return $this->belongsToMany(penduduk::class, 'kesehatan', 'id_penyakit', 'NIK_penduduk');
    }

    public function kesehatan(){
        return $this->hasMany(kesehatan::class, 'id_penyakit');
    }
}

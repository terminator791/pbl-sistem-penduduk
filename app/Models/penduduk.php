<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';

    protected $guarded = ['id'];

    public function keluarga(){
        return $this->belongsTo(keluarga::class, 'id');
    }
    public function perkawinan(){
        return $this->belongsTo(perkawinan::class, 'id');
    }

    public function pendidikan(){
        return $this->belongsTo(pendidikan::class, 'id');
    }

    public function pekerjaan(){
        return $this->belongsTo(pekerjaan::class, 'id');
    }

    public function bantuan(){
        return $this->belongsTo(bantuan::class, 'id');
    }

    public function rw(){
        return $this->belongsTo(RW::class, 'id')->withTimestamps();
    }

    public function penjabatan_rt(){
        return $this->hasMany(penjabatan_RT::class, 'NIK_ketua_rt')->withTimestamps();
    }
    
    public function rt(){
        return $this->belongsToMany(RT::class, 'penjabatan_rt', 'NIK_ketua_rt', 'id_rt')->withTimestamps();
    }

    public function kejadian(){
        return $this->hasMany(kejadian::class, 'NIK_penduduk')->withTimestamps();
    }
    
    public function jenis_kejadian(){
        return $this->belongsToMany(jenis_kejadian::class, 'kejadian', 'NIK_penduduk', 'id_rt')->withTimestamps();
    }

    public function detail_pendatang(){
        return $this->hasMany(detail_pendatang::class, 'NIK')->withTimestamps();
    }
    
    public function kos(){
        return $this->belongsToMany(kos::class, 'detail_pendatang', 'NIK', 'id_kos')->withTimestamps();
    }

    public function jenis_penyakit(){
        return $this->belongsToMany(jenis_penyakit::class, 'kesehatan', 'NIK_penduduk', 'id_penyakit');
    }

    public function kesehatan(){
        return $this->hasMany(kesehatan::class, 'NIK_penduduk');
    }
    
}

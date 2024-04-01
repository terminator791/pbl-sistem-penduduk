<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjabatan_RT extends Model
{
    use HasFactory;
    protected $table = 'penjabatan_rt';

    protected $fillable = ['id_penjabatan', 'NIK_ketua_rt', 'tanggal_dilantik', 'tanggal_diberhentikan', 'id_rt']; 

    public function penduduk(){
        return $this->belongsTo(penduduk::class, 'NIK_ketua_rt')->withTimestamps();
    }

    public function rt(){
        return $this->belongsTo(RT::class, 'id_penjabatan')->withTimestamps();
    }
}

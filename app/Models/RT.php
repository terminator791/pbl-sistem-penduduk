<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    protected $table = 'tabel_rt';

    protected $fillable = ['nama_rt', 'id_penjabatan'];

    public function kos(){
        return $this->hasMany(kos::class, 'id_rt');
    }

    public function penduduk(){
        return $this->belongsToMany(penduduk::class, 'penjabatan_rt', 'id_rt', 'NIK_ketua_rt')->withTimestamps();
    }

    public function RW(){
        return $this->belongsTo(RW::class, 'id');
    }

    public function penjabatan_rt(){
        return $this->hasMany(penjabatan_RT::class, 'id_rt');
    }
}

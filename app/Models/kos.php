<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kos extends Model
{
    use HasFactory;
    protected $table = 'kos';

    protected $fillable = ['nama_kos', 'jumlah_penghuni'];


    public function rt()
    {
        return $this->belongsTo(RT::class, 'id');
    }

    public function penduduk(){
        return $this->belongsToMany(penduduk::class, 'detail_pendatang', 'id_kos', 'NIK');
    }

    public function detail_pendatang(){
        return $this->hasMany(detail_pendatang::class, 'id_kos' , 'id_kos');
    }
}

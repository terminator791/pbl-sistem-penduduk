<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pendatang extends Model
{
    use HasFactory;

    protected $table = 'detail_pendatang';

    protected $guarded = ['id'];

    public function penduduk(){
        return $this->belongsTo(penduduk::class, 'NIK')->withTimestamps();
    }

    public function kos(){
        return $this->belongsTo(kos::class, 'id_kos')->withTimestamps();
    }
}

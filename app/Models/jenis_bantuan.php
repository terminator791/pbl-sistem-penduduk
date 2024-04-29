<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_bantuan extends Model
{
    use HasFactory;

    protected $table = 'jenis_bantuan';

    protected $guarded = ['id'];

    public function penduduk(){
        return $this->belongsToMany(penduduk::class, 'bantuan', 'id_bantuan', 'NIK_penduduk');
    }

    public function bantuan(){
        return $this->hasMany(bantuan::class, 'id_bantuan', 'jenis_bantuan');
    }
}

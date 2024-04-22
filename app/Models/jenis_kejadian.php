<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_kejadian extends Model
{
    use HasFactory;

    protected $table = 'jenis_kejadian';

    protected $guarded = ['id'];

    public function penduduk(){
        return $this->belongsToMany(penduduk::class, 'kejadian', 'jenis_kejadian', 'NIK_penduduk');
    }

    public function kejadian(){
        return $this->hasMany(kejadian::class, 'jenis_kejadian');
    }

}

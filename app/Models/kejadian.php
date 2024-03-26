<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kejadian extends Model
{
    use HasFactory;

    protected $table = 'kejadian';

    protected $guarded = ['id'];

    public function penduduk(){
        return $this->belongsTo(penduduk::class, 'NIK_penduduk')->withTimestamps();
    }

    public function jenis_kejadian(){
        return $this->belongsTo(jenis_kejadian::class, 'jenis_kejadian')->withTimestamps();
    }
}

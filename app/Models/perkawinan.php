<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perkawinan extends Model
{
    use HasFactory;
    protected $table = 'perkawinan';

    protected $fillable = ['status_perkawinan'];

    public function penduduk(){
        return $this->hasMany(penduduk::class, 'id_status_perkawinan');
    }
}

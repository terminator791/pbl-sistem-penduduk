<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan';

    protected $fillable = ['jenis_pekerjaan'];

    public function penduduk(){
        return $this->hasMany(penduduk::class, 'id_pekerjaan');
}
}

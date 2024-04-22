<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendidikan extends Model
{
    use HasFactory;
    protected $table = 'pendidikan';

    protected $fillable = ['pendidikan'];

    public function penduduk(){
        return $this->hasMany(penduduk::class, 'id_pendidikan');
    }
}

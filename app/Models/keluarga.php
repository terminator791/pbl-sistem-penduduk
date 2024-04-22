<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keluarga extends Model
{
    use HasFactory;

    protected $table = 'keluarga';

    protected $fillable = ['status_keluarga'];

    public function penduduk(){
        return $this->hasMany(penduduk::class, 'id_keluarga');
    }
}

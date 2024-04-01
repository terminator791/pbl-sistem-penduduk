<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;

    protected $table = 'RW';

    protected $guarded = ['id'];

    public function penduduk(){
        return $this->hasMany(penduduk::class, 'id_rw')->withTimestamps();
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bantuan extends Model
{
    use HasFactory;

    protected $table = 'bantuan';

    protected $fillable = ['jenis_bantuan'];

    public function penduduk(){
        return $this->hasMany(penduduk::class, 'bantuan')->withTimestamps();
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 846622cf9b45603cfea8dc44a600897bc3b82107

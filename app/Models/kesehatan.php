<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kesehatan extends Model
{
    use HasFactory;

    protected $table = 'kesehatan';

    protected $guarded = ['id'];

    public function penduduk(){
        return $this->belongsTo(penduduk::class, 'NIK_penduduk', 'NIK');
    }

    public function jenis_penyakit(){
        return $this->belongsTo(jenis_penyakit::class, 'id_penyakit');
    }
}
<<<<<<< HEAD
//contoh gais yah
=======
>>>>>>> 846622cf9b45603cfea8dc44a600897bc3b82107

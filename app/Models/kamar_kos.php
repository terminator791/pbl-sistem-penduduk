<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kamar_kos extends Model
{
    use HasFactory;

    protected $table = 'kamar_kos';

    protected $guarded = ['id'];
}

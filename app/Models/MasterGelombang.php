<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGelombang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_gelombang',
        'nama_bulan',
        'status',
    ];
}

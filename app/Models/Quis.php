<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quis extends Model
{
    use HasFactory;

    protected $fillable = ['soal', 'status', 'waktu_mulai', 'waktu_selesai', 'tanggal_mulai'];
    protected $casts = [
        'soal' => 'array',
    ];

 
}

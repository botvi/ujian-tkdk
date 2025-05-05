<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_rektor',
        'nidn_rektor',
        'ttd_rektor',
        'nama_ketua_lppmdi',
        'nidn_ketua_lppmdi',
        'ttd_ketua_lppmdi',
    ];
}

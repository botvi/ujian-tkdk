<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'npm',
        'prodi',
        'fakultas',
        'semester',
        'no_wa',
        'user_id',
        'gelombang_id',
        'tahun_akademik_id',
        'status_akun'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gelombang()
    {
        return $this->belongsTo(MasterGelombang::class);
    }

    public function tahun_akademik()
    {
        return $this->belongsTo(MasterTahunAkademik::class);
    }
}

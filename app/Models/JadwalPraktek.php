<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktek extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'penguji_id', 
        'gelombang_id',
        'tahun_akademik_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penguji() 
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

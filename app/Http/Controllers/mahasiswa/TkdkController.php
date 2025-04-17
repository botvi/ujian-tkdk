<?php

namespace App\Http\Controllers\mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterGelombang;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Quis;


class TkdkController extends Controller
{
    public function index()
    {
        $quis = Quis::all()->first();  
        $soal = $quis->soal;     
        $waktu_mulai = $quis->waktu_mulai;
        $waktu_selesai = $quis->waktu_selesai;
        $tanggal_mulai = $quis->tanggal_mulai;
        return view('pageweb.tkdk.index', compact('soal', 'waktu_mulai', 'waktu_selesai', 'tanggal_mulai'));
    }

   
}

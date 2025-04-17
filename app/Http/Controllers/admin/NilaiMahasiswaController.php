<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterGelombang;
use App\Models\MasterTahunAkademik;
use App\Models\NilaiMahasiswa;
use RealRashid\SweetAlert\Facades\Alert;


class NilaiMahasiswaController extends Controller
{
 public function index(){
    $gelombang = MasterGelombang::where('status', 'aktif')->first();
    if (!$gelombang) {
        Alert::error('Gagal', 'Tidak ada gelombang yang aktif');
        return redirect()->back();
    }
    $tahunAkademik = MasterTahunAkademik::where('status', 'aktif')->first();
    if (!$tahunAkademik) {
        Alert::error('Gagal', 'Tidak ada tahun akademik yang aktif');
        return redirect()->back();
    }

    $nilaiMahasiswa = NilaiMahasiswa::with(['user.mahasiswa', 'gelombang', 'tahun_akademik'])
        ->where('gelombang_id', $gelombang->id)
        ->where('tahun_akademik_id', $tahunAkademik->id)
        ->get();
   
    return view('pageadmin.nilaiMahasiswa.index', compact('nilaiMahasiswa'));
 }
}

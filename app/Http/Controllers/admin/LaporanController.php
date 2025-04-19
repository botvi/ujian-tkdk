<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterTahunAkademik;
use App\Models\MasterGelombang;
use App\Models\Mahasiswa;
use App\Models\NilaiMahasiswa;
use RealRashid\SweetAlert\Facades\Alert;


class LaporanController extends Controller
{
   public function index()
   {
      return view('pageadmin.laporan.index');
   }
   public function laporanrekappendaftaran()
   {
      $gelombangAktif = MasterGelombang::where('status', 'aktif')->first();
      $tahunAktif = MasterTahunAkademik::where('status', 'aktif')->first();
      $mahasiswa = Mahasiswa::with(['user', 'gelombang', 'tahun_akademik'])
      ->where('gelombang_id', $gelombangAktif->id)
      ->where('tahun_akademik_id', $tahunAktif->id)
      ->orderBy('created_at', 'desc')
      ->get();
      return view('pageadmin.laporan.laporanrekappendaftaran', compact('mahasiswa', 'gelombangAktif', 'tahunAktif'));
   }

   public function laporanrekapnilai()
   {
      $gelombangAktif = MasterGelombang::where('status', 'aktif')->first();
      $tahunAktif = MasterTahunAkademik::where('status', 'aktif')->first();
      $nilaiMahasiswa = NilaiMahasiswa::with(['user.mahasiswa', 'gelombang', 'tahun_akademik'])
      ->where('gelombang_id', $gelombangAktif->id)
      ->where('tahun_akademik_id', $tahunAktif->id)
      ->orderBy('created_at', 'desc')
      ->get();
      return view('pageadmin.laporan.laporanrekapnilai', compact('nilaiMahasiswa', 'gelombangAktif', 'tahunAktif'));
   }
   
}

<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterTahunAkademik;
use App\Models\MasterGelombang;
use RealRashid\SweetAlert\Facades\Alert;


class DashboardController extends Controller
{
   public function index()
   {
      $tahunAkademik = MasterTahunAkademik::all();
      $gelombang = MasterGelombang::all();
      return view('pageadmin.dashboard.index', compact('tahunAkademik', 'gelombang'));
   }
   public function updateStatusTahunAkademik($id)
   {
      $masterTahunAkademik = MasterTahunAkademik::find($id);

      if ($masterTahunAkademik->status == 'aktif') {
         $masterTahunAkademik->status = 'nonaktif';
      } else {
         // Cek apakah ada data lain yang statusnya aktif
         $existingActive = MasterTahunAkademik::where('status', 'aktif')->first();
         if ($existingActive) {
            Alert::error('Gagal', 'Sudah ada tahun akademik yang aktif');
            return redirect()->route('admin.dashboard');
         }
         $masterTahunAkademik->status = 'aktif';
      }

      $masterTahunAkademik->save();
      Alert::success('Berhasil', 'Status berhasil diubah');
      return redirect()->route('admin.dashboard');
   }

   public function updateStatusGelombang($id)
   {
      $masterGelombang = MasterGelombang::find($id);

      if ($masterGelombang->status == 'aktif') {
         $masterGelombang->status = 'nonaktif';
      } else {
         // Cek apakah ada data lain yang statusnya aktif
         $existingActive = MasterGelombang::where('status', 'aktif')->first();
         if ($existingActive) {
            Alert::error('Gagal', 'Sudah ada gelombang yang aktif');
            return redirect()->route('admin.dashboard');
         }
         $masterGelombang->status = 'aktif';
      }

      $masterGelombang->save();
      Alert::success('Berhasil', 'Status berhasil diubah');
      return redirect()->route('admin.dashboard');
   }
}

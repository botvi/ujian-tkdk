<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MasterGelombang;
use App\Models\MasterTahunAkademik;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KonfirmasiRegistrasiController extends Controller
{
   public function index()
   {
    $gelombangAktif = MasterGelombang::where('status', 'aktif')->first();
    
    if (!$gelombangAktif) {
        Alert::warning('Peringatan', 'Tidak ada gelombang yang aktif saat ini');
        return view('pageadmin.konfirmasiRegistrasi.index', ['mahasiswa' => collect()]);
    }

    $tahunAktif = MasterTahunAkademik::where('status', 'aktif')->first();
    if (!$tahunAktif) {
        Alert::warning('Peringatan', 'Tidak ada tahun akademik yang aktif saat ini');
        return view('pageadmin.konfirmasiRegistrasi.index', ['mahasiswa' => collect()]);
    }

    $mahasiswa = Mahasiswa::where('gelombang_id', $gelombangAktif->id)
                ->where('tahun_akademik_id', $tahunAktif->id)
                ->orderBy('created_at', 'desc')
                ->get();
    return view('pageadmin.konfirmasiRegistrasi.index', compact('mahasiswa'));
   }


   public function updateStatus(Request $request, $id)
   {
    $mahasiswa = Mahasiswa::find($id);
    
    if($mahasiswa->status_akun == 'aktif') {
        $mahasiswa->status_akun = 'nonaktif';
    } else {
        $mahasiswa->status_akun = 'aktif';
    }

    $mahasiswa->save();
    Alert::success('Berhasil', 'Status akun berhasil diubah');
    return redirect()->route('admin.konfirmasiRegistrasi.index');
   }

   public function updateStatusAll(Request $request)
   {
    $mahasiswa = Mahasiswa::whereIn('id', $request->selected_ids)->get();
    foreach($mahasiswa as $m) {
        $m->status_akun = 'aktif';
        $m->save();
    }
    Alert::success('Berhasil', 'Status akun berhasil diubah');
    return redirect()->route('admin.konfirmasiRegistrasi.index');
   }
}
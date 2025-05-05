<?php

namespace App\Http\Controllers\mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterGelombang;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\NilaiMahasiswa;
use App\Models\MasterTahunAkademik;
use Illuminate\Support\Facades\Auth;
use App\Models\ManajemenReport;

class HasilNilaiMahasiswa extends Controller
{
    public function index()
    {
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
            ->where('user_id', Auth::id())
            ->first();
        return view('pageweb.hasilNilai.index', compact('nilaiMahasiswa'));
    }

    public function sertifikat()
    {
        $manajemenReport = ManajemenReport::first();
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
            ->where('user_id', Auth::id())
            ->first();
        return view('pageweb.hasilNilai.sertifikat', compact('nilaiMahasiswa', 'manajemenReport'));
    }
}

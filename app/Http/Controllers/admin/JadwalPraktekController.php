<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktek;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\MasterGelombang;
use App\Models\Penguji;
use App\Models\NilaiMahasiswa;
use App\Models\MasterTahunAkademik;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class JadwalPraktekController extends Controller
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

        $jadwalPraktek = JadwalPraktek::with('user.mahasiswa', 'penguji', 'gelombang')
            ->where('gelombang_id', $gelombang->id)
            ->where('tahun_akademik_id', $tahunAkademik->id)
            ->get();
        $nilaiMahasiswa = NilaiMahasiswa::where('gelombang_id', $gelombang->id)
            ->where('tahun_akademik_id', $tahunAkademik->id)
            ->get();
        
        return view('pageadmin.jadwalpraktek.index', compact('jadwalPraktek', 'nilaiMahasiswa'));
    }

    public function generateJadwal()
    {
        // Dapatkan gelombang aktif
        $gelombang = MasterGelombang::where('status', 'aktif')->first();
        if (!$gelombang) {
            Alert::error('Gagal', 'Tidak ada gelombang yang aktif');
            return redirect()->back();
        }

        // Dapatkan tahun akademik aktif
        $tahunAkademik = MasterTahunAkademik::where('status', 'aktif')->first();
        if (!$tahunAkademik) {
            Alert::error('Gagal', 'Tidak ada tahun akademik yang aktif');
            return redirect()->back();
        }

        // Dapatkan mahasiswa yang memiliki gelombang aktif dan belum memiliki jadwal
        $mahasiswas = User::where('role', 'mahasiswa')
            ->whereHas('mahasiswa', function($query) use ($gelombang, $tahunAkademik) {
                $query->where('gelombang_id', $gelombang->id)
                      ->where('tahun_akademik_id', $tahunAkademik->id);
            })
            ->whereDoesntHave('jadwalPraktek', function($query) use ($gelombang, $tahunAkademik) {
                $query->where('gelombang_id', $gelombang->id)
                      ->where('tahun_akademik_id', $tahunAkademik->id);
            })
            ->get();

        if ($mahasiswas->isEmpty()) {
            Alert::error('Gagal', 'Tidak ada mahasiswa yang perlu dijadwalkan di gelombang ini');
            return redirect()->back();
        }

        // Dapatkan semua penguji
        $pengujis = Penguji::all();
        
        if ($pengujis->isEmpty()) {
            Alert::error('Gagal', 'Tidak ada penguji yang tersedia');
            return redirect()->back();
        }

        // Hitung pembagian mahasiswa per penguji
        $jumlahMahasiswa = $mahasiswas->count();
        $jumlahPenguji = $pengujis->count();
        $mahasiswaPerPenguji = ceil($jumlahMahasiswa / $jumlahPenguji);

        // Bagi mahasiswa ke penguji
        $currentPengujiIndex = 0;
        foreach ($mahasiswas as $index => $mahasiswa) {
            if ($index > 0 && $index % $mahasiswaPerPenguji == 0) {
                $currentPengujiIndex++;
            }

            if ($currentPengujiIndex >= $jumlahPenguji) {
                $currentPengujiIndex = 0;
            }

            JadwalPraktek::create([
                'user_id' => $mahasiswa->id,
                'penguji_id' => $pengujis[$currentPengujiIndex]->user_id,
                'gelombang_id' => $gelombang->id,
                'tahun_akademik_id' => $tahunAkademik->id
            ]);
        }

        Alert::success('Berhasil', 'Jadwal praktek berhasil digenerate');
        return redirect()->route('admin.jadwalPraktek.index');
    }

    public function deleteAll()
    {
        $gelombang = MasterGelombang::where('status', 'aktif')->first();
        $tahunAkademik = MasterTahunAkademik::where('status', 'aktif')->first();
        JadwalPraktek::where('gelombang_id', $gelombang->id)
            ->where('tahun_akademik_id', $tahunAkademik->id)
            ->delete();
        Alert::success('Berhasil', 'Semua jadwal praktek berhasil dihapus');
        return redirect()->route('admin.jadwalPraktek.index');
    }
}

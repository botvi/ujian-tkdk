<?php

namespace App\Http\Controllers\mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterGelombang;
use App\Models\Mahasiswa;
    use Illuminate\Support\Facades\Auth;
    use RealRashid\SweetAlert\Facades\Alert;
    use App\Models\Quis;
    use App\Models\MasterTahunAkademik;

class LandingController extends Controller
{
    public function index()
    {
        $masterGelombang = MasterGelombang::where('status', 'aktif')->get();
        if ($masterGelombang->isEmpty()) {
            $masterGelombang = collect(); // Mengembalikan koleksi kosong jika tidak ada status aktif
        }
        $masterTahunAkademik = MasterTahunAkademik::where('status', 'aktif')->get();
        if ($masterTahunAkademik->isEmpty()) {
            $masterTahunAkademik = collect(); // Mengembalikan koleksi kosong jika tidak ada status aktif
        }
        $quis = Quis::all()->first();  
        $soal = $quis->soal;     
        $waktu_mulai = $quis->waktu_mulai;
        $waktu_selesai = $quis->waktu_selesai;
        $tanggal_mulai = $quis->tanggal_mulai;
        return view('pageweb.landingpage.index', compact('masterGelombang', 'masterTahunAkademik', 'soal', 'waktu_mulai', 'waktu_selesai', 'tanggal_mulai'));
    }

    public function updateGelombang()
    {
        // Ambil gelombang yang aktif saat ini
        $gelombangAktif = MasterGelombang::where('status', 'aktif')->first();
        $tahunAktif = MasterTahunAkademik::where('status', 'aktif')->first();
        if (!$gelombangAktif) {
            return redirect()->back()->with('error', 'Tidak ada gelombang yang aktif saat ini');
        }
        if (!$tahunAktif) {
            return redirect()->back()->with('error', 'Tidak ada tahun akademik yang aktif saat ini');
        }

        // Update gelombang_id mahasiswa dengan gelombang aktif
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $mahasiswa->gelombang_id = $gelombangAktif->id;
        $mahasiswa->tahun_akademik_id = $tahunAktif->id;
        $mahasiswa->save();

        Alert::success('Berhasil', 'Anda berhasil bergabung dengan gelombang ' . $gelombangAktif->nama_gelombang . ' dan tahun akademik ' . $tahunAktif->tahun_akademik);
        return redirect()->back();  
    }
}

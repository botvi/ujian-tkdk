<?php

namespace App\Http\Controllers\penguji;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktek;
use App\Models\MasterGelombang;
use App\Models\NilaiMahasiswa;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MasterTahunAkademik;

class DaftarMahasiswaPraktek extends Controller
{
    public function index()
    {
        // Cek gelombang aktif
        $gelombang = MasterGelombang::where('status', 'aktif')->first();
        if (!$gelombang) {
            Alert::error('Gagal', 'Tidak ada gelombang yang aktif saat ini');
            return redirect()->back();
        }
        $tahunAkademik = MasterTahunAkademik::where('status', 'aktif')->first();
        if (!$tahunAkademik) {
            Alert::error('Gagal', 'Tidak ada tahun akademik yang aktif');
            return redirect()->back();
        }

        // Ambil ID penguji yang login
        $pengujiId = Auth::user()->id;

        // Ambil data jadwal praktek sesuai gelombang dan penguji
        $jadwalPraktek = JadwalPraktek::with(['user.mahasiswa', 'penguji', 'gelombang', 'tahun_akademik'])
            ->where('gelombang_id', $gelombang->id)
            ->where('tahun_akademik_id', $tahunAkademik->id)
            ->where('penguji_id', $pengujiId)
            ->get();
            
        // Ambil nilai mahasiswa sesuai gelombang    
        $nilaiMahasiswa = NilaiMahasiswa::where('gelombang_id', $gelombang->id)
            ->where('tahun_akademik_id', $tahunAkademik->id)
            ->get();

        // Tampilkan view dengan data yang diperlukan
        return view('pagepenguji.daftarmahasiswapraktek.index', compact('jadwalPraktek', 'nilaiMahasiswa'));
    }

    public function inputNilai(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'gelombang_id' => 'required', 
            'tahun_akademik_id' => 'required',
            'nilai_praktek' => 'required|numeric|min:0|max:100',
        ]);
        $mahasiswa = User::where('id', $request->user_id)->first();
        $gelombang = MasterGelombang::where('status', 'aktif')->first();
        $tahunAkademik = MasterTahunAkademik::where('status', 'aktif')->first();        
        $nilaiMahasiswa = NilaiMahasiswa::where('user_id', $mahasiswa->id)
                         ->where('gelombang_id', $gelombang->id)
                         ->where('tahun_akademik_id', $tahunAkademik->id)
                         ->first();

        if (!$nilaiMahasiswa) {
            // Jika data belum ada, buat baru
            $nilaiMahasiswa = new NilaiMahasiswa();
            $nilaiMahasiswa->user_id = $mahasiswa->id;
            $nilaiMahasiswa->gelombang_id = $gelombang->id;
            $nilaiMahasiswa->tahun_akademik_id = $tahunAkademik->id;
        }

        // Generate nomor sertifikat
        $tahun = date('Y');
        $bulan = date('m');
        
        // Konversi bulan ke romawi
        $bulanRomawi = [
            '01' => 'I',
            '02' => 'II', 
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII'
        ];
        
        // Hitung urutan untuk tahun ini
        $urutanTahunIni = NilaiMahasiswa::whereYear('created_at', $tahun)
                         ->whereNotNull('nomor_sertifikat')
                         ->count() + 1;
        $nomorUrut = str_pad($urutanTahunIni, 3, '0', STR_PAD_LEFT); // Format menjadi 001, 002, dst
        
        $nilaiMahasiswa->nomor_sertifikat = $nomorUrut . '/LPPMDI-UNIKS/TK/' . $bulanRomawi[$bulan] . '/' . $tahun;
        $nilaiMahasiswa->nilai_praktek = $request->nilai_praktek;
        $nilaiMahasiswa->save();

        Alert::success('Berhasil', 'Nilai praktek berhasil disimpan');
        return redirect()->back();
    }
}

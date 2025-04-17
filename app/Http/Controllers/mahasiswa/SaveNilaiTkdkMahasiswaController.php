<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\NilaiMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quis;
use App\Models\Mahasiswa;
use App\Models\MasterGelombang;
use App\Models\MasterTahunAkademik;
use RealRashid\SweetAlert\Facades\Alert;



class SaveNilaiTkdkMahasiswaController extends Controller
{
    public function saveNilai(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $gelombang = MasterGelombang::where('status', 'aktif')->first();
        $tahunAkademik = MasterTahunAkademik::where('status', 'aktif')->first();

        // Cek apakah mahasiswa sudah pernah mengikuti ujian ini
        $nilaiExist = NilaiMahasiswa::where('user_id', $user->id)
                        ->where('gelombang_id', $gelombang->id)
                        ->where('tahun_akademik_id', $tahunAkademik->id)
                        ->first();

        if($nilaiExist) {
            Alert::warning('Peringatan', 'Anda sudah mengikuti ujian ini');
            return redirect()->route('landingpage');
        }

        $nilai = new NilaiMahasiswa();
        $nilai->user_id = $user->id;
        $nilai->gelombang_id = $gelombang->id;
        $nilai->tahun_akademik_id = $tahunAkademik->id;
        $nilai->nilai_tkdk = $request->nilai_tkdk;
        $nilai->save();

        Alert::success('Berhasil', 'Nilai berhasil disimpan, cek menu nilai');
        return redirect()->route('landingpage');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\MasterGelombang;
use App\Models\MasterTahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterUserController extends Controller
{
    public function index()
    {
        $masterGelombang = MasterGelombang::where('status', 'aktif')->get();
        $masterTahunAkademik = MasterTahunAkademik::where('status', 'aktif')->get();
        return view('auth.registeruser', compact('masterGelombang', 'masterTahunAkademik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'         => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users',
            'npm'          => 'required|string|max:255|unique:mahasiswas',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:6|confirmed',
            'prodi'        => 'required|string',
            'fakultas'     => 'required|string',
            'semester'     => 'required|string',
            'no_wa'        => 'required|string|max:20',
            'gelombang_id' => 'required',
            'tahun_akademik_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // Simpan ke tabel users
            $user = User::create([
                'nama'     => $request->nama,
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'mahasiswa', // default role
            ]);

            // Simpan ke tabel mahasiswa
            Mahasiswa::create([
                'nama'         => $request->nama,
                'npm'          => $request->npm, // bisa disesuaikan
                'prodi'        => $request->prodi,
                'fakultas'     => $request->fakultas,
                'semester'     => $request->semester,
                'no_wa'        => $request->no_wa,
                'gelombang_id' => $request->gelombang_id,
                'tahun_akademik_id' => $request->tahun_akademik_id,
                'user_id'      => $user->id,
            ]);

            DB::commit();

            Alert::success('Sukses', 'Pendaftaran berhasil! Silakan login.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Mahasiswa;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek role dan redirect sesuai role
            if ($user->role == 'admin') {
                Alert::success('Login Berhasil', 'Selamat datang kembali, Admin!');
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'mahasiswa') {
                $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

                if (!$mahasiswa) {
                    Auth::logout();
                    Alert::error('Login Gagal', 'Data mahasiswa tidak ditemukan');
                    return redirect('/login');
                }

                if ($mahasiswa->status_akun == 'nonaktif') {
                    Auth::logout();
                    Alert::error('Login Gagal', 'Akun anda belum diaktifkan. Silahkan hubungi admin.');
                    return redirect('/login');
                }

                Alert::success('Login Berhasil', 'Selamat datang kembali!');
                return redirect()->route('landingpage');
            } elseif ($user->role == 'penguji') {
                Alert::success('Login Berhasil', 'Selamat datang kembali, Penguji!');
                return redirect()->route('penguji.dashboard');
            } else {
                Auth::logout();
                Alert::error('Login Gagal', 'Anda tidak memiliki akses ke area ini.');
                return redirect('/login');
            }
        }

        // Authentication failed
        Alert::error('Login Gagal', 'Kredensial yang diberikan tidak cocok dengan data kami.');
        return back();
    }


    /**
     * Handle logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        Alert::info('Logged Out', 'Anda telah berhasil logout.');
        return redirect('/login');
    }
}

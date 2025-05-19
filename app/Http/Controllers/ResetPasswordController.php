<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;  
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.reset-password');
    }

    public function changePassword($token)
    {
        $resetData = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$resetData) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa!']);
        }

        return view('auth.change-password', [
            'token' => $token,
            'email' => $resetData->email
        ]);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Hapus token lama jika ada
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        $token = Str::random(64);
        $email = $request->email;

        // Simpan token baru ke database
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Kirim email
        Mail::to($email)->send(new ResetPasswordMail($token));

        return back()->with('status', 'Link reset password telah dikirim ke email Anda!');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetData) {
            return back()->withErrors(['email' => 'Token tidak valid!']);
        }

        // Update password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        // Hapus token
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect('/login')->with('status', 'Password berhasil direset!');
    }
} 
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;    
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class ProfilAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pageadmin.profiladmin.index', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'nullable|confirmed',
        ]);

        $user = User::find($id);
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        Alert::success('Berhasil', 'Profil berhasil diupdate');
        return redirect()->route('admin.profil.index');
    }
}

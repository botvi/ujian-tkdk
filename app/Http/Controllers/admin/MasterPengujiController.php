<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Penguji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MasterPengujiController extends Controller
{
    public function index()
    {
        $pengujis = Penguji::all();
        return view('pageadmin.masterpenguji.index', compact('pengujis'));
    }

    public function create()
    {
        return view('pageadmin.masterpenguji.create');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'no_wa' => 'required|max:20',
            'password' => 'required|string|max:255',
            'password_confirmation' => 'required|string|max:255',
        ]);


        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'penguji',
        ]);

        Penguji::create([
            'nama' => $request->nama,
            'no_wa' => $request->no_wa,
            'user_id' => $user->id,
        ]);

        Alert::success('Berhasil', 'Data berhasil ditambahkan');
        return redirect()->route('admin.masterPenguji.index');
    }

    public function edit($id)
    {
        $penguji = Penguji::find($id);
        $user = User::find($penguji->user_id);
        return view('pageadmin.masterpenguji.edit', compact('penguji', 'user'));
    }

    public function update(Request $request, $id)
    {
        $penguji = Penguji::find($id);
        $user = User::find($penguji->user_id);

        // Validasi dasar
        $validationRules = [
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'nama' => 'required|max:255',
            'no_wa' => 'required|max:20',
        ];

        // Tambah validasi password jika diisi
        if ($request->filled('password')) {
            $validationRules['password'] = 'required|string|max:255';
            $validationRules['password_confirmation'] = 'required|string|max:255|same:password';
        }

        $request->validate($validationRules);

        // Update data penguji
        $penguji->update([
            'nama' => $request->nama,
            'no_wa' => $request->no_wa
        ]);

        // Update data user
        $userData = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('admin.masterPenguji.index');
    }

    public function destroy($id)
    {
        $penguji = Penguji::find($id);
        $user = User::find($penguji->user_id);

        $penguji->delete();
        $user->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('admin.masterPenguji.index');
    }
}

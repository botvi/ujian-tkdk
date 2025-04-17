<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MasterGelombang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterGelombangController extends Controller
{
   public function index()
   {
    $masterGelombang = MasterGelombang::all();
    return view('pageadmin.masterGelombang.index', compact('masterGelombang'));
   }

   public function create()
   {
    return view('pageadmin.masterGelombang.create');
   }

   public function store(Request $request)
   {
    $request->validate([
        'nama_gelombang' => 'required',
        'nama_bulan' => 'required',
    ]);

    MasterGelombang::create($request->all());
    Alert::success('Berhasil', 'Data berhasil ditambahkan');
    return redirect()->route('admin.masterGelombang.index');
   }

    public function edit($id)
    {
        $masterGelombang = MasterGelombang::find($id);
    return view('pageadmin.masterGelombang.edit', compact('masterGelombang'));
   }

   public function update(Request $request, $id)
   {
    $request->validate([
        'nama_gelombang' => 'required',
        'nama_bulan' => 'required',
    ]);

    $masterGelombang = MasterGelombang::find($id);
    $masterGelombang->update($request->all());
    Alert::success('Berhasil', 'Data berhasil diubah');
    return redirect()->route('admin.masterGelombang.index');
   }  

   public function destroy($id)
   {
    $masterGelombang = MasterGelombang::find($id);
    $masterGelombang->delete();
    Alert::success('Berhasil', 'Data berhasil dihapus');
    return redirect()->route('admin.masterGelombang.index');
   }
   
   public function updateStatus(Request $request, $id)
   {
    $masterGelombang = MasterGelombang::find($id);
    
    if($masterGelombang->status == 'aktif') {
        $masterGelombang->status = 'nonaktif';
    } else {
        // Cek apakah ada data lain yang statusnya aktif
        $existingActive = MasterGelombang::where('status', 'aktif')->first();
        if($existingActive) {
            Alert::error('Gagal', 'Sudah ada gelombang yang aktif');
            return redirect()->route('admin.masterGelombang.index');
        }
        $masterGelombang->status = 'aktif';
    }

    $masterGelombang->save();
    Alert::success('Berhasil', 'Status berhasil diubah');
    return redirect()->route('admin.masterGelombang.index');
   }
}

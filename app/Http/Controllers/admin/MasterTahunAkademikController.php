<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTahunAkademik;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterTahunAkademikController extends Controller
{
   public function index()
   {
    $masterTahunAkademik = MasterTahunAkademik::all();
    return view('pageadmin.masterTahunAkademik.index', compact('masterTahunAkademik'));
   }

   public function create()
   {
    return view('pageadmin.masterTahunAkademik.create');
   }

   public function store(Request $request)
   {
    $request->validate([
        'tahun_akademik' => 'required',
    ]);

    MasterTahunAkademik::create($request->all());
    Alert::success('Berhasil', 'Data berhasil ditambahkan');
    return redirect()->route('admin.masterTahunAkademik.index');
   }

   

   public function edit($id)
    {
        $masterTahunAkademik = MasterTahunAkademik::find($id);
    return view('pageadmin.masterTahunAkademik.edit', compact('masterTahunAkademik'));
   }

   public function update(Request $request, $id)
   {
    $request->validate([
        'tahun_akademik' => 'required',
    ]);

    $masterTahunAkademik = MasterTahunAkademik::find($id);
    $masterTahunAkademik->update($request->all());
    Alert::success('Berhasil', 'Data berhasil diubah');
    return redirect()->route('admin.masterTahunAkademik.index');
   }  

   public function destroy($id)
   {
    $masterTahunAkademik = MasterTahunAkademik::find($id);
    $masterTahunAkademik->delete();
    Alert::success('Berhasil', 'Data berhasil dihapus');
    return redirect()->route('admin.masterTahunAkademik.index');
   }
   
   public function updateStatus(Request $request, $id)
   {
    $masterTahunAkademik = MasterTahunAkademik::find($id);
    
    if($masterTahunAkademik->status == 'aktif') {
        $masterTahunAkademik->status = 'nonaktif';
    } else {
        // Cek apakah ada data lain yang statusnya aktif
        $existingActive = MasterTahunAkademik::where('status', 'aktif')->first();
        if($existingActive) {
            Alert::error('Gagal', 'Sudah ada tahun akademik yang aktif');
            return redirect()->route('admin.masterTahunAkademik.index');
        }
        $masterTahunAkademik->status = 'aktif';
    }

    $masterTahunAkademik->save();
    Alert::success('Berhasil', 'Status berhasil diubah');
    return redirect()->route('admin.masterTahunAkademik.index');
   }
}

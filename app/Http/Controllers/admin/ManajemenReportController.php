<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ManajemenReport;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ManajemenReportController extends Controller
{
    public function createOrUpdate()
    {
        // Cari data yang sudah ada
        $report = ManajemenReport::first();
        if (!$report) {
            $report = new ManajemenReport();
        }
        
        return view('pageadmin.manajemen_report.index', compact('report'));
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'nama_rektor' => 'required',
            'nidn_rektor' => 'nullable',
            'ttd_rektor' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_ketua_lppmdi' => 'required',
            'nidn_ketua_lppmdi' => 'nullable',
            'ttd_ketua_lppmdi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cari data yang sudah ada
        $report = ManajemenReport::first();
        $data = $request->except(['ttd_rektor', 'ttd_ketua_lppmdi']);

        if ($request->hasFile('ttd_rektor')) {
            $ttdRektor = $request->file('ttd_rektor');
            $ttdRektorName = time() . '_' . $ttdRektor->getClientOriginalName();
            $ttdRektor->move(public_path('uploads/ttd'), $ttdRektorName);
            $data['ttd_rektor'] = 'uploads/ttd/' . $ttdRektorName;
        }

        if ($request->hasFile('ttd_ketua_lppmdi')) {
            $ttdKetua = $request->file('ttd_ketua_lppmdi');
            $ttdKetuaName = time() . '_' . $ttdKetua->getClientOriginalName();
            $ttdKetua->move(public_path('uploads/ttd'), $ttdKetuaName);
            $data['ttd_ketua_lppmdi'] = 'uploads/ttd/' . $ttdKetuaName;
        }

        if ($report) {
            // Update data yang sudah ada
            $report->update($data);
            Alert::success('Sukses', 'Data berhasil diupdate');
        } else {
            // Buat data baru
            ManajemenReport::create($data);
            Alert::success('Sukses', 'Data berhasil disimpan');
        }

        return redirect()->route('admin.manajemenReport.createOrUpdate');
    }
}

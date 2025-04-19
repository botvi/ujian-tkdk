<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\admin\{
    DashboardController,
    QuisController,
    MasterGelombangController,
    KonfirmasiRegistrasiController,
    MasterPengujiController,
    JadwalPraktekController,
    MasterTahunAkademikController,
    NilaiMahasiswaController,
    LaporanController
};
use App\Http\Controllers\penguji\{
    DaftarMahasiswaPraktek,
    DashboardPengujiController
};
use App\Http\Controllers\mahasiswa\{
    LandingController,
    TkdkController,
    SaveNilaiTkdkMahasiswaController,
    HasilNilaiMahasiswa
};
use App\Http\Controllers\{
    RegisterUserController,
    LoginController,
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/run-admin', function () {
    Artisan::call('db:seed', [
        '--class' => 'SuperAdminSeeder'
    ]);

    return "AdminSeeder has been create successfully!";
});

Route::get('/register', [RegisterUserController::class, 'index'])->name('registeruser.index');
Route::post('/register/store', [RegisterUserController::class, 'store'])->name('registeruser.store');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// ADMIN
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/quis', [QuisController::class, 'index'])->name('quis.index');
    Route::get('/quis/create', [QuisController::class, 'create'])->name('quis.create');
    Route::post('/quis/store', [QuisController::class, 'store'])->name('quis.store');
    Route::get('/quis/edit/{id}', [QuisController::class, 'edit'])->name('quis.edit');
    Route::put('/quis/update/{id}', [QuisController::class, 'update'])->name('quis.update');
    Route::delete('/quis/delete/{id}', [QuisController::class, 'destroy'])->name('quis.destroy');
    Route::get('/quis/view-soal/{id}', [QuisController::class, 'viewSoal'])->name('quis.viewSoal');
    Route::get('/quis/update-status/{id}', [QuisController::class, 'updateStatus'])->name('quis.updateStatus');
    
    Route::get('/master-gelombang', [MasterGelombangController::class, 'index'])->name('admin.masterGelombang.index');
    Route::get('/master-gelombang/create', [MasterGelombangController::class, 'create'])->name('admin.masterGelombang.create');
    Route::post('/master-gelombang/store', [MasterGelombangController::class, 'store'])->name('admin.masterGelombang.store');
    Route::get('/master-gelombang/edit/{id}', [MasterGelombangController::class, 'edit'])->name('admin.masterGelombang.edit');
    Route::put('/master-gelombang/update/{id}', [MasterGelombangController::class, 'update'])->name('admin.masterGelombang.update');
    Route::delete('/master-gelombang/delete/{id}', [MasterGelombangController::class, 'destroy'])->name('admin.masterGelombang.destroy');
    Route::get('/master-gelombang/update-status/{id}', [MasterGelombangController::class, 'updateStatus'])->name('admin.masterGelombang.updateStatus');

    Route::get('/master-tahun-akademik', [MasterTahunAkademikController::class, 'index'])->name('admin.masterTahunAkademik.index');
    Route::get('/master-tahun-akademik/create', [MasterTahunAkademikController::class, 'create'])->name('admin.masterTahunAkademik.create');
    Route::post('/master-tahun-akademik/store', [MasterTahunAkademikController::class, 'store'])->name('admin.masterTahunAkademik.store');
    Route::get('/master-tahun-akademik/edit/{id}', [MasterTahunAkademikController::class, 'edit'])->name('admin.masterTahunAkademik.edit');
    Route::put('/master-tahun-akademik/update/{id}', [MasterTahunAkademikController::class, 'update'])->name('admin.masterTahunAkademik.update');
    Route::delete('/master-tahun-akademik/delete/{id}', [MasterTahunAkademikController::class, 'destroy'])->name('admin.masterTahunAkademik.destroy');
    Route::get('/master-tahun-akademik/update-status/{id}', [MasterTahunAkademikController::class, 'updateStatus'])->name('admin.masterTahunAkademik.updateStatus');

    Route::get('/master-penguji', [MasterPengujiController::class, 'index'])->name('admin.masterPenguji.index');
    Route::get('/master-penguji/create', [MasterPengujiController::class, 'create'])->name('admin.masterPenguji.create');
    Route::post('/master-penguji/store', [MasterPengujiController::class, 'store'])->name('admin.masterPenguji.store');
    Route::get('/master-penguji/edit/{id}', [MasterPengujiController::class, 'edit'])->name('admin.masterPenguji.edit');
    Route::put('/master-penguji/update/{id}', [MasterPengujiController::class, 'update'])->name('admin.masterPenguji.update');
    Route::delete('/master-penguji/delete/{id}', [MasterPengujiController::class, 'destroy'])->name('admin.masterPenguji.destroy');

    Route::get('/konfirmasi-registrasi', [KonfirmasiRegistrasiController::class, 'index'])->name('admin.konfirmasiRegistrasi.index');
    Route::get('/konfirmasi-registrasi/update-status/{id}', [KonfirmasiRegistrasiController::class, 'updateStatus'])->name('admin.konfirmasiRegistrasi.updateStatus');

    Route::get('/jadwal-praktek', [JadwalPraktekController::class, 'index'])->name('admin.jadwalPraktek.index');
    Route::get('/jadwal-praktek/generate', [JadwalPraktekController::class, 'generateJadwal'])->name('admin.jadwalPraktek.generate');
    Route::get('/jadwal-praktek/delete-all', [JadwalPraktekController::class, 'deleteAll'])->name('admin.jadwalPraktek.deleteAll');

    Route::get('/nilai-mahasiswa', [NilaiMahasiswaController::class, 'index'])->name('admin.nilaiMahasiswa.index');

    Route::get('/update-status-tahun-akademik/{id}', [DashboardController::class, 'updateStatusTahunAkademik'])->name('admin.updateStatusTahunAkademik');
    Route::get('/update-status-gelombang/{id}', [DashboardController::class, 'updateStatusGelombang'])->name('admin.updateStatusGelombang');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/rekappendaftaran', [LaporanController::class, 'laporanrekappendaftaran'])->name('admin.laporan.rekappendaftaran');
    Route::get('/laporan/rekapnilai', [LaporanController::class, 'laporanrekapnilai'])->name('admin.laporan.rekapnilai');
});
// ADMIN


// PENGUJI
Route::group(['middleware' => ['role:penguji']], function () {
    Route::get('/penguji/dashboard', [DashboardPengujiController::class, 'index'])->name('penguji.dashboard');
    Route::get('/penguji/daftar-mahasiswa-praktek', [DaftarMahasiswaPraktek::class, 'index'])->name('penguji.daftarMahasiswaPraktek.index');
    Route::post('/penguji/input-nilai', [DaftarMahasiswaPraktek::class, 'inputNilai'])->name('penguji.daftarMahasiswaPraktek.inputNilai');
});
// PENGUJI




Route::get('/', [LandingController::class, 'index'])->name('landingpage');


Route::group(['middleware' => ['role:admin,mahasiswa,penguji']], function () {
    Route::get('/update-gelombang', [LandingController::class, 'updateGelombang'])->name('updateGelombang');
    Route::get('/tkdk', [TkdkController::class, 'index'])->name('tkdk.index');
    Route::post('/save-nilai-tkdk', [SaveNilaiTkdkMahasiswaController::class, 'saveNilai'])->name('saveNilaiTkdk');
    Route::get('/hasil-nilai', [HasilNilaiMahasiswa::class, 'index'])->name('hasilNilai.index');
    Route::get('/sertifikat', [HasilNilaiMahasiswa::class, 'sertifikat'])->name('hasilNilai.sertifikat');
});





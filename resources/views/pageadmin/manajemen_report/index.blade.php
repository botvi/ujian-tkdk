@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Forms</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manajemen Report</li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Manajemen Report</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--breadcrumb-->

        <div class="row">
            <div class="col-xl-7 mx-auto">
                <hr/>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bx-plus-circle me-1 font-22 text-primary"></i></div>
                            <h5 class="mb-0 text-primary">Tambah Manajemen Report</h5>
                        </div>
                        <hr>
                        <form action="{{ route('admin.manajemenReport.storeOrUpdate') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <span class="text-danger fw-bold">*</span>
                                <label for="nama_rektor" class="form-label">Nama Rektor</label>
                                <input type="text" class="form-control" id="nama_rektor" name="nama_rektor" value="{{ $report->nama_rektor ?? '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <span class="text-danger fw-bold">*optional</span>
                                <label for="nidn_rektor" class="form-label">NIDN Rektor</label>
                                <input type="text" class="form-control" id="nidn_rektor" name="nidn_rektor" value="{{ $report->nidn_rektor ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <span class="text-danger fw-bold">*optional</span>
                                <label for="ttd_rektor" class="form-label">TTD Rektor</label>
                                <input type="file" class="form-control" id="ttd_rektor" name="ttd_rektor" value="{{ $report->ttd_rektor ?? '' }}">
                                <span class="text-danger fw-bold">*foto saat ini: {{ $report->ttd_rektor ? basename($report->ttd_rektor) : 'Tidak ada foto' }}</span>
                            </div>
                            <div class="col-md-4">
                                <span class="text-danger fw-bold">*</span>
                                <label for="nama_ketua_lppmdi" class="form-label">Nama Ketua LPPMDI</label>
                                <input type="text" class="form-control" id="nama_ketua_lppmdi" name="nama_ketua_lppmdi" value="{{ $report->nama_ketua_lppmdi ?? '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <span class="text-danger fw-bold">*optional</span>
                                <label for="nidn_ketua_lppmdi" class="form-label">NIDN Ketua LPPMDI</label>
                                <input type="text" class="form-control" id="nidn_ketua_lppmdi" name="nidn_ketua_lppmdi" value="{{ $report->nidn_ketua_lppmdi ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <span class="text-danger fw-bold">*optional</span>
                                <label for="ttd_ketua_lppmdi" class="form-label">TTD Ketua LPPMDI</label>
                                <input type="file" class="form-control" id="ttd_ketua_lppmdi" name="ttd_ketua_lppmdi" value="{{ $report->ttd_ketua_lppmdi ?? '' }}">
                                <span class="text-danger fw-bold">*foto saat ini: {{ $report->ttd_ketua_lppmdi ? basename($report->ttd_ketua_lppmdi) : 'Tidak ada foto' }}</span>
                            </div>
                            

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
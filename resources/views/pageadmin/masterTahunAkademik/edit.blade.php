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
                        <li class="breadcrumb-item active" aria-current="page">Master Tahun Akademik</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Master Tahun Akademik</li>
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
                            <div><i class="bx bx-edit me-1 font-22 text-primary"></i></div>
                            <h5 class="mb-0 text-primary">Edit Master Tahun Akademik</h5>
                        </div>
                        <hr>
                        <form action="{{ route('admin.masterTahunAkademik.update', $masterTahunAkademik->id) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')
                          
                            <!-- kode anggaran -->
                            <div class="col-md-12">
                                <span class="text-danger fw-bold">*</span>
                                <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                                <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" value="{{ old('tahun_akademik', $masterTahunAkademik->tahun_akademik) }}" required>
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
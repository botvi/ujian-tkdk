@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Master Data</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.masterPenguji.index') }}">Master Penguji</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Master Penguji</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--breadcrumb-->

        <div class="row">
            <div class="col-xl-7 mx-auto">
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bx-plus-circle me-1 font-22 text-primary"></i></div>
                            <h5 class="mb-0 text-primary">Tambah Master Penguji</h5>
                        </div>
                        <hr>
                        <form action="{{ route('admin.masterPenguji.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-12">
                                <span class="text-danger fw-bold">*</span>
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                    id="nama" name="nama" value="{{ old('nama') }}" 
                                    placeholder="Masukkan nama lengkap" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <span class="text-danger fw-bold">*</span>
                                <label for="no_wa" class="form-label">No WhatsApp</label>
                                <input type="text" class="form-control @error('no_wa') is-invalid @enderror" 
                                    id="no_wa" name="no_wa" value="{{ old('no_wa') }}" 
                                    placeholder="Contoh: 08123456789" 
                                    pattern="[0-9]{10,13}"
                                    title="Masukkan nomor WhatsApp yang valid (10-13 digit)"
                                    required>
                                @error('no_wa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <span class="text-danger fw-bold">*</span>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" 
                                    placeholder="Contoh: nama@email.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <span class="text-danger fw-bold">*</span>
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                    id="username" name="username" value="{{ old('username') }}" 
                                    placeholder="Masukkan username" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <span class="text-danger fw-bold">*</span>
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" 
                                        id="password" name="password" 
                                        placeholder="Minimal 8 karakter" 
                                        minlength="8" required>
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <span class="text-danger fw-bold">*</span>
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group" id="show_hide_password_confirmation">
                                    <input type="password" class="form-control border-end-0" 
                                        id="password_confirmation" name="password_confirmation" 
                                        placeholder="Ulangi password" required>
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                </div>
                            </div>
                        
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-5">
                                        <i class="bx bx-save me-1"></i> Simpan
                                    </button>
                                    <a href="{{ route('admin.masterPenguji.index') }}" class="btn btn-secondary px-5">
                                        <i class="bx bx-arrow-back me-1"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!--app JS-->
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a, #show_hide_password_confirmation a").on('click', function(event) {
                event.preventDefault();
                let parentDiv = $(this).parent('div');
                if (parentDiv.find('input').attr("type") == "text") {
                    parentDiv.find('input').attr('type', 'password');
                    parentDiv.find('i').addClass("bx-hide");
                    parentDiv.find('i').removeClass("bx-show");
                } else if (parentDiv.find('input').attr("type") == "password") {
                    parentDiv.find('input').attr('type', 'text');
                    parentDiv.find('i').removeClass("bx-hide");
                    parentDiv.find('i').addClass("bx-show");
                }
            });
        });
    </script>
@endsection
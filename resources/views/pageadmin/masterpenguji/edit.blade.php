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
                        <li class="breadcrumb-item active" aria-current="page">Edit Master Penguji</li>
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
                            <h5 class="mb-0 text-primary">Edit Master Penguji</h5>
                        </div>
                        <hr>
                        <form action="{{ route('admin.masterPenguji.update', $penguji->id) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                    id="nama" name="nama" value="{{ old('nama', $penguji->nama) }}" 
                                    placeholder="Masukkan nama lengkap" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <label for="no_wa" class="form-label">No WhatsApp</label>
                                <input type="text" class="form-control @error('no_wa') is-invalid @enderror" 
                                    id="no_wa" name="no_wa" value="{{ old('no_wa', $penguji->no_wa) }}" 
                                    placeholder="Contoh: 08123456789" 
                                    pattern="[0-9]{10,13}"
                                    title="Masukkan nomor WhatsApp yang valid (10-13 digit)"
                                    required>
                                @error('no_wa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email', $user->email) }}" 
                                    placeholder="Contoh: nama@email.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                    id="username" name="username" value="{{ old('username', $user->username) }}" 
                                    placeholder="Masukkan username" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                        id="password" name="password" 
                                    placeholder="Minimal 6 karakter" 
                                    minlength="6">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" 
                                    id="password_confirmation" name="password_confirmation" 
                                    placeholder="Ulangi password">
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
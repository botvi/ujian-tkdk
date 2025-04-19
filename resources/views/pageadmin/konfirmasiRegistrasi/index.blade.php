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
                        <li class="breadcrumb-item active" aria-current="page">Konfirmasi Registrasi</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--breadcrumb-->
        <h6 class="mb-0 text-uppercase">Data Konfirmasi Registrasi</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>NPM</th>
                                <th>Prodi</th>
                                <th>Fakultas</th>
                                <th>Semester</th>
                                <th>Gelombang</th>
                                <th>Tahun Akademik</th>
                                <th>No. WA</th>
                                <th>Status</th>
                                <th>Aksi</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $index => $a)
                            <tr>
                                <td>{{ $a->nama }}</td>
                                <td>{{ $a->npm }}</td>
                                <td>{{ $a->prodi }}</td>
                                <td>{{ $a->fakultas }}</td>
                                <td>{{ $a->semester }}</td>
                                <td><span class="badge bg-primary">{{ $a->gelombang->nama_gelombang }}</span></td>
                                <td><span class="badge bg-primary">{{ $a->tahun_akademik->tahun_akademik }}</span></td>
                                <td>{{ $a->no_wa }}</td>
                                <td><span class="badge bg-{{ $a->status_akun == 'aktif' ? 'success' : 'danger' }}">{{ $a->status_akun }}</span></td>
                                <td>
                                   
                                    <a href="{{ route('admin.konfirmasiRegistrasi.updateStatus', $a->id) }}" class="btn btn-sm btn-success">
                                        @if($a->status_akun == 'aktif')
                                            Nonaktifkan
                                        @else
                                            Aktifkan
                                        @endif
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>NPM</th>
                                <th>Prodi</th>
                                <th>Fakultas</th>
                                <th>Semester</th>
                                <th>Gelombang</th>
                                <th>Tahun Akademik</th>
                                <th>No. WA</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
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
                            <li class="breadcrumb-item active" aria-current="page">Jadwal Praktek</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Data Jadwal Praktek</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.jadwalPraktek.generate') }}" class="btn btn-primary mb-3">Generate Jadwal</a>
                    <a href="{{ route('admin.jadwalPraktek.deleteAll') }}" class="btn btn-danger mb-3">Hapus Semua Jadwal</a>
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nilai TKDK</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Nama Penguji</th>
                                    <th>Gelombang</th>
                                    <th>Tahun Akademik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalPraktek as $index => $jadwal)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $nilaiMahasiswa->where('user_id', $jadwal->user_id)->first()->nilai_tkdk ?? '-' }}</td>
                                        <td>{{ $jadwal->user->mahasiswa->nama }}</td>
                                        <td>{{ $jadwal->user->mahasiswa->npm }}</td>
                                        <td>{{ $jadwal->user->mahasiswa->prodi }}</td>
                                        <td>{{ $jadwal->user->mahasiswa->fakultas }}</td>
                                        <td>{{ $jadwal->penguji->nama }}</td>
                                        <td>{{ $jadwal->gelombang->nama_gelombang }}</td>
                                        <td>{{ $jadwal->tahun_akademik->tahun_akademik }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nilai TKDK</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Nama Penguji</th>
                                    <th>Gelombang</th>
                                    <th>Tahun Akademik</th>
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
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
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



{{-- @if (isset($soal['gambar']))
    <img src="{{ asset('soal-gambar/' . $soal['gambar']) }}" alt="Gambar Soal" class="img-fluid">
@endif --}}

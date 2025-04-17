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
                            <li class="breadcrumb-item active" aria-current="page">Data Nilai Mahasiswa</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Data Nilai Mahasiswa</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nilai TKDK</th>
                                    <th>Nilai Praktek</th>
                                    <th>Total Nilai</th>
                                    <th>Prediket Kelulusan</th>
                                    <th>Keterangan</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Gelombang</th>
                                    <th>Tahun Akademik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilaiMahasiswa as $index => $nilai)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $nilai->nilai_tkdk ?? '-' }}</td>
                                        <td>{{ $nilai->nilai_praktek ?? '-' }}</td>
                                        <td><span class="badge bg-success">{{ round(($nilai->nilai_tkdk + $nilai->nilai_praktek + 2) / 2) ?? '-' }}</span></td>
                                        <td>
                                            @php
                                                $totalNilai = round(($nilai->nilai_tkdk + $nilai->nilai_praktek + 2) / 2);
                                            @endphp
                                            @if($totalNilai >= 80)
                                                <span class="badge bg-primary">Sangat Memuaskan</span>
                                            @elseif($totalNilai >= 70)
                                                <span class="badge bg-info">Memuaskan</span>
                                            @elseif($totalNilai >= 60)
                                                <span class="badge bg-success">Cukup Memuaskan</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Memuaskan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $totalNilai = round(($nilai->nilai_tkdk + $nilai->nilai_praktek + 2) / 2);
                                            @endphp
                                         
                                            @if($totalNilai >= 60)
                                                <span class="badge bg-success">Lulus</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Lulus</span>
                                            @endif
                                        </td>

                                        <td>{{ $nilai->user->mahasiswa->nama }}</td>
                                        <td>{{ $nilai->user->mahasiswa->npm }}</td>
                                        <td>{{ $nilai->user->mahasiswa->prodi }}</td>
                                        <td>{{ $nilai->user->mahasiswa->fakultas }}</td>
                                        <td>{{ $nilai->gelombang->nama_gelombang }}</td>
                                        <td>{{ $nilai->tahun_akademik->tahun_akademik }}</td>
                                        </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nilai TKDK</th>
                                    <th>Nilai Praktek</th>
                                    <th>Total Nilai</th>
                                    <th>Prediket</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
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

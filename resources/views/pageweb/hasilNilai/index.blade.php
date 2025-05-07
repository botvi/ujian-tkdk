@extends('template-web.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Hasil Ujian</h4>
                    @if($nilaiMahasiswa)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="30%">Nama Mahasiswa</th>
                                        <td>{{ $nilaiMahasiswa->user->mahasiswa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>NPM</th>
                                        <td>{{ $nilaiMahasiswa->user->mahasiswa->npm }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Akademik</th>
                                        <td>{{ $nilaiMahasiswa->tahun_akademik->tahun_akademik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gelombang</th>
                                        <td>{{ $nilaiMahasiswa->gelombang->nama_gelombang }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai TKDK</th>
                                        <td>{{ $nilaiMahasiswa->nilai_tkdk ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai Praktek</th>
                                        <td>{{ $nilaiMahasiswa->nilai_praktek ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai Akhir</th>
                                        <td>
                                            @if($nilaiMahasiswa->nilai_praktek != null)
                                                {{ round(($nilaiMahasiswa->nilai_tkdk + $nilaiMahasiswa->nilai_praktek + 2) / 2 -1) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    @if($nilaiMahasiswa->nilai_praktek != null)
                                    <tr>
                                        <th>Prediket Kelulusan</th>
                                        <td> @php
                                            $totalNilai = round(
                                                ($nilaiMahasiswa->nilai_tkdk + $nilaiMahasiswa->nilai_praktek + 2) / 2,
                                            );
                                        @endphp
                                            @if ($totalNilai >= 80)
                                                <span class="badge bg-primary">Sangat Memuaskan</span>
                                            @elseif($totalNilai >= 70)
                                                <span class="badge bg-info">Memuaskan</span>
                                            @elseif($totalNilai >= 60)
                                                <span class="badge bg-success">Cukup Memuaskan</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Memuaskan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>
                                            @php
                                                $totalNilai = round(
                                                    ($nilaiMahasiswa->nilai_tkdk + $nilaiMahasiswa->nilai_praktek + 2) / 2,
                                                );
                                            @endphp
                                            @if ($totalNilai >= 60)
                                                <span class="badge bg-success">Lulus</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Lulus</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Sertifikat</th>
                                        <td>
                                            @php
                                                $totalNilai = round(
                                                    ($nilaiMahasiswa->nilai_tkdk + $nilaiMahasiswa->nilai_praktek + 2) / 2,
                                                );
                                            @endphp
                                            @if($nilaiMahasiswa->nilai_praktek != null && $totalNilai >= 60)
                                                <a href="{{ route('hasilNilai.sertifikat') }}" class="btn btn-primary">Cetak
                                                    Sertifikat</a>
                                            @else
                                                <span class="badge bg-warning">Tidak ada sertifikat</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Anda belum mengikuti ujian
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

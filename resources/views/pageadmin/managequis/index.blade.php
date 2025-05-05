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
                            <li class="breadcrumb-item active" aria-current="page">Master Soal TKDK</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Data Master Soal TKDK</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    @if($quis->isEmpty())
                        <a href="{{ route('quis.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                    @endif
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Soal TKDK</th>
                                    <th>Status</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quis as $index => $ujian)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                       
                                        <td>
                                            <a href="{{ route('quis.viewSoal', $ujian->id) }}"
                                                class="btn btn-sm btn-info">Lihat Soal</a>
                                        </td>
                                        <td>
                                            @if($ujian->status == 'aktif')
                                                <span class="badge bg-success">Sedang Berlangsung</span>
                                            @else
                                                <span class="badge bg-danger">Belum dimulai</span>
                                            @endif
                                        </td>
                                        <td>{{ $ujian->tanggal_mulai }}</td>
                                        <td>{{ $ujian->waktu_mulai }}</td>  
                                        <td>{{ $ujian->waktu_selesai }}</td>
                                        <td>

                                            <a href="{{ route('quis.edit', $ujian->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('quis.destroy', $ujian->id) }}" method="POST"
                                                style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                            @if($ujian->status == 'nonaktif')
                                                <a href="{{ route('quis.updateStatus', $ujian->id) }}"
                                                    class="btn btn-sm btn-success">Mulai</a>
                                            @else
                                                <a href="{{ route('quis.updateStatus', $ujian->id) }}"
                                                    class="btn btn-sm btn-danger">Selesai</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Soal TKDK</th>
                                    <th>Status</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
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

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
                            <li class="breadcrumb-item active" aria-current="page">Daftar Mahasiswa Praktek</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Data Daftar Mahasiswa Praktek</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <!-- Form Pencarian -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari nama mahasiswa...">
                                <button class="btn btn-outline-secondary" type="button" id="searchButton">
                                    <i class="bx bx-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nilai TKDK</th>
                                    <th>Nilai Praktek</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Gelombang</th>
                                    <th>Tahun Akademik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalPraktek as $index => $jadwal)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $nilaiMahasiswa->where('user_id', $jadwal->user_id)->first()->nilai_tkdk ?? '-' }}</td>
                                        <td>{{ $nilaiMahasiswa->where('user_id', $jadwal->user_id)->first()->nilai_praktek ?? '-' }}</td>
                                        <td>{{ $jadwal->user->mahasiswa->nama }}</td>
                                        <td>{{ $jadwal->user->mahasiswa->npm }}</td>
                                        <td>{{ $jadwal->user->mahasiswa->prodi }}</td>
                                        <td>{{ $jadwal->user->mahasiswa->fakultas }}</td>
                                        <td>{{ $jadwal->gelombang->nama_gelombang }}</td>
                                        <td>{{ $jadwal->tahun_akademik->tahun_akademik }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputNilaiModal{{ $jadwal->user_id }}">
                                                Input Nilai
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Input Nilai -->
                                    <div class="modal fade" id="inputNilaiModal{{ $jadwal->user_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Input Nilai Praktek</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('penguji.daftarMahasiswaPraktek.inputNilai') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="user_id" value="{{ $jadwal->user_id }}">
                                                        <input type="hidden" name="gelombang_id" value="{{ $jadwal->gelombang_id }}">
                                                        <input type="hidden" name="tahun_akademik_id" value="{{ $jadwal->tahun_akademik_id }}">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Mahasiswa</label>
                                                            <input type="text" class="form-control" value="{{ $jadwal->user->mahasiswa->nama }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <span class="text-danger fw-bold">*</span>
                                                            <label class="form-label">Nilai Praktek</label>
                                                            <input type="number" class="form-control" name="nilai_praktek" min="0" max="100" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nilai TKDK</th>
                                    <th>Nilai Praktek</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Gelombang</th>
                                    <th>Tahun Akademik</th>
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
            // Fungsi pencarian
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const table = document.getElementById('example2');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            function filterTable() {
                const searchText = searchInput.value.toLowerCase();
                
                for (let i = 0; i < rows.length; i++) {
                    const namaCell = rows[i].getElementsByTagName('td')[2]; // Index 2 adalah kolom nama
                    if (namaCell) {
                        const nama = namaCell.textContent || namaCell.innerText;
                        if (nama.toLowerCase().indexOf(searchText) > -1) {
                            rows[i].style.display = '';
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }
                }
            }

            // Event listener untuk tombol pencarian
            searchButton.addEventListener('click', filterTable);

            // Event listener untuk input pencarian (pencarian real-time)
            searchInput.addEventListener('keyup', filterTable);

            // Kode SweetAlert yang sudah ada
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

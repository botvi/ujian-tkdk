@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
             <!--breadcrumb-->
             <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Laporan</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Laporan</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.laporan.rekappendaftaran') }}" target="_blank" class="btn btn-primary mb-3 me-3">Rekap Pendaftaran</a>
                    <a href="{{ route('admin.laporan.rekapnilai') }}" target="_blank" class="btn btn-primary mb-3">Rekap Nilai</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function updateStatusTahunAkademik(id) {
            window.location.href = `/update-status-tahun-akademik/${id}`;
        }

        function updateStatusGelombang(id) {
            window.location.href = `/update-status-gelombang/${id}`;
        }
    </script>
@endsection

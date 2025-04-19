@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            @if(!$tahunAkademik->where('status', 'aktif')->count() && !$gelombang->where('status', 'aktif')->count())
                <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-dark"><i class='bx bx-info-circle'></i></div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-dark">Wajib Diatur!</h6>
                            <div class="text-dark">Tahun Akademik dan Gelombang belum ada yang diaktifkan</div>
                        </div>
                    </div>
                </div>
            @elseif(!$tahunAkademik->where('status', 'aktif')->count())
                <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-dark"><i class='bx bx-info-circle'></i></div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-dark">Wajib Diatur!</h6>
                            <div class="text-dark">Tahun Akademik belum ada yang diaktifkan</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(!$gelombang->where('status', 'aktif')->count())
                <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-dark"><i class='bx bx-info-circle'></i></div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-dark">Wajib Diatur!</h6>
                            <div class="text-dark">Gelombang belum ada yang diaktifkan</div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 text-center mb-4">
                    <img src="{{ asset('env') }}/logo_text.png" width="250" alt="Logo SkripsiKU" class="img-fluid">
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card shadow bg-white">
                                <div class="card-body">
                                    <h5 class="card-title text-center mb-4">Tahun Akademik</h5>
                                    @foreach ($tahunAkademik as $item)
                                        <div
                                            class="form-check form-switch d-flex justify-content-center align-items-center mb-3">
                                            <input class="form-check-input me-2" type="checkbox"
                                                id="tahunAkademik{{ $item->id }}"
                                                onchange="updateStatusTahunAkademik({{ $item->id }})"
                                                {{ $item->status == 'aktif' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tahunAkademik{{ $item->id }}">
                                                {{ $item->tahun_akademik }}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow bg-white">
                                <div class="card-body">
                                    <h5 class="card-title text-center mb-4">Gelombang</h5>
                                    @foreach ($gelombang as $item)
                                        <div
                                            class="form-check form-switch d-flex justify-content-center align-items-center mb-3">
                                            <input class="form-check-input me-2" type="checkbox"
                                                id="gelombang{{ $item->id }}"
                                                onchange="updateStatusGelombang({{ $item->id }})"
                                                {{ $item->status == 'aktif' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gelombang{{ $item->id }}">
                                                {{ $item->nama_gelombang }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

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

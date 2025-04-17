@extends('template-web.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center mb-4">
                <img src="{{ asset('env') }}/logo_text.png" width="250" alt="Logo SkripsiKU" class="img-fluid">
                <p class="mt-3">
                    ReligiZone adalah aplikasi evaluasi keagamaan yang dirancang khusus untuk mahasiswa. Fitur utamanya
                    mencakup kuis pilihan ganda, tes lisan, dan penilaian praktik ibadah seperti salat dan hafalan ayat
                    pendek. Cocok digunakan oleh dosen dan penguji untuk mengukur pemahaman dan keterampilan keagamaan
                    mahasiswa secara menyeluruh.
                </p>
                <h1>
                    {{ strtoupper($masterGelombang[0]->nama_gelombang ?? 'Tidak Ada Ujian saat ini') }}
                </h1>
                <h3>
                   TAHUN AKADEMIK {{ strtoupper($masterTahunAkademik[0]->tahun_akademik ?? 'Tidak Ada Ujian saat ini') }}
                </h3>
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center mb-4">
            @if(Auth::check() && Auth::user()->role == 'mahasiswa')
                @php
                    $mahasiswa = App\Models\Mahasiswa::where('user_id', Auth::id())->first();
                    $gelombangAktif = App\Models\MasterGelombang::where('status', 'aktif')->first();
                    $tahunAktif = App\Models\MasterTahunAkademik::where('status', 'aktif')->first();
                @endphp

                @if($mahasiswa && ($gelombangAktif || $tahunAktif) && ($mahasiswa->gelombang_id != $gelombangAktif->id || $mahasiswa->tahun_akademik_id != $tahunAktif->id))
                    <div class="alert alert-warning" role="alert">
                        Perhatian! Anda terdaftar pada gelombang atau tahun akademik yang berbeda dengan yang aktif saat ini. Silakan <a href="{{ route('updateGelombang') }}">klik disini</a> untuk mengubah gelombang dan tahun akademik.
                    </div>
                @elseif($mahasiswa && $gelombangAktif && $mahasiswa->gelombang_id == $gelombangAktif->id && $mahasiswa->tahun_akademik_id == $tahunAktif->id)
                    @php
                        $quis = App\Models\Quis::where('status', 'aktif')->first();
                    @endphp
                    @if($quis)
                        <div class="alert alert-success" role="alert">
                            Anda terdaftar pada gelombang yang aktif saat ini. Silakan <a href="{{ route('tkdk.index') }}">klik disini</a> untuk memulai ujian.
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            Ujian TKDK belum dimulai. Ujian akan dimulai pada {{ \Carbon\Carbon::parse($tanggal_mulai)->isoFormat('dddd, D MMMM Y') }} pukul {{ $waktu_mulai }} s/d {{ $waktu_selesai }}.
                        </div>
                    @endif
                @endif
            @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center mb-4">
                @if(!Auth::check())
                    <a href="/login" class="btn btn-primary">Masuk</a>
                    @if(count($masterGelombang) > 0 && count($masterTahunAkademik) > 0)
                        <a href="/register" class="btn btn-secondary">Daftar {{ $masterGelombang[0]->nama_gelombang }}</a>
                    @else
                        <button class="btn btn-secondary" disabled>Pendaftaran Belum Dibuka</button>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

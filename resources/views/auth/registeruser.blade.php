<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('admin') }}/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('admin') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('admin') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet">
    <title>Pendaftaran TKDK</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center mt-3">
							<img src="{{ asset('env') }}/logo_text.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
                                    
                                    <div class="login-separater text-center mb-4"> <span>PENDAFTARAN TKDK</span>
                                        <hr />
                                    </div><div class="text-center">
										<p>Sudah punya akun? <a href="/login">Masuk Disini</a>
										</p>
									</div>
                                    <div class="form-body">
                                        <form action="{{ route('registeruser.store') }}" method="POST" class="row g-3">
                                            @csrf
                                            <div class="col-md-12">
                                                <select class="form-control" id="gelombang_id" name="gelombang_id" required readonly>
                                                    @foreach($masterGelombang as $gelombang)
                                                        <option value="{{ $gelombang->id }}">{{ strtoupper($gelombang->nama_gelombang) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <select class="form-control" id="tahun_akademik_id" name="tahun_akademik_id" required readonly>
                                                    @foreach($masterTahunAkademik as $tahun)
                                                        <option value="{{ $tahun->id }}">{{ strtoupper($tahun->tahun_akademik) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="no_wa" class="form-label">No WhatsApp</label>
                                                <input type="text" class="form-control" id="no_wa" name="no_wa" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="npm" class="form-label">NPM</label>
                                                <input type="text" class="form-control" id="npm" name="npm" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="fakultas" class="form-label">Fakultas</label>
                                                <select class="form-control" id="fakultas" name="fakultas" required>
                                                    <option value="">Pilih Fakultas</option>
                                                    <option value="FAKULTAS PERTANIAN">FAKULTAS PERTANIAN</option>
                                                    <option value="FAKULTAS TEKNIK">FAKULTAS TEKNIK</option>
                                                    <option value="FAKULTAS ILMU PENDIDIKAN DAN SAINS ISLAM">FAKULTAS ILMU PENDIDIKAN DAN SAINS ISLAM</option>
                                                    <option value="FAKULTAS ILMU SOSIAL">FAKULTAS ILMU SOSIAL</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="prodi" class="form-label">Program Studi</label>
                                                <select class="form-control" id="prodi" name="prodi" required>
                                                    <option value="">Pilih Program Studi</option>
                                                    <option value="AGROTEKNOLOGI">AGROTEKNOLOGI</option>
                                                    <option value="PETERNAKAN">PETERNAKAN</option>
                                                    <option value="AGRIBISNIS">AGRIBISNIS</option>
                                                    <option value="TEKNIK SIPIL">TEKNIK SIPIL</option>
                                                    <option value="PERENCANAAN WILAYAH DAN KOTA">PERENCANAAN WILAYAH DAN KOTA</option>
                                                    <option value="TEKNIK INFORMATIKA">TEKNIK INFORMATIKA</option>
                                                    <option value="PENDIDIKAN AGAMA ISLAM">PENDIDIKAN AGAMA ISLAM</option>
                                                    <option value="PENDIDIKAN KIMIA">PENDIDIKAN KIMIA</option>
                                                    <option value="PERBANKAN SYARIAH">PERBANKAN SYARIAH</option>
                                                    <option value="ADMINISTRASI NEGARA">ADMINISTRASI NEGARA</option>
                                                    <option value="AKUNTANSI">AKUNTANSI</option>
                                                    <option value="ILMU HUKUM">ILMU HUKUM</option>
                                                </select>
                                            </div>
                                            
                                           
                                            
                                            
                                            <!-- User Account Fields -->
                                            <div class="col-12">
                                                <hr>
                                                <h6 class="text-primary">Informasi Akun Pengguna</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                            </div>
                
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-outline-success px-5">MENDAFTAR</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->

    @include('sweetalert::alert')

    @yield('script')
    <!-- Bootstrap JS -->
    <script src="{{ asset('admin') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('admin') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#province_id').on('change', function() {
            var province_id = $(this).val();

            // Cek jika ada provinsi yang dipilih
            if (province_id) {
                $.ajax({
                    url: '/get-kabupaten/' + province_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#city_id').empty(); // Kosongkan select kabupaten
                        $('#city_id').append('<option value="">Pilih Kota</option>');
                        $.each(data, function(key, value) {
                            $('#city_id').append('<option value="' + value.city_id + '">' + value.city_name + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="">Pilih Kota</option>');
            }
        });
    });
</script>
</body>

</html>

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
                            <li class="breadcrumb-item active" aria-current="page">Profil Admin</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Profil Admin</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.profil.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama</h6>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" value="{{ $user->nama }}"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Username</h6>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" value="{{ $user->username }}"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Password</h6>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control" name="password">
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Konfirmasi Password</h6>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group" id="show_hide_password_confirm">
                                    <input type="password" class="form-control" name="password_confirmation">
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
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
            $("#show_hide_password a, #show_hide_password_confirm a").on('click', function(event) {
                event.preventDefault();
                var passwordInput = $(this).closest('.input-group').find('input');
                var icon = $(this).find('i');
                
                if (passwordInput.attr("type") == "text") {
                    passwordInput.attr('type', 'password');
                    icon.addClass("bx-hide");
                    icon.removeClass("bx-show");
                } else if (passwordInput.attr("type") == "password") {
                    passwordInput.attr('type', 'text');
                    icon.removeClass("bx-hide");
                    icon.addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

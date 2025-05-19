<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('env') }}/ecommerce.png" type="image/png" />
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
	<title>Login - TKDK</title>
	<style>
		.show_hide_password {
			position: relative;
		}
		.show_hide_password .toggle-password {
			position: absolute;
			right: 10px;
			top: 50%;
			transform: translateY(-50%);
			cursor: pointer;
			color: #6c757d;
		}
		.show_hide_password .toggle-password:hover {
			color: #0d6efd;
		}
	</style>
</head>

<body class="bg-login">
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Ganti Password</h4>
                        
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="show_hide_password">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                        id="password" name="password" value="{{ old('password') }}" required>
                                    <a href="javascript:;" class="toggle-password">
                                        <i class="bx bx-hide"></i>
                                    </a>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="show_hide_password">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                        id="password_confirmation" name="password_confirmation" required>
                                    <a href="javascript:;" class="toggle-password">
                                        <i class="bx bx-hide"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    Ganti Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end wrapper-->
	<!-- Bootstrap JS -->
    @include('sweetalert::alert')

	<script src="{{ asset('admin') }}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset('admin') }}/assets/js/jquery.min.js"></script>
	<script src="{{ asset('admin') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('admin') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$(".toggle-password").on('click', function (event) {
				event.preventDefault();
				var input = $(this).closest('.show_hide_password').find('input');
				var icon = $(this).find('i');
				
				if (input.attr("type") == "text") {
					input.attr('type', 'password');
					icon.addClass("bx-hide");
					icon.removeClass("bx-show");
				} else if (input.attr("type") == "password") {
					input.attr('type', 'text');
					icon.removeClass("bx-hide");
					icon.addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{ asset('admin') }}/assets/js/app.js"></script>
</body>

</html>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('web') }}/assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('web') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{ asset('web') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ asset('web') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset('web') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('web') }}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{ asset('web') }}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('web') }}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('web') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('web') }}/assets/css/app.css" rel="stylesheet">
	<link href="{{ asset('web') }}/assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('web') }}/assets/css/dark-theme.css" />
	<link rel="stylesheet" href="{{ asset('web') }}/assets/css/semi-dark.css" />
	<link rel="stylesheet" href="{{ asset('web') }}/assets/css/header-colors.css" />
	@yield('style')
	<title>ReligiZone</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
	 <!--start header wrapper-->	
	  <div class="header-wrapper">
		<!--start header -->
		@include('template-web.header')
		<!--end header -->
		<!--navigation-->
		@include('template-web.navbar')
		<!--end navigation-->
	   </div>
	   <!--end header wrapper-->
		<!--start page wrapper -->
		@yield('content')
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
            <?php
            // Dapatkan tahun sekarang menggunakan PHP
            $year = date('Y');
            ?>

            <p class="mb-0">Copyright © <?php echo $year; ?>. LPPMDI - Universitas Islam Kuantan Singing.</p>
        </footer>
	</div>
	<!--end wrapper-->
	
	<!-- Bootstrap JS -->
	@include('sweetalert::alert')

    @yield('script')

	<script src="{{ asset('web') }}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset('web') }}/assets/js/jquery.min.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/chartjs/js/Chart.extension.js"></script>
	<script src="{{ asset('web') }}/assets/js/index.js"></script>
	<!--app JS-->
	<script src="{{ asset('web') }}/assets/js/app.js"></script>
</body>

</html>
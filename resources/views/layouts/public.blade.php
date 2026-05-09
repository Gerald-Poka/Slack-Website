<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title', 'Slack Website')</title>

	<!-- Global stylesheets -->
	<link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('full-assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">

	<!-- Core JS files -->
	<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('full-assets/js/app.js') }}"></script>
</head>

<body class="bg-slate-50">

	<!-- Main navbar -->
	<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
		<div class="container">
			<div class="navbar-brand flex-1 flex-lg-0">
				<a href="{{ url('/') }}" class="d-inline-flex align-items-center">
					<span class="fs-4 fw-bold text-white text-uppercase ls-1">Slack Website</span>
				</a>
			</div>

			<ul class="nav flex-row justify-content-end order-1 order-lg-2">
				<li class="nav-item">
					@auth
						<a href="{{ route('dashboard') }}" class="btn btn-yellow btn-sm rounded-pill px-3">Dashboard</a>
					@else
						<a href="{{ route('login') }}" class="btn btn-outline-white btn-sm rounded-pill px-3">Login</a>
					@endauth
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content container mt-4">
                    @yield('content')
				</div>
				<!-- /content area -->

				<!-- Footer -->
				<footer class="footer container mt-auto py-3">
					<div class="text-center text-muted">
						&copy; {{ date('Y') }} Slack Website. All rights reserved.
					</div>
				</footer>
				<!-- /footer -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>

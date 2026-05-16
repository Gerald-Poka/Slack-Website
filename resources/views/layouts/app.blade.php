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
	<link href="{{ asset('assets/css/package.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

    <style>
        :root {
            --primary-color: {{ setting('primary_color', '#2196F3') }};
            --secondary-color: {{ setting('secondary_color', '#263238') }};
            --heading-font: '{{ setting('heading_font', 'Inter') }}', sans-serif;
            --body-font: '{{ setting('body_font', 'Inter') }}', sans-serif;
        }

        body {
            font-family: var(--body-font);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--heading-font);
        }

        .btn-primary, .bg-primary, .nav-sidebar .nav-item.active > .nav-link {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }
    </style>

	<!-- Core JS files -->
	<script src="{{ asset('assets/demo/demo_configurator.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('assets/js/vendor/visualization/d3/d3.min.js') }}"></script>
	<script src="{{ asset('assets/js/vendor/visualization/d3/d3_tooltip.js') }}"></script>

	<script src="{{ asset('full-assets/js/app.js') }}"></script>
	@stack('scripts')
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	@include('layouts.navbar')
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		@include('layouts.sidebar')
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Page header -->
				@include('layouts.page_header')
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
                    @yield('content')
				</div>
				<!-- /content area -->


				<!-- Footer -->
				@include('layouts.footer')
				<!-- /footer -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


	<!-- Notifications -->
    @include('layouts.notifications')
	<!-- /notifications -->

</body>
</html>

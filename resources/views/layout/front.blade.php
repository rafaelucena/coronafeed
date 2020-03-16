<!DOCTYPE html>
<html lang="en-US">
	<head>
		@include('front.nested.head')
	</head>

	<body>
		<!-- Preloader -->
		<div id="preloader">
			@include('front.nested.preloader')
		</div>

		<!-- mobile header -->
		<header class="mobile-header-1">
			@include('front.nested.mobile')
		</header>

		<!-- desktop header -->
		<header class="desktop-header-1 d-flex align-items-start flex-column">
			@include('front.nested.desktop')
		</header>

		<!-- main layout -->
		<main class="content">
			@yield('content')
		</main>

		<!-- Go to top button -->
		<a href="javascript:" id="return-to-top"><i class="fas fa-arrow-up"></i></a>

		<!-- SCRIPTS -->
		@include('front.nested.scripts')

	</body>
</html>
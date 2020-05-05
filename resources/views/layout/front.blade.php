<!DOCTYPE html>
<html lang="en-US">
	<head>
		@if (env('APP_ENV') === 'production')
		<meta name="google-site-verification" content="BltIJzn5oFpFIgrE5xKagoGVODsGq90YRc4bTRB9Fwc" />
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-4S6FGBPHVH"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-4S6FGBPHVH');
		</script>
		@endif
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
		<button id="show-footer" class="openbtn" onclick="openNav()"><i class="fas fa-shoe-prints"></i></button>
	<!--	<a href="#footer" id="show-footer"><i class="fas fa-shoe-prints"></i></a>-->
		<!-- SCRIPTS -->
		@include('front.nested.scripts')

	</body>
</html>
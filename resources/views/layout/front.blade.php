<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Bolby - Portfolio/CV/Resume HTML Template</title>
	<meta name="description" content="Bolby - Portfolio/CV/Resume HTML Template">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="https://via.placeholder.com/32x32">

	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('front/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('front/css/all.min.css') }}">
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('front/css/simple-line-icons.css') }}">
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('front/css/slick.css') }}">
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('front/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('front/css/magnific-popup.css') }}">
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('front/css/style.css') }}">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Preloader -->
<div id="preloader">
	<div class="outer">
		<!-- Google Chrome -->
		<div class="infinityChrome">
			<div></div>
			<div></div>
			<div></div>
		</div>

		<!-- Safari and others -->
		<div class="infinity">
			<div>
				<span></span>
			</div>
			<div>
				<span></span>
			</div>
			<div>
				<span></span>
			</div>
		</div>
		<!-- Stuff -->
		<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="goo-outer">
			<defs>
				<filter id="goo">
					<feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
					<feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
					<feBlend in="SourceGraphic" in2="goo" />
				</filter>
			</defs>
		</svg>
	</div>
</div>

<!-- mobile header -->
<header class="mobile-header-1">
	<div class="container">
		<!-- menu icon -->
		<div class="menu-icon d-inline-flex mr-4">
			<button>
				<span></span>
			</button>
		</div>
		<!-- logo image -->
		<div class="site-logo">
			<a href="index.html">
				<img src="{{ asset('front/images/logo.svg') }}" alt="Bolby" />
			</a>
		</div>
	</div>
</header>

<!-- desktop header -->
<header class="desktop-header-1 d-flex align-items-start flex-column">
	
	<!-- logo image -->
	<div class="site-logo">
		<a href="index.html">
			<img src="{{ asset('front/images/logo.svg') }}" alt="Bolby" />
		</a>
	</div>
	
	<!-- main menu -->
	<nav>
		<ul class="vertical-menu scrollspy">
			<li class="active"><a href="#home"><i class="icon-home"></i>Home</a></li>
			<li><a href="#about"><i class="icon-user-following"></i>About</a></li>
			<li><a href="#services"><i class="icon-briefcase"></i>Services</a></li>
			<li><a href="#experience"><i class="icon-graduation"></i>Experience</a></li>
			<li><a href="#works"><i class="icon-layers"></i>Works</a></li>
			<li><a href="#blog"><i class="icon-note"></i>Blog</a></li>
			<li><a href="#contact"><i class="icon-bubbles"></i>Contact</a></li>
		</ul>
	</nav>
	
	<!-- site footer -->
	<div class="footer">
		<!-- copyright text -->
		<span class="copyright">© 2020 Bolby Template.</span>
	</div>

</header>

<!-- main layout -->
<main class="content">
	@yield('content')
</main>

<!-- Go to top button -->
<a href="javascript:" id="return-to-top"><i class="fas fa-arrow-up"></i></a>

<!-- SCRIPTS -->

<script type="text/javascript" src="{{ asset('front/js/jquery-1.12.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.easing.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.counterup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/isotope.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/infinite-scroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/contact.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/validator.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/morphext.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/parallax.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/custom.js') }}"></script>

</body>
</html>
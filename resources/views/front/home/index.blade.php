@extends('layout.front')

@section('content')
    <!-- section home -->
	<section id="home" class="home d-flex align-items-center">
        @include('front.home.sections.home')
	</section>

	<!-- section about -->
	<section id="about">
		@include('front.home.sections.about')
	</section>

	<!-- section world map -->
	<section id="map-world">
		@include('front.home.sections.map-world')
	</section>

	<!-- section charts -->
	<section id="charts">
		@include('front.home.sections.charts')
	</section>

	<!-- section footer -->
	<section id="footer">
		@include('front.home.sections.footer')
	</section>
@endsection
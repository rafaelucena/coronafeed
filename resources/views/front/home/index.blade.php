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

	<!-- section charts -->
	<section id="charts">
		@include('front.home.sections.charts')
	</section>

	<!-- section testimonials -->
	<section id="testimonials">
        @include('front.home.sections.testimonials')
	</section>
@endsection
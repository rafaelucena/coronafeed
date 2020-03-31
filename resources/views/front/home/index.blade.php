@extends('layout.front')

@section('content')
    <!-- section home -->
	<section id="home" class="home d-flex align-items-center">
        @include('front.home.sections.home')
	</section>

	<!-- section world map -->
	<section id="map-world">
        @include('front.home.sections.map-world')
	</section>

	<!-- section brazil map -->
	<section id="map">
        @include('front.home.sections.map')
	</section>

	<!-- section about -->
	<section id="about">
		@include('front.home.sections.about')
	</section>

	<!-- section contact -->
	<section id="contact">
        @include('front.home.sections.contact')
	</section>
	
	<div class="spacer" data-height="96"></div>
@endsection
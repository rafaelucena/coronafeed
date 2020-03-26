@extends('layout.front')

@section('content')
    <!-- section home -->
	<section id="home" class="home d-flex align-items-center">
        @include('front.home.sections.home')
	</section>

	<!-- section map -->
	<section id="map">
        @include('front.home.sections.map')
	</section>

	<!-- section about -->
	<section id="about">
		@include('front.home.sections.about')
	</section>

	<!-- section services -->
	<section id="services">
        @include('front.home.sections.services')
	</section>

	<!-- section graph -->
	<section id="graph">
        @include('front.home.sections.graph')
	</section>

	<!-- section experience -->
	<section id="experience">
        @include('front.home.sections.experience')
	</section>

	
	<!-- section works -->
	<section id="works">
        @include('front.home.sections.works')
	</section>

	<!-- section prices -->
	<section id="prices">
        <!-- include('front.home.sections.prices') -->
	</section>

	<!-- section testimonials -->
	<section id="testimonials">
        <!-- include('front.home.sections.testimonials') -->
	</section>

	<!-- section blog -->
	<section id="blog">
        @include('front.home.sections.blog')
	</section>

	<!-- section contact -->
	<section id="contact">
        @include('front.home.sections.contact')
	</section>

	<div class="spacer" data-height="96"></div>
@endsection
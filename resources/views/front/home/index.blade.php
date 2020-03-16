@extends('layout.front')

@section('content')
    <!-- section home -->
	<section id="home" class="home d-flex align-items-center">
        @include('front.home.includes.home')
	</section>

	<!-- section about -->
	<section id="about">
		@include('front.home.includes.about')
	</section>

	<!-- section services -->
	<section id="services">
        @include('front.home.includes.services')
	</section>

	<!-- section experience -->
	<section id="experience">
        @include('front.home.includes.experience')
	</section>

	<!-- section works -->
	<section id="works">
        @include('front.home.includes.works')
	</section>

	<!-- section prices -->
	<section id="prices">
        @include('front.home.includes.prices')
	</section>

	<!-- section testimonials -->
	<section id="testimonials">
        @include('front.home.includes.testimonials')
	</section>

	<!-- section blog -->
	<section id="blog">
        @include('front.home.includes.blog')
	</section>

	<!-- section contact -->
	<section id="contact">
        @include('front.home.includes.contact')
	</section>

	<div class="spacer" data-height="96"></div>
@endsection
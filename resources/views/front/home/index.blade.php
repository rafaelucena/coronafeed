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

	
	
	<div class="spacer" data-height="96"></div>
@endsection
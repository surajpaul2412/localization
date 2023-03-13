@extends('layouts.frontend.app')
@section('title')
<title>{{$page->meta_title}} | GoGetGuide</title>
<meta name="keywords" content="{{$page->meta_keyword}}">
<meta name="description" content="{{$page->meta_desc}}">
@endsection

@section('content') 

<main>
	<div class="hero_in cart_section" style="background: #0054a6 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12"><h1 class="my-4 animated"> <span></span>	{{$page->meta_title}}</h1></div>
				</div>
				<!-- End bs-wizard -->
			</div>
		</div>
	</div>
	<!--/hero_in-->

    <section class="section page-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Start: About Section -->        
                    {!! $page->description !!}
                    <!-- End: About Section -->
				</div> 
			</div>
		</div>
	</section> 

</main> 
@endsection
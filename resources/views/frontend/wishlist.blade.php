@extends('layouts.frontend.app')
@section('title')
<title>Success | GetBeds</title>
<meta name="keywords" content="">
<meta name="description" content="">
@endsection

@section('content') 

<main>
	<div class="hero_in cart_section" style="background: #0054a6 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12"><h1 class="my-4 animated"> <span></span>	Wishlist</h1></div>
				</div>
				<!-- End bs-wizard -->
			</div>
		</div>
	</div>
	<!--/hero_in-->

	<div class="section-sm wishlist-area">
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-6">
					<div class="box_cart wishlist">
						<div class="box_list">
							<div class="row g-0">
								<div class="col-lg-5">
									<figure> 
										<a href="#"><img src="{{asset('images/destination/2.jpg')}}" class="img-fluid" /></a>
									</figure>
								</div>
								<div class="col-lg-7">
									<div class="wrapper"> 
										<p><b><a href="#" class="fs-6">Singapore: S.E.A. Aquarium Entrance Ticket</a></b></p>
										<!-- <p>S.E.A. Aquarium Standard Admission (GT QR Code)</p>  -->
										<div class="d-flex align-items-center">
											<div class="rating">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fa fa-star-half"></i>
												<i class="far fa-star"></i>
											</div> 
											<a href="#">(56)</a>   
										</div> 
										<span class="price">From <strong>$54</strong> /per person</span>
									</div>
									<ul>
										<li><a href="#">Remove</a></li>
										<li><a href="#">Move to Cart</a></li>
									</ul>
								</div>
							</div>
						</div>  
					</div>
				</div>
				<!-- /col -->  
				
				<div class="col-lg-6">
					<div class="box_cart wishlist">
						<div class="box_list">
							<div class="row g-0">
								<div class="col-lg-5">
									<figure> 
										<a href="#"><img src="{{asset('images/destination/2.jpg')}}" class="img-fluid" /></a>
									</figure>
								</div>
								<div class="col-lg-7">
									<div class="wrapper"> 
										<p><b><a href="#" class="fs-6">Singapore: S.E.A. Aquarium Entrance Ticket</a></b></p>
										<!-- <p>S.E.A. Aquarium Standard Admission (GT QR Code)</p>  -->
										<div class="d-flex align-items-center">
											<div class="rating">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fa fa-star-half"></i>
												<i class="far fa-star"></i>
											</div> 
											<a href="#">(56)</a>   
										</div> 
										<span class="price">From <strong>$54</strong> /per person</span>
									</div>
									<ul>
										<li><a href="#">Remove</a></li>
										<li><a href="#">Move to Cart</a></li>
									</ul>
								</div>
							</div>
						</div>  
					</div>
				</div>
				<!-- /col -->  
				
				<div class="col-lg-6">
					<div class="box_cart wishlist">
						<div class="box_list">
							<div class="row g-0">
								<div class="col-lg-5">
									<figure> 
										<a href="#"><img src="{{asset('images/destination/2.jpg')}}" class="img-fluid" /></a>
									</figure>
								</div>
								<div class="col-lg-7">
									<div class="wrapper"> 
										<p><b><a href="#" class="fs-6">Singapore: S.E.A. Aquarium Entrance Ticket</a></b></p>
										<!-- <p>S.E.A. Aquarium Standard Admission (GT QR Code)</p>  -->
										<div class="d-flex align-items-center">
											<div class="rating">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fa fa-star-half"></i>
												<i class="far fa-star"></i>
											</div> 
											<a href="#">(56)</a>   
										</div> 
										<span class="price">From <strong>$54</strong> /per person</span>
									</div>
									<ul>
										<li><a href="#">Remove</a></li>
										<li><a href="#">Move to Cart</a></li>
									</ul>
								</div>
							</div>
						</div>  
					</div>
				</div>
				<!-- /col -->  
				
				<div class="col-lg-6">
					<div class="box_cart wishlist">
						<div class="box_list">
							<div class="row g-0">
								<div class="col-lg-5">
									<figure> 
										<a href="#"><img src="{{asset('images/destination/2.jpg')}}" class="img-fluid" /></a>
									</figure>
								</div>
								<div class="col-lg-7">
									<div class="wrapper"> 
										<p><b><a href="#" class="fs-6">Singapore: S.E.A. Aquarium Entrance Ticket</a></b></p>
										<!-- <p>S.E.A. Aquarium Standard Admission (GT QR Code)</p>  -->
										<div class="d-flex align-items-center">
											<div class="rating">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fa fa-star-half"></i>
												<i class="far fa-star"></i>
											</div> 
											<a href="#">(56)</a>   
										</div> 
										<span class="price">From <strong>$54</strong> /per person</span>
									</div>
									<ul>
										<li><a href="#">Remove</a></li>
										<li><a href="#">Move to Cart</a></li>
									</ul>
								</div>
							</div>
						</div>  
					</div>
				</div>
				<!-- /col -->  
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /bg_color_1 --> 
	
	@include('layouts.frontend.partials.ads') 
</main>

@endsection
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

	@include('layouts.backend.partials.alert')
	
	<section class="section dashboard-detail">
		<div class="container-fluid">
			<div class="row justify-content-center justify-content-between">
				<div class="col-lg-3 text-center d-none d-lg-block">
					@include('layouts.frontend.partials.customerSidebar')
				</div>

				<div class="col-lg-9">
					<form action="#">
						<div class="row align-items-center"> 

							<div class="col-sm-12">
								<h3 class="mb-0">My Wishlist</h3>
								<hr class="mt-1">
							</div>  
							
						</div>
						<div class="row">
							@if($userWishlistItems)
							@foreach($userWishlistItems as $row)
								<div class="col-lg-6">
									<div class="box_cart wishlist">
										<div class="box_list">
											<div class="row g-0">
												<div class="col-lg-5">
													<figure> 
														<a href="#"><img src="{{asset($row['package']['avatar'])}}" class="img-fluid" /></a>
													</figure>
												</div>
												<div class="col-lg-7">
													<div class="wrapper"> 
														<p><b><a href="{{route('tour.show',$row['package']['slug'])}}" class="fs-6">{{$row['package']['name']}}</a></b></p>
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
														<span class="price">Price: <strong>₹{{$row['package']['adult_price']}}</strong> /per person</span>
													</div>
													<ul>
														<li><a href="{{route('wishlist.remove',$row['id'])}}">Remove</a></li>
														<li><a href="{{route('wishlist.moveToCart',$row['id'])}}">Move to Cart</a></li>
													</ul>
												</div>
											</div>
										</div>  
									</div>
								</div>
							@endforeach
						@else
							<div>No items in your wishlist.</div>
						@endif
						</div>  
						<!-- [ row ] end -->
					</form>
				</div>
			</div>
		</div>
	</section>

	@include('layouts.frontend.partials.ads') 
</main>

@endsection
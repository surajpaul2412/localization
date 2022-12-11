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
					<div class="col-lg-12"><h1 class="my-4 animated"> <span></span>	{{dynamicLang('Wishlist')}}</h1></div>
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
						<div class="card border">
							<div class="card-header">
								<h4 class="mb-0">{{dynamicLang('My Wishlist')}}</h4>
							</div>
							<div class="card-body">
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
																<p><b><a href="{{route('tour.show',$row['package']['slug'])}}" class="fs-6">{{dynamicLang($row['package']['name'])}}</a></b></p>
																<!-- <div class="d-flex align-items-center">
																	<div class="rating">
																		<i class="fas fa-star"></i>
																		<i class="fas fa-star"></i>
																		<i class="fas fa-star"></i>
																		<i class="fa fa-star-half"></i>
																		<i class="far fa-star"></i>
																	</div> 
																	<a href="#">(56)</a>   
																</div>  -->
																<span class="price">{{dynamicLang('Price')}}: <strong>{{Session::get('currency_symbol')??'₹'}} {{switchCurrency($row['package']['adult_price'])}}</strong> /{{dynamicLang('per person')}}</span>
															</div>
															<ul>
																<li><a class="text-danger" href="{{route('wishlist.remove',$row['id'])}}">{{dynamicLang('Remove')}}</a></li>
																<li><a href="{{route('wishlist.moveToCart',$row['id'])}}">{{dynamicLang('Move to Cart')}}</a></li>
															</ul>
														</div>
													</div>
												</div>  
											</div>
										</div>
									@endforeach
								@else
									<div>{{dynamicLang('No items in your wishlist')}}.</div>
								@endif
								</div>  
								<!-- [ row ] end -->
							</div>
							<div class="card-footer"></div>
						</div>  
					</form>
				</div>
			</div>
		</div>
	</section>

	@include('layouts.frontend.partials.ads') 
</main>

@endsection
@extends('layouts.frontend.app')
@section('title')
<title>Cart | GetBeds</title>
@endsection

@section('content') 
<main>
	<div class="hero_in cart_section" style="background: #0295a9 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
		<div class="wrapper">
			<div class="container">
				<div class="bs-wizard clearfix">
					<div class="bs-wizard-step active">
						<div class="text-center bs-wizard-stepnum">Your cart</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="{{route('cart')}}" class="bs-wizard-dot"></a>
					</div>

					<div class="bs-wizard-step disabled">
						<div class="text-center bs-wizard-stepnum">Payment</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="#0" class="bs-wizard-dot"></a>
					</div>

					<div class="bs-wizard-step disabled">
						<div class="text-center bs-wizard-stepnum">Finish!</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="#0" class="bs-wizard-dot"></a>
					</div>
				</div>
				<!-- End bs-wizard -->
			</div>
		</div>
	</div>
	<!--/hero_in-->

	<div class="bg_color_1">
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-8">
					@if($cartItems->count())
						@foreach($cartItems as $item)
						<div class="box_cart">
							<div class="box_list">
								<div class="row g-0">
									<div class="col-lg-5">
										<figure> 
											<a href="#"><img src="{{asset($item->package->avatar)}}" class="img-fluid" /></a>
										</figure>
									</div>
									<div class="col-lg-7">
										<div class="wrapper"> 
											<h3><a href="{{route('tour.show',$item->package->id)}}">{{$item->package->name}}</a></h3>
											<div class="d-flex align-items-center pb-3">
												<div class="rating">
													<i class="fas fa-star"></i>
													<i class="fas fa-star"></i>
													<i class="fas fa-star"></i>
													<i class="fa fa-star-half"></i>
													<i class="far fa-star"></i>
												</div> 
												<a href="#">(56)</a>   
											</div> 
											<div class="price">Date selected: <strong>{{$item->date??'Not Selected'}}</strong></div><br/>
											<div class="price">Adult: <strong>₹ {{$item->package->adult_price}} x {{$item->qty_adult??'Not Selected'}}</strong></div><br/>
											<div class="price">Child: <strong>₹ {{$item->package->child_price}} x {{$item->qty_child??'Not Selected'}}</strong></div><br/>
											<div class="price">Infant: <strong>₹ {{$item->package->infant_price}} x {{$item->qty_infant??'Not Selected'}}</strong></div>
										</div>
										<ul>
											<li><a class="text-info" href="{{route('cart.edit',$item->id)}}">Edit cart item</a></li>
											<li><a class="text-danger" href="{{route('cart.remove',$item->id)}}">Remove</a></li>
											<li><a href="{{route('cart.moveToWishlist',$item->id)}}">Move to Wishlist</a></li>
										</ul>
									</div>
								</div>
							</div>  
						</div>
						@endforeach
					@else
					<div>No items in your cart.</div>
					@endif
				</div>
				<!-- /col --> 

				<aside class="col-lg-4">
					<div class="box_detail">
						<div id="total_cart">
							Total <span class="float-end">₹ {{$cartAmount}}.00</span>
						</div>
						<ul class="cart_details">
							<!-- <li>From <span>02-11-18</span></li> -->
							<!-- <li>To <span>04-11-18</span></li> -->
							<!-- <li>Adults <span>2</span></li> -->
							<!-- <li>Childs <span>1</span></li> -->
						</ul>
						<button href="" class="btn w-100 btn-success" 
							@foreach($cartItems as $cart)
								@if($cart->date == null) disabled @endif
							@endforeach
						>
						Checkout</button>
						<div class="text-center"><small>No money charged in this step</small></div>
					</div>
				</aside>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /bg_color_1 -->
</main>
@endsection

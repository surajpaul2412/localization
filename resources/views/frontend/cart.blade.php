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
						<div class="text-center bs-wizard-stepnum">{{dynamicLang('Your cart')}}</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="{{route('cart')}}" class="bs-wizard-dot"></a>
					</div>

					<div class="bs-wizard-step disabled">
						<div class="text-center bs-wizard-stepnum">{{dynamicLang('Payment')}}</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="#0" class="bs-wizard-dot"></a>
					</div>

					<div class="bs-wizard-step disabled">
						<div class="text-center bs-wizard-stepnum">{{dynamicLang('Finish')}}!</div>
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
						<!-- <div class="box_cart">
							<div class="box_list">
								<div class="row g-0">
									<div class="col-lg-5">
										<figure> 
											<a href="#"><img src="{{asset($item->package->avatar)}}" class="img-fluid" /></a>
										</figure>
									</div>
									<div class="col-lg-7">
										<div class="wrapper"> 
											<h3><a href="{{route('tour.show',$item->package->slug)}}">{{dynamicLang($item->package->name)}}</a></h3>
											@if($item->package->rating > 0)
				                            <div class="d-flex align-items-center">
				                                <div class="rating">
				                                    @foreach(range(1, $item->package->rating) as $index)
				                                    <i class="fas fa-star"></i>
				                                    @endforeach
				                                </div> 
				                                <a href="#">({{$item->package->reviews->count()}})</a>
				                            </div> 
				                            @endif
											<div class="price">{{dynamicLang('Date selected')}}: <strong>{{$item->date??'Not Selected'}}</strong></div><br/>
											<div class="price">{{dynamicLang('Adult')}}: <strong>{{Session::get('currency_symbol')??'₹'}} {{switchCurrency($item->package->adult_price)}} x {{$item->qty_adult??'Not Selected'}}</strong></div><br/>
											<div class="price">{{dynamicLang('Child')}}: <strong>{{Session::get('currency_symbol')??'₹'}} {{switchCurrency($item->package->child_price)}} x {{$item->qty_child??'Not Selected'}}</strong></div><br/>
											<div class="price">{{dynamicLang('Infant')}}: <strong>{{Session::get('currency_symbol')??'₹'}} {{switchCurrency($item->package->infant_price)}} x {{$item->qty_infant??'Not Selected'}}</strong></div>
										</div>
										<ul>
											<li><a class="text-info" href="{{route('cart.edit',$item->id)}}">{{dynamicLang('Edit cart item')}}</a></li>
											<li><a class="text-danger" href="{{route('cart.remove',$item->id)}}">{{dynamicLang('Remove')}}</a></li>
											<li><a href="{{route('cart.moveToWishlist',$item->id)}}">{{dynamicLang('Move to Wishlist')}}</a></li>
										</ul>
									</div>
								</div>
							</div>  
						</div> -->

						<div class="box_cart card border mb-3 rounded">
							<!-- <div class="card-header"></div> -->
							<div class="card-body">
								<div class="row g-0">
									<div class="col-lg-3">
										<figure class="m-0"> 
											<a href="#"><img src="{{asset($item->package->avatar)}}" class="img-fluid" /></a>
										</figure>
									</div>
									<div class="col-lg-9">
										<div class="wrapper ms-2"> 
											<h3 class="fs-5 m-0"><a href="{{route('tour.show',$item->package->slug)}}">{{dynamicLang($item->package->name)}}</a></h3> 
											@if($item->package->rating > 0)
				                            <div class="d-flex align-items-center">
				                                <div class="rating">
				                                    @foreach(range(1, $item->package->rating) as $index)
				                                    <i class="fas fa-star"></i>
				                                    @endforeach
				                                </div> 
				                                <a href="#">({{$item->package->reviews->count()}})</a>
				                            </div> 
				                            @endif
											<p class="fs-6 mb-1">{{dynamicLang('Date selected')}}: <strong>{{$item->date??'Not Selected'}}</strong></p>
											<ul class="d-flex justify-content-start m-0">
												<li><span class="py-1 px-2 me-1 bg-success text-white rounded">{{dynamicLang('Adult')}}: {{Session::get('currency_symbol')??'₹'}}{{switchCurrency($item->package->adult_price)}} x {{$item->qty_adult??'Not Selected'}}</span></li>
												<li><span class="py-1 px-2 me-1 bg-success text-white rounded">{{dynamicLang('Child')}}: {{Session::get('currency_symbol')??'₹'}}{{switchCurrency($item->package->child_price)}} x {{$item->qty_child??'Not Selected'}}</span></li>
												<li><span class="py-1 px-2 me-1 bg-success text-white rounded">{{dynamicLang('Infant')}}: {{Session::get('currency_symbol')??'₹'}}{{switchCurrency($item->package->infant_price)}} x {{$item->qty_infant??'Not Selected'}}</span></li>
											</ul> 
										</div> 
									</div>
								</div>
							</div>
							<div class="card-footer d-flex justify-content-between">
								<div class="left">
									<a class="text-info" href="{{route('cart.edit',$item->id)}}">{{dynamicLang('Edit cart item')}}</a> | 
									<a class="text-danger" href="{{route('cart.remove',$item->id)}}">{{dynamicLang('Remove')}}</a> 
								</div> 
								<div class="right">
									<a href="{{route('cart.moveToWishlist',$item->id)}}">{{dynamicLang('Move to Wishlist')}}</a> 
								</div> 
							</div>
						</div> 
						@endforeach
					@else
					<div>{{dynamicLang('No items in your cart')}}.</div>
					@endif  

				</div>
				<!-- /col --> 

				<aside class="col-lg-4">
					<form method="GET" action="{{route('checkout')}}" class="box_detail">
						<div id="total_cart">
							{{dynamicLang('Total')}} <span class="float-end">{{Session::get('currency_symbol')??'₹'}} {{switchCurrency($cartAmount)}}</span>
						</div>
						<ul class="cart_details"> 
							<li>{{dynamicLang('Total Packages')}} <span>x {{$cartItems->count()}}</span></li>
						</ul>
						<button type="submit" class="btn w-100 btn-success" 
							@foreach($cartItems as $cart)
								@if($cart->date == null) disabled @endif
							@endforeach
						>
						{{dynamicLang('Checkout')}}</button>
						<div class="text-center"><small>{{dynamicLang('No money charged in this step')}}</small></div>
					</form>
				</aside>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /bg_color_1 -->
</main>
@endsection

@extends('layouts.frontend.app')
@section('title')
@endsection

@section('css')
<style>
	.razorpay-payment-button{
		display: none;
		width: 100%;
		background-color: #ff7a68;
		border:none;
		color:#fff;
		padding: 15px 0;
	}
</style>
@endsection

@php
use App\Models\Razorpay;
use App\Models\Cart;

$razorpay = Razorpay::findOrFail(1);
$key = $razorpay['key'];
$secret_key = $razorpay['secret_key'];
@endphp

@section('content')
<main>
	@include('layouts.backend.partials.alert')
	
	<div class="hero_in cart_section" style="background: #0295a9 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
		<div class="wrapper">
			<div class="container">
				<div class="bs-wizard clearfix">
					<div class="bs-wizard-step disabled">
						<div class="text-center bs-wizard-stepnum">{{dynamicLang('Your cart')}}</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="#0" class="bs-wizard-dot"></a>
					</div>

					<div class="bs-wizard-step active">
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
			<form action="{{route('razorpay.payment.store')}}" method="POST" class="row">
				@csrf
				<div class="col-lg-8">
					
					<!-- [Tours List] Start -->
					<div class="card border rounded mb-3">
						<div class="card-header">
							<span class="fs-5 fw-bold">Tours Details</span>
						</div>
						<div class="card-body"> 
							@if($cartItems->count())
							@foreach($cartItems as $item)
							<div class="box_cart card border rounded mb-3"> 
								<div class="card-body">
									<div class="row g-0">
										<div class="col-lg-2">
											<figure class="m-0"> 
												<a href="#"><img src="{{asset($item->package->avatar)}}" class="img-fluid" /></a>
											</figure>
										</div>
										<div class="col-lg-10">
											<div class="wrapper ms-2"> 
												<h3 class="fs-5 m-0"><a href="{{route('tour.show',$item->package->slug)}}">{{dynamicLang($item->package->name)}}</a></h3> 		
												 <p>Group of {{$item->qty_adult+$item->qty_child+$item->qty_infant}} (Per Person)</p>
											</div> 
										</div>
									</div>
								</div>
								<div class="card-footer bg-white">
									<div class="form-group">
										<label class="col-form-label">Remarks</label>
										<textarea name="" id="" cols="30" rows="5" class="form-control form-control-sm form-control-remark" placeholder="Enter Hotel name and Airpoart name With Address...."></textarea> 
									</div>								 
								</div>								
							</div>
							@endforeach
							@endif
						</div> 

					</div>

					<div class="card border rounded mb-3">
						<div class="card-header">
							<span class="fs-5 fw-bold">Address and Payment</span>
						</div>
						<div class="card-body">
							@if(Auth::user())								
								@if(Auth::user()->addresses->count())
									<div class="row row-cols-1 row-cols-lg-2">
										@foreach(Auth::user()->addresses as $index => $address)
										<div class="col">
											<div class="card-wrap border rounded mb-4 bg-white">
												<div class="card-wrap-header px-3 py-2 br-bottom d-flex align-items-center justify-content-between">
													<div class="card-header-flex d-flex align-items-center">  
														<h4 class="fs-md ft-bold mb-0 me-1"> 
															<input type="radio" id="select-address-{{$index+1}}" class="float-left" name="radio_address" value="{{$address->id}}" @if($address->default == 1) checked @else @endif>
															<label for="select-address-{{$index+1}}" class="radio-custom-label">{{dynamicLang('Address')}}-{{$index+1}}</label>
														</h4>
														@if($address->default == 1) 
														<p class="m-0 p-0"><span class="text-success bg-success bg-opacity-25 small px-2 py-1 rounded">{{dynamicLang('Default')}}</span></p>
														@else
														<p class="m-0 p-0"><a href="{{ route('customer.address.default', $address->id) }}" class="text-primary bg-primary bg-opacity-25 small px-2 py-1 rounded">{{dynamicLang('Saved')}}</a></p> 
														@endif 
													</div>
													<div class="card-head-last-flex"> 
													</div>
												</div>
												<div class="card-wrap-body px-3 py-3"> 
													<p class="m-0"><strong>{{dynamicLang('Name')}}:</strong> {{$address->name}}</p>
													<p class="m-0"><strong>{{dynamicLang('Address')}}:</strong> {{$address->address}}, {{$address->city}}, {{$address->country}} -- {{$address->pincode}}</p>
													<p class="m-0"><strong>{{dynamicLang('Email')}}:</strong> {{$address->email}}</p>
													<p class="m-0"><strong>{{dynamicLang('Call')}}:</strong> {{$address->mobile}}</p>
												</div>
											</div>
										</div> 

										<!-- <div class="col">
											<input type="radio" class="float-left" name="radio_address" value="{{$address->id}}" @if($address->default == 1) checked @else @endif>
											<h5 class="font-weight-bold">Address {{$index+1}}:</h5>
											<div>Country: <span class="bold">{{$address->country}}</span></div>
											<div>
												City: <span class="bold">{{$address->city}}</span>,
												Pincode: <span class="bold">{{$address->pincode}}</span>
											</div>
											<div>Address: <span class="bold">{{$address->address}}</span></div>
										</div> -->
										
										@endforeach 
									</div>
								@else
								<div class="row">
									<div class="col text-center p-4 ">
										<p class="fs-4">{{dynamicLang('Address Not Found!!')}} </p>
										<p><a class="btn btn-success" href="{{route('customer.address.create')}}">{{dynamicLang('Add Address')}}</a></p>
									</div>
								</div>
								@endif
							@else
							<div class="message">
								<p>{{dynamicLang('Exisitng Customer')}}? <a href="{{route('login')}}">{{dynamicLang('Click here to login')}}</a></p>
							</div>
							@endif

							@Guest
							<div class="form_title">
								<h3>{{dynamicLang('Add New Address Details')}}</h3>
							</div>
							<div class="step">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>{{dynamicLang('Full name')}}</label>
											<input type="text" class="form-control" name="name" value="" />
										</div>
									</div>  
									<div class="col-sm-6">
										<div class="form-group">
											<label>{{dynamicLang('Email')}}</label>
											<input type="email" class="form-control" name="email" value="" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>{{dynamicLang('Telephone')}}</label>
											<input type="text" class="form-control" name="mobile" value="" />
										</div>
									</div>
									
									<div class="col-sm-4">
										<div class="form-group">
											<label>{{dynamicLang('Country')}}</label>
											<input type="text" name="country" class="form-control">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>{{dynamicLang('City')}}</label>
											<input type="text" name="city" class="form-control">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>{{dynamicLang('PinCode')}}</label>
											<input type="text" name="pincode" class="form-control">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label>{{dynamicLang('Building Address')}}</label>
											<textarea class="form-control" name="address"></textarea> 
										</div>
									</div>  
								</div>  
							</div>
							@else
							<div>
								<p class="m-0"><a class="btn btn-success btn-sm" href="{{route('customer.address.create')}}">{{dynamicLang('Add Address')}}</a></p>
							</div>
							@endGuest
						</div>						
					</div>

				</div>

				<div class="col-lg-4">
					<div class="card border rounded mb-3">
						<div class="card-header d-flex justify-content-between align-items-center">
							<span class="fs-6 fw-bold">{{dynamicLang('Total')}}</span>
							<span class="fs-5 fw-bold">{{Session::get('currency_symbol')??'₹'}}{{switchCurrency($cartAmount)}}</span>
						</div>
						<div class="card-body">
							@if($cartItems->count())
								@foreach($cartItems as $item)
								<div class="card border rounded mb-2">
									<div class="card-header bg-white">
										<p class="fs-6 m-0">{{dynamicLang($item->package->name)}}</p>
									</div>
									<div class="card-body">
										<ul class="card-tours-availbility-list">
											<li class="item">
												<span><b>Date</b></span>
												<span>{{$item->date??'Not Selected'}}</span>
											</li>
											<li class="item">
												<span><b>Quantity</b></span>
												<span>{{$item->qty_adult}} x Adult, {{$item->qty_child}} x Child, {{$item->qty_infant}} x infant</span>
											</li> 
											<li class="item">
												<span><b>Covered Area</b></span>
												<span>{{$item->package->city->name}}</span>
											</li>
											<li class="item">
												<span><b>Activity & Duration</b></span>
												<span>{{$item->package->duration}}-{{$item->package->activity->name}}</span>
											</li>
										</ul>
									</div>
									<div class="card-footer d-flex justify-content-between align-items-center">
										<span class="fs-6">Amount</span>
										<span class="fs-6 fw-bold">{{Session::get('currency_symbol')??'₹'}} {{switchCurrency(Cart::itemPrice($item))}}</span>
									</div>
								</div>
								@endforeach
							@endif
						</div>
						<div class="card-footer">
						<button type="submit" class="btn w-100 btn-success">{{dynamicLang('Pay Now')}}</button>
						<p class="m-0 text-center"><small>{{dynamicLang('No money charged in this step')}}</small></p>
						</div>
					</div>
					<!-- <div class="box_detail">
						<div id="total_cart">
							{{dynamicLang('Total')}} <span class="float-end">{{Session::get('currency_symbol')??'₹'}} {{switchCurrency($cartAmount)}}</span>
							<input type="hidden" name="tax" value="40">
						</div>
						<div class="text-center"><small>{{dynamicLang('No money charged in this step')}}</small></div>
					</div> -->
				</div>

				<script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ $key }}"
                        data-amount="{{$cartAmount*100}}"
                        data-buttontext="{{dynamicLang('Make Payment')}}"
                        data-name="GetBeds"
                        data-description="Rozerpay"
                        data-image="http://getbeds.starklikes.com/images/logo.png"
                        data-prefill.name="name"
                        data-prefill.email="email"
                        data-theme.color="#ff7529">
                </script>
				
			</form>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /bg_color_1 -->
</main>
@endsection
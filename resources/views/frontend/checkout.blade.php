@extends('layouts.frontend.app')
@section('title')
@endsection

@section('css')
<style>
	.razorpay-payment-button{
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
						<div class="text-center bs-wizard-stepnum">Your cart</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="#0" class="bs-wizard-dot"></a>
					</div>

					<div class="bs-wizard-step active">
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
			<form action="{{route('razorpay.payment.store')}}" method="POST" class="row">
				@csrf
				<div class="col-lg-8">
					<div class="box_cart">
						@if(Auth::user())
							<div class="message bg-dark row">
								@if(Auth::user()->addresses->count())
									@foreach(Auth::user()->addresses as $index => $address)
									<div class="card col-md-6 bg-white p-4 border">
										<input type="radio" class="float-left" name="radio_address" value="{{$address->id}}" @if($address->default == 1) checked @else @endif>
										<h5 class="font-weight-bold">Address {{$index+1}}:</h5>
										<div>Country: <span class="bold">{{$address->country}}</span></div>
										<div>
											City: <span class="bold">{{$address->city}}</span>,
											Pincode: <span class="bold">{{$address->pincode}}</span>
										</div>
										<div>Address: <span class="bold">{{$address->address}}</span></div>
									</div>
									@endforeach
								@endif
							</div>
						@else
						<div class="message">
							<p>Exisitng Customer? <a href="{{route('login')}}">Click here to login</a></p>
						</div>
						@endif

						@Guest
						<div class="form_title">
							<h3>Add New Address Details</h3>
						</div>
						<div class="step">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Full name</label>
										<input type="text" class="form-control" name="name" value="" />
									</div>
								</div>  
								<div class="col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" name="email" value="" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Telephone</label>
										<input type="text" class="form-control" name="mobile" value="" />
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label>Country</label>
										<input type="text" name="country" class="form-control">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>City</label>
										<input type="text" name="city" class="form-control">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>PinCode</label>
										<input type="text" name="pincode" class="form-control">
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Building Address</label>
										<textarea class="form-control" name="address"></textarea> 
									</div>
								</div>  
							</div>  
						</div>
						@else
						<div>
							<p>Add New Address? <a class="text-info" href="{{route('customer.address.create')}}">Click here to add address</a></p>
						</div>
						@endGuest						
					</div>
				</div>

				<div class="col-lg-4">
					<div class="box_detail">
						<div id="total_cart">
							Total <span class="float-end">₹{{$cartAmount}}.00</span>
							<input type="hidden" name="tax" value="40">
						</div>
						<!-- <button type="submit" class="btn_1 full-width purchase">Payment</button> -->
						<div class="text-center"><small>No money charged in this step</small></div>
					</div>
				</div>

				<script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ $key }}"
                        data-amount="{{$cartAmount*100}}"
                        data-buttontext="Make Payment"
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
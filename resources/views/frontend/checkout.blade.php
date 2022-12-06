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
						<div class="form_title">
							<h3>Add New Address Details</h3>
						</div>
						<div class="step">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Full name</label>
										@if(Auth::user())
										<input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" />
										@else
										<input type="text" class="form-control" name="name" value="" />
										@endif
									</div>
								</div>  
								<div class="col-sm-6">
									<div class="form-group">
										<label>Email</label>
										@if(Auth::user())
										<input type="email" class="form-control" name="email" value="{{Auth::user()->email}}" />
										@else
										<input type="email" class="form-control" name="email" value="" />
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Telephone</label>
										@if(Auth::user())
										<input type="text" class="form-control" name="mobile" value="{{Auth::user()->mobile}}" />
										@else
										<input type="text" class="form-control" name="mobile" value="" />
										@endif
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

						<!-- <div id="policy">
							<h5>Cancellation policy</h5>
							<p class="nomargin">Lorem ipsum dolor sit amet, vix <a href="#0">cu justo blandit deleniti</a>, discere omittantur consectetuer per eu. Percipit repudiare similique ad sed, vix ad decore nullam ornatus.</p>
						</div> -->
						
					</div>
				</div>

				<div class="col-lg-4">
					<div class="box_detail">
						<div id="total_cart">
							Total <span class="float-end">₹{{$cartAmount}}.00</span>
							<input type="hidden" name="tax" value="40">
						</div>
						<!-- <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZORPAY_KEY') }}"
                                data-amount="1000"
                                data-buttontext="payment"
                                data-name="GetBeds"
                                data-description="Rozerpay"
                                data-image="http://getbeds.starklikes.com/images/logo.png"
                                data-prefill.name="name"
                                data-prefill.email="email"
                                data-theme.color="#ff7529">
                        </script> -->

						<!-- <button type="submit" class="btn_1 full-width purchase">Payment</button> -->
						<div class="text-center"><small>No money charged in this step</small></div>
					</div>
				</div>

				<script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('RAZORPAY_KEY') }}"
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
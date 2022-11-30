@extends('layouts.frontend.app')
@section('title')
@endsection

@section('content') 

<main>
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
			<form action="{{route('payment')}}" method="POST" class="row">
				@csrf
				<div class="col-lg-8">
					<div class="box_cart">
						@if(Auth::user())
							<div class="message bg-dark row">
								@if(Auth::user()->addresses->count())
									@foreach(Auth::user()->addresses as $index => $address)
									<div class="card col-md-6 bg-white p-4 border">
										<input type="radio" class="float-left" name="radio_address" value="{{$address->id}}">
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

						<div id="policy">
							<h5>Cancellation policy</h5>
							<p class="nomargin">Lorem ipsum dolor sit amet, vix <a href="#0">cu justo blandit deleniti</a>, discere omittantur consectetuer per eu. Percipit repudiare similique ad sed, vix ad decore nullam ornatus.</p>
						</div>
						
					</div>
				</div>
				<!-- /col -->

				<aside class="col-lg-4">
					<div class="box_detail">
						<div id="total_cart">
							Total <span class="float-end">₹{{$cartAmount}}.00</span>
						</div>
						<!-- <ul class="cart_details">
							<li>From <span>02-11-18</span></li>
							<li>To <span>04-11-18</span></li>
							<li>Adults <span>2</span></li>
							<li>Childs <span>1</span></li>
						</ul> -->
						<button type="submit" class="btn_1 full-width purchase">Payment</button>
						<div class="text-center"><small>No money charged in this step</small></div>
					</div>
				</aside>
			</form>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /bg_color_1 -->
</main>

@endsection
@extends('layouts.frontend.app')
@section('title')
<title>Success | GetBeds</title>
<meta name="keywords" content="">
<meta name="description" content="">
@endsection

@section('content') 

<main>
	<div class="hero_in cart_section last" style="background: #0295a9 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
		<div class="wrapper">
			<div class="container">
				<div class="bs-wizard clearfix">
					<div class="bs-wizard-step">
						<div class="text-center bs-wizard-stepnum">{{dynamicLang('Your cart')}}</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="cart-1.html" class="bs-wizard-dot"></a>
					</div>

					<div class="bs-wizard-step">
						<div class="text-center bs-wizard-stepnum">{{dynamicLang('Payment')}}</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="cart-2.html" class="bs-wizard-dot"></a>
					</div>

					<div class="bs-wizard-step active">
						<div class="text-center bs-wizard-stepnum">{{dynamicLang('Finish')}}!</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="#0" class="bs-wizard-dot"></a>
					</div>
				</div>
				<!-- End bs-wizard -->
				<div id="confirm">
					<h4>{{dynamicLang('Booking Successful')}}!</h4>
					<p>{{dynamicLang('Order placed successfully')}}</p>
				</div>
			</div>
		</div>
	</div>
	<!--/hero_in-->
</main>

@endsection
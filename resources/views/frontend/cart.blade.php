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
						<a href="#0" class="bs-wizard-dot"></a>
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
					<div class="box_cart">
						<div class="box_list">
							<div class="row g-0">
								<div class="col-lg-5">
									<figure> 
										<a href="#"><img src="{{asset('images/destination/2.jpg')}}" class="img-fluid" /></a>
									</figure>
								</div>
								<div class="col-lg-7">
									<div class="wrapper"> 
										<h3><a href="#">Singapore: S.E.A. Aquarium Entrance Ticket</a></h3>
										<p>S.E.A. Aquarium Standard Admission (GT QR Code)</p> 
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
										<li><a href="#">Move to Wishlist</a></li>
									</ul>
								</div>
							</div>
						</div>  
					</div>
				</div>
				<!-- /col --> 

				<aside class="col-lg-4">
					<div class="box_detail">
						<div id="total_cart">
							Total <span class="float-end">69.00$</span>
						</div>
						<ul class="cart_details">
							<li>From <span>02-11-18</span></li>
							<li>To <span>04-11-18</span></li>
							<li>Adults <span>2</span></li>
							<li>Childs <span>1</span></li>
						</ul>
						<a href="checkout.php" class="btn_1 full-width purchase">Checkout</a>
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

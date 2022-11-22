@extends('layouts.frontend.app')
@section('title')
<title>{{$tour->name}} | GetBeds</title>
@endsection

@php
use App\Models\Package;

$mightAlsoLike = Package::where('slug','!=',$tour->slug)->whereStatus(1)->inRandomOrder()->take(5)->get();
@endphp

@section('content')
<main>
	<section class="hero_in tours_detail" style="background: url({{asset('images/home_section_1.jpg')}});">
		<div class="wrapper">
			<div class="container">
				<h1><span></span>Tour detail page</h1>
			</div>
			<span class="magnific-gallery">
				@if($tour->gallery->count())
				@foreach($tour->gallery as $gallery)
				<a href="{{asset($gallery->image)}}" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in">View photos</a>
				@endforeach
				@endif
			</span>
		</div>
	</section>
	<!--/hero_in-->

	<div class="bg_color_1">
		<nav class="secondary_nav sticky_horizontal">
			<div class="container">
				<ul class="clearfix">
					<li><a href="#description" class="active">Description</a></li>
					<li><a href="#tour_experience">Experience</a></li>
					<li><a href="#reviews">Reviews</a></li>
					<li><a href="#sidebar">Booking</a></li> 
				</ul>
			</div>
		</nav>
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-8">
					<section id="description">
						<h2>Description</h2>
						{!!$tour->description!!}
						<hr>
						<h3>Amenities</h3>
						<div class="row">
							<div class="col">
								<ul class="amenities-details d-flex flex-wrap">
									@if($tour->amenities->count())
									@foreach($tour->amenities as $amenity)
									<li> 
										<a href="#0" class="box-item style-4"> 
											<img src="{{asset($amenity->amenity->icon)}}" alt="{{$amenity->amenity->name}}" />
											<p>{{$amenity->amenity->name}}</p>
										</a> 
									</li>
									@endforeach
									@endif
								</ul>
							</div> 
						</div>
						<!-- /row --> 
						
					</section>
					<!-- /section -->
					
					<section id="tour_experience">  
						<h3>Experience</h3> 
						<div class="cbp_experience">
							@if($tour->highlights)
							<div class="row cbp_experience_list"> 
								<div class="col-lg-4 cbp_title">
									<h5>Highlights</h5>
								</div>
								<div class="col-lg-8 cbp_content"> 
									{!!$tour->highlights!!}
								</div>
							</div>
							@endif

							@if($tour->full_description)
							<div class="row cbp_experience_list"> 
								<div class="col-lg-4 cbp_title">
									<h5>Full description</h5>
								</div>
								<div class="col-lg-8 cbp_content">
									{!!$tour->full_description!!}
								</div>
							</div> 
							@endif

							@if($tour->includes)
							<div class="row cbp_experience_list"> 
								<div class="col-lg-4 cbp_title">
									<h5>Includes</h5>
								</div>
								<div class="col-lg-8 cbp_content"> 
									{!!$tour->includes!!}
								</div>
							</div> 
							@endif

							@if($tour->meeting_point)
							<div class="row cbp_experience_list"> 
								<div class="col-lg-4 cbp_title">
									<h5>Meeting point</h5>
								</div>
								<div class="col-lg-8 cbp_content"> 
									{!!$tour->meeting_point!!}
								</div>
							</div> 
							@endif

							@if($tour->important_information)
							<div class="row cbp_experience_list"> 
								<div class="col-lg-4 cbp_title">
									<h5>Important information</h5>
								</div>
								<div class="col-lg-8 cbp_content"> 
									{!!$tour->important_information!!}
								</div>
							</div> 
							@endif
						</div>  
					</section>
					<!-- /section -->

					<section id="also-likes" class="also-likes-contain">
						<div class="container">
							<div class="main_title_3 d-flex justify-content-between align-items-center">
								<div> 
									<span><em></em></span>
									<h2>You might also likes...</h2> 
								</div>  
							</div> 
							
							<div id="you_might_also_like" class="owl-carousel owl-theme">
								@foreach($mightAlsoLike as $element)
								<div class="item"> 
									<div class="box_grid">
										<figure>
											<a href="tour-details.php" class="wish_bt"></a>
											<a href="#0">
												<img src="assets/images/destination/1.jpg" class="img-fluid" alt="" /> 
											</a> 
										</figure>
										<div class="wrapper">
											<h3><a href="tour-details.php">{{$element->name}}</a></h3> 
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
										</div> 
										<ul class="d-flex justify-content-between align-items-center"> 
											<!-- <li><i class="icon_clock_alt"></i> 18:30 - 21:30</li> --> 
											<li><span><b>From <small><del><b>$314.31</b></del></small> $314.31</b><small>/person</small></span></li> 
										</ul>
									</div>
								</div>
								@endforeach
							</div>  

						</div>
					</section> 
					<!-- /You might also likes. -->   
				
					<section id="reviews">
						<h2>Reviews</h2>
						<div class="reviews-container">
							<div class="row">
								<div class="col-lg-3">
									<div id="review_summary">
										<strong>8.5</strong>
										<em>Superb</em>
										<small>Based on 4 reviews</small>
									</div>
								</div>
								<div class="col-lg-9">
									<div class="row">
										<div class="col-lg-10 col-9">
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
									</div>
									<!-- /row -->
									<div class="row">
										<div class="col-lg-10 col-9">
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
									</div>
									<!-- /row -->
									<div class="row">
										<div class="col-lg-10 col-9">
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
									</div>
									<!-- /row -->
									<div class="row">
										<div class="col-lg-10 col-9">
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
									</div>
									<!-- /row -->
									<div class="row">
										<div class="col-lg-10 col-9">
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
									</div>
									<!-- /row -->
								</div>
							</div>
							<!-- /row -->
						</div>

						<hr>

						<div class="reviews-container">

							<div class="review-box clearfix">
								<figure class="rev-thumb"><img src="assets/images/avatar1.jpg" alt="">
								</figure>
								<div class="rev-content">
									<div class="rating">
										<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
									</div>
									<div class="rev-info">
										Admin – April 03, 2016:
									</div>
									<div class="rev-text">
										<p>
											Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
										</p>
									</div>
								</div>
							</div>
							<!-- /review-box -->
							<div class="review-box clearfix">
								<figure class="rev-thumb"><img src="assets/images/avatar2.jpg" alt="">
								</figure>
								<div class="rev-content">
									<div class="rating">
										<i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
									</div>
									<div class="rev-info">
										Ahsan – April 01, 2016:
									</div>
									<div class="rev-text">
										<p>
											Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
										</p>
									</div>
								</div>
							</div>
							<!-- /review-box -->
							<div class="review-box clearfix">
								<figure class="rev-thumb"><img src="assets/images/avatar3.jpg" alt="">
								</figure>
								<div class="rev-content">
									<div class="rating">
										<i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
									</div>
									<div class="rev-info">
										Sara – March 31, 2016:
									</div>
									<div class="rev-text">
										<p>
											Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
										</p>
									</div>
								</div>
							</div>
							<!-- /review-box -->
						</div>
						<!-- /review-container -->
					</section>
					<!-- /section -->
					<hr>

					<div id="add_review" class="add-review">
						<h5>Leave a Review</h5>
						<form>
							<div class="row">
								<div class="form-group col-md-6">
									<label>Full Name*</label>
									<input type="text" name="name_review" id="name_review" placeholder="" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<label>Email *</label>
									<input type="email" name="email_review" id="email_review" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<label>Rating </label>
									<div class="custom-select-form">
									<select name="rating_review" id="rating_review" class="wide">
										<option value="1">1 (lowest)</option>
										<option value="2">2</option>
										<option value="3">3 (medium)</option>
										<option value="4">4</option>
										<option value="5" selected>5 (highest)</option> 
									</select>
									</div>
								</div>
								<div class="form-group col-md-12">
									<label>Your Review</label>
									<textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
								</div>
								<div class="form-group col-md-12 add_top_20">
									<input type="submit" value="Submit" class="btn_1" id="submit-review">
								</div>
							</div>
						</form>
					</div>

					<section id="we-served" class="also-likes-contain"> 
							<div class="main_title_3 d-flex justify-content-between align-items-center">
								<div> 
									<span><em></em></span>
									<h2><small>We've served 15 million+ guest and we are here for you</small></h2> 
								</div>  
							</div> 
							
							<div class="row row-cols-2 row-cols-lg-4">
								<div class="col">
									<div class="trust-box">
										<img src="{{asset('images/icons/1.png')}}" alt="icon" />
										<h3>15 million+</h3>
										<p>Sed ut perspiciatis unde omnis iste natus.</p>
									</div>
								</div>
								<div class="col">
									<div class="trust-box">
										<img src="{{asset('images/icons/2.png')}}" alt="icon" />
										<h3>4/5</h3>
										<p>Sed ut perspiciatis unde omnis iste natus.</p>
									</div>
								</div>
								<div class="col">
									<div class="trust-box">
										<img src="{{asset('images/icons/3.png')}}" alt="icon" />
										<h3>In the Media</h3>
										<p>Sed ut perspiciatis unde omnis iste natus.</p>
									</div>
								</div>
								<div class="col">
									<div class="trust-box">
										<img src="{{asset('images/icons/4.png')}}" alt="icon" />
										<h3>24x7 Help Center</h3>
										<p>Sed ut perspiciatis unde omnis iste natus.</p>
									</div>
								</div>
							</div>  
					</section> 
					<!-- /You might also likes. --> 

				</div>
				<!-- /col -->
				
				<aside class="col-lg-4" id="sidebar">
					<div class="box_detail booking">
						<!-- <div class="price">
							<span>45$ <small>person</small></span>
							<div class="score"><span>
								<div class="rating mb-1">
									<i class="icon-star voted"></i>
									<i class="icon_star voted"></i>
									<i class="icon_star voted"></i>
									<i class="icon_star voted"></i>
									<i class="icon_star"></i>
								</div>
								<em>350 Reviews</em></span><strong>5.0</strong>
							</div>
						</div> -->

						<!-- <div class="form-group">
							<input class="form-control" type="date" name="date" placeholder="From..">
							<i class="icon_calendar"></i>
						</div>   -->
						<div class="form-group">
							<input class="form-control" type="date" name="date" placeholder="To..">
							<!-- <i class="icon_calendar"></i> -->
						</div>  
						
						<div class="panel-dropdown">
							<a href="#">Guests <span class="qtyTotal">1</span></a>
							<div class="panel-dropdown-content right">
								<div class="qtyButtons">
									<label>Adults</label>
									<input type="text" name="qtyInput" value="1">
								</div>
								<div class="qtyButtons">
									<label>Childrens</label>
									<input type="text" name="qtyInput" value="0">
								</div>
								<div class="qtyButtons">
									<label>Infant</label>
									<input type="text" name="qtyInput" value="0">
								</div>
							</div>
						</div>

						<!-- <div class="guest-inc-box d-flex justify-content-between align-items-center">
							<a href="#">Guests</a>
							<div class="counter">
								<span class="down" onClick='decreaseCount(event, this)'>-</span>
								<input type="text" value="1">
								<span class="up" onClick='increaseCount(event, this)'>+</span>
							</div>
						</div>  -->
						<div class="booking-box-details">
							<ul class="cart_details">
								<li>${{$tour->presentPrice($tour->adult_price)}} x 1 Adults <span>$90</span></li>
								<li>${{$tour->presentPrice($tour->child_price)}} x 1 Childrens <span>$90</span></li>
								<li>${{$tour->presentPrice($tour->infant_price)}} x 1 Infant <span>$90</span></li>
								<li>Tax <i class="ti-info-alt"></i> <span>$40</span></li>
								<!-- <li>Accident Insurance <span class="text-success">Free</span></li>  -->
							</ul> 
						</div>
						
						<div id="total_cart">
							Total <span class="float-end">$69.00</span>
						</div>



						<a href="cart.php" class="btn_1 full-width purchase">Purchase</a>

						<a type="button" href="{{route('wishlist.add', $tour->id)}}" class="btn_1 full-width outline wishlist">
							<i class="icon_heart"></i> Add to wishlist
						</a>
						<div class="text-center"><small>No money charged in this step</small></div>
					</div>
					<!-- <ul class="share-buttons">
						<li><a class="fb-share" href="#0"><i class="social_facebook"></i> Share</a></li>
						<li><a class="twitter-share" href="#0"><i class="social_twitter"></i> Tweet</a></li>
						<li><a class="gplus-share" href="#0"><i class="social_googleplus"></i> Share</a></li>
					</ul> -->
				</aside>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /bg_color_1 -->
</main> 
@endsection

@section('script')
<script src="{{asset('js/input_qty.js')}}"></script>

<!-- DATEPICKER  -->
<script>
	$(function() {
		$('input[name="dates"]').daterangepicker({
			autoUpdateInput: false,
			parentEl:'.scroll-fix',
			minDate:new Date(),
			opens: 'left',
			locale: {
				cancelLabel: 'Clear'
			}
		});
		$('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('MM-DD-YY') + ' > ' + picker.endDate.format('MM-DD-YY'));
		});
		$('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	});
</script>
@endsection
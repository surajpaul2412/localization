@extends('layouts.frontend.app')
@section('title')
<title>Tours | GetBeds</title>
@endsection

@php
use App\Models\Package;
use App\Models\City;
use App\Models\Activity;
use App\Models\Amenity;
use App\Models\Category;

$tours = Package::whereStatus(1)->get();
$cities = City::all();
$activities = Activity::whereStatus(1)->get();
$amenities = Amenity::whereStatus(1)->get();
$categories = Category::whereStatus(1)->get();
@endphp

@section('content') 
	<main>   
		<section class="hero_in tours" style="background: url({{asset('images/pattern_1.svg')}});" >
			<div class="wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-8">
							<div class="row g-0 custom-search-input-2">
								<div class="col-lg-10">
									<div class="form-group">
										<input class="form-control" type="text" placeholder="Where are you going?">
										<i class="icon_pin_alt"></i>
									</div>
								</div> 
								<div class="col-lg-2">
									<input type="submit" class="btn_search" value="Search">
								</div>
							</div> 
						</div>
					</div>
					<h1 class="my-4">Tours Page</h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->
		
		<!-- <div class="filters_listing sticky_horizontal"></div> -->
		<!-- /filters --> 

		<div class="section tours-wrapper"> 
			<div class="container">
				<div class="row">

					<aside class="col-lg-3" id="sidebar">
						<div id="filters_col">
							<a data-bs-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
							<div class="collapse show" id="collapseFilters">

								<div class="filter_type">
									<h6>Destinations</h6>
									<ul>
										<li>
											<label class="container_check">All <small>({{$cities->count()}})</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										@foreach($cities as $city)
										<li>
											<label class="container_check">{{$city->name}} <large>, {{$city->country->name}}</large>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										@endforeach
									</ul>
								</div>

								<div class="filter_type">
									<h6>Price</h6>
									<input type="text" id="range" name="range" value="">
								</div>

								<div class="filter_type">
									<h6>Category</h6>
									<ul>
										@foreach($categories as $category)
										<li>
											<label class="container_check">{{$category->name}}
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										@endforeach
									</ul>
								</div>

								<div class="filter_type">
									<h6>Activity</h6>
									<ul>
										@foreach($activities as $activity)
										<li>
											<label class="container_check">{{$activity->name}}
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										@endforeach
									</ul>
								</div>

								<div class="filter_type">
									<h6>Amenity</h6>
									<ul>
										@foreach($amenities as $amenity)
										<li>
											<label class="container_check">{{$amenity->name}}
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										@endforeach
									</ul>
								</div>

								<div class="filter_type">
									<h6>Rating</h6>
									<ul>
										<li>
											<label class="container_check">Superb 9+ <small>(25)</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Very Good 8+ <small>(26)</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Good 7+ <small>(25)</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Pleasant 6+ <small>(12)</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
									</ul>
								</div>
							</div>
							<!--/collapse -->
						</div> 
					</aside>
					<!-- /aside --> 

					<div class="col-lg-9">
						<div id="loadContent" class="isotope-wrapper">
							<div class="row row-cols-1 row-cols-lg-3">
								@if($tours->count())
								@foreach($tours as $index => $tour)
								<div class="col isotope-item">
									<div class="box_grid">
										<figure>
											<a href="{{route('tour.show', $tour->slug)}}" class="wish_bt"></a>
											<a href="{{route('tour.show', $tour->slug)}}">
												<img src="{{asset('images/destination/2.jpg')}}" class="img-fluid" alt="" /> 
											</a> 
										</figure>
										<div class="wrapper">
											<h3><a href="{{route('tour.show', $tour->slug)}}">{{$tour->name}}</a></h3> 
											<div class="d-flex align-items-center">
												<div class="rating">
													<i class="fas fa-star"></i>
													<i class="fas fa-star"></i>
													<i class="fas fa-star"></i>
													<i class="fa fa-star-half"></i>
													<i class="far fa-star"></i>
												</div> 
												<a href="{{route('tour.show', $tour->slug)}}">({{$tour->price}})</a>   
											</div> 
										</div> 
										<ul class="d-flex justify-content-between align-items-center"> 
											<!-- <li><i class="icon_clock_alt"></i> 18:30 - 21:30</li> --> 
											<li><span><b>From <small><del><b>${{$tour->price}}</b></del></small> ${{$tour->price}}</b><small>/person</small></span></li> 
										</ul>
									</div>
								</div>
								@endforeach
								@endif
								<div class="col isotope-item">
									<div class="box_grid">
										<figure>
											<a href="#0" class="wish_bt"></a>
											<a href="tour-details.php">
												<img src="{{asset('images/destination/2.jpg')}}" class="img-fluid" alt="" /> 
											</a> 
										</figure>
										<div class="wrapper">
											<h3><a href="tour-details.php">Street Food Tour in Bangkok Chinatown</a></h3> 
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
							</div> 
						</div> 
					</div> 

				</div> 
			
				<p class="text-center"><a href="#0" id="loadMore" class="btn_1 rounded add_top_30">Load more</a></p>
			</div>
		</div> 
		<!-- /isotope-wrapper --> 

        @include('layouts.frontend.partials.ads') 
		
	</main>
@endsection

@section('script')
<script>
	 $("#range").ionRangeSlider({
        hide_min_max: true,
        keyboard: true,
        min: 30,
        max: 180,
        from: 60,
        to: 130,
        type: 'double',
        step: 1,
        prefix: "Min. ",
        grid: false
    });
</script>
@endsection
@extends('layouts.frontend.app')
@section('title')
<title>Search | GetBeds</title>
@endsection

@php
use App\Models\Amenity;
use App\Models\Activity;
use App\Models\Package;
use App\Models\City;
use App\Models\Category;
use App\Models\Country;

$amenities = Amenity::inRandomOrder()->whereStatus(1)->get();
$tours = Package::inRandomOrder()->whereStatus(1)->get();
$cities = City::inRandomOrder()->get();
$categories = Category::whereStatus(1)->get();
$activities = Activity::whereStatus(1)->get();
$countries = Country::whereStatus(1)->pluck('name')->toArray();
$searchCity = City::pluck('name')->toArray();
$suggestions = json_encode(array_merge($countries, $searchCity));
$api_url = json_encode(env("API_URL"));

@endphp

@section('content')
<main>  
	<section class="hero_in tours" style="background: url({{asset('images/pattern_1.svg')}});" >
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
	            <div class="advance-seach-box-inner">
	                <div class="autocomplete">
	                    <form action="{{route('search')}}" method="POST" class="row g-0 custom-search-input-2">
	                        @csrf 
	                        <div class="col-lg-10">
	                            <div class="form-group">
	                                <input id="myInput" class="form-control" type="text" name="search" placeholder="{{dynamicLang('Where are you going?')}}" value="{{$search}}" required />
	                                <i class="icon_pin_alt"></i>
	                            </div>
	                        </div> 
	                        <div class="col-lg-2">
	                            <input type="submit" class="btn_search" value="Search">
	                        </div> 
	                    </form>
	                </div>
	            </div> 
	        </div> 
				</div>
				<h1 class="my-4">{{$search}}</h1>
			</div>
		</div>
	</section>
	<!--/hero_in-->
	
	<div class="filters_listing sticky_horizontal">
		<div class="container">
			<div class="position-relative py-3"> 
				<!-- [Amenities filter] Start -->
				<div class="slick-amenities-filter me-2  d-none d-lg-block">  
					@foreach($amenities as $amenity)
					<div class="item">
						<div class="form-check form-option p-0">
							<input class="form-check-input searchType" type="checkbox" name="amenityId" id="{{$amenity->id}}">
							<!-- ABHISHEK -- modify -->
							<label><img src="{{asset($amenity->icon)}}" alt="{{$amenity->name}}" /></label>
							<label class="form-option-label" for="{{$amenity->id}}">{{dynamicLang($amenity->name)}}</label>
						</div>
					</div>
					@endforeach
					 
				</div> 
				<!-- [Button trigger modal] Start -->
				<div class="filter-btn">
					<button type="button" class="btn_1 btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal"> <i class="ti-align-left"></i> Filter</button>
				</div>

				<!-- <div class="text-left pb-0 pt-2">
					<div class="form-check form-option form-check-inline mb-2">
						<input class="form-check-input" type="checkbox" name="sizes" id="af5" value="48">
						<label class="form-option-label" for="af5">Tour Guide</label>
					</div>                                                                                      
					<div class="form-check form-option form-check-inline mb-2">
						<input class="form-check-input" type="checkbox" name="sizes" id="af1" value="44">
						<label class="form-option-label" for="af1">Hotel Drop-Off</label>
					</div>
					<div class="form-check form-option form-check-inline mb-2">
						<input class="form-check-input" type="checkbox" name="sizes" id="af2" value="45">
						<label class="form-option-label" for="af2">Hotel Pick-Up</label>
					</div>
					<div class="form-check form-option form-check-inline mb-2">
						<input class="form-check-input" type="checkbox" name="sizes" id="af3" value="46">
						<label class="form-option-label" for="af3">Luggage Delivery</label>
					</div>
					<div class="form-check form-option form-check-inline mb-2">
						<input class="form-check-input" type="checkbox" name="sizes" id="af4" value="47">
						<label class="form-option-label" for="af4">Private Transfer</label>
					</div>
					<div class="form-check form-option form-check-inline mb-2">
						<input class="form-check-input" type="checkbox" name="sizes" id="af5" value="48">
						<label class="form-option-label" for="af5">Transport Services</label>
					</div> 
				</div> -->

			</div>	 
			
		</div>
		<!-- /container -->
	</div>
	<!-- /filters --> 

	<div class="section tours-wrapper"> 
		<div class="container"> 

			<div id="loadContent" class="isotope-wrapper">
				<div class="row row-cols-1 row-cols-lg-4 packages-grid">
					@if($packages->count())
						@foreach($packages as $index => $tour)
						<div class="col isotope-item">
							<div class="box_grid">
								@if($tour->combo == 1)
								<div class="ribbon">
									<span>Combo</span>
								</div>
								@endif
								<figure>									
									@if($tour->seal == 1)
									<img class="trust-badges" src="{{asset('images/trust-badge.png')}}" width="40px" />
									@endif
										@if(Auth::user())
											@if(Auth::user()->wishlist->count() > 0)
												@foreach(Auth::user()->wishlist as $wishlist)
													@if($wishlist->package_id == $tour->id)
														<a href="{{route('wishlist.remove', $wishlist->id)}}" class="wish_bt liked"></a>
													@else
														<a href="{{route('wishlist.add', $tour->id)}}" class="wish_bt"></a>
													@endif
												@endforeach
											@else
												<a href="{{route('wishlist.add', $tour->id)}}" class="wish_bt"></a>
											@endif
										@else
											<a href="{{route('wishlist.add', $tour->id)}}" class="wish_bt"></a>
										@endif
									
									<a href="{{route('tour.show', $tour->slug)}}">
										<img src="{{asset($tour->avatar)}}" class="img-fluid" alt="" /> 
									</a> 
								</figure>
								<div class="wrapper">
                            		<badge class="category-names text-white bg-black py-1 px-2 rounded">{{$tour->category->name}}</badge>
									<h3><a href="{{route('tour.show', $tour->slug)}}">{{dynamicLang(\Illuminate\Support\Str::limit($tour->name ?? '',25,' ...'))}}</a></h3> 
									@if($tour->rating > 0)
									<div class="d-flex align-items-center">
                      <div class="rating">
                          <i class="fas fa-star"></i> 
                          <i class="me-2 fs-6">{{$tour->rating}}</i>
                      </div> 
                      <div>({{$tour->reviews->count()}} Reviews)</div>   
                  </div>
									@endif
								</div> 
								<ul class="d-flex justify-content-between align-items-center"> 
									<li>
										<span><b>{{dynamicLang('From')}}: </b><small><del><b>
											@if($tour->discount > 0)
                          {{Session::get('currency_symbol')??'₹'}}{{switchCurrency($tour->adult_price)}}</b></del></small>{{Session::get('currency_symbol')??'₹'}}{{switchCurrency($tour->adult_price-($tour->adult_price*$tour->discount)/100)}}</b><small>/{{dynamicLang('person')}}</small></span>
                      @else
                          </b></del></small>{{Session::get('currency_symbol')??'₹'}}{{switchCurrency($tour->adult_price-($tour->adult_price*$tour->discount)/100)}}</b><small>/{{dynamicLang('person')}}</small></span>
                      @endif
									</li> 
								</ul>
							</div>
						</div>
						@endforeach
					@else
						<div class="col">No Items found according to city/country.</div>
					@endif 
				</div> 
			</div>  
		
			<p class="text-center"><a href="#0" id="loadMore" class="btn_1 rounded add_top_30">Load more</a></p>
		</div>
	</div> 
	<!-- /isotope-wrapper --> 

    @include('layouts.frontend.partials.ads')
</main>

<style>
	.border-bottom { border-bottom: 1px solid #ededed; }
	.border-top-0 { border-bottom: 0px solid #ededed; }
</style>

<!-- [filterModal] Start -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Select Filters</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="filter_type border-bottom"> 
						<h6 class="m-0 pb-3 border-top-0">{{dynamicLang('Category')}}</h6>
						<ul class="d-flex flex-wrap">
							@foreach($categories as $index => $category)
							<li>
								<div class="form-check form-option p-0 me-2"> 
									<input type="checkbox" class="form-check-input filterType" id="cat_{{$category->id}}" name="categoryId" value="{{$category->id}}"
										@if(isset($requests['category']))
											@foreach($requests['category'] as $categoryArray)
												@if($categoryArray == $category->id)
													checked
												@endif
											@endforeach
										@endif
									/>
									<label class="form-option-label container_check" for="cat_{{$category->id}}">{{dynamicLang($category->name)}}</label>
								</div>

								<!-- <label class="container_check">{{dynamicLang($category->name)}}
									<input type="checkbox" 
												class="filterType" 
												name="categoryId" 
												value="{{$category->id}}"
												@if(isset($requests['category']))
													@foreach($requests['category'] as $categoryArray)
														@if($categoryArray == $category->id)
															checked
														@endif
													@endforeach
												@endif
									>
									<span class="checkmark"></span>
								</label> -->
							</li>
							@endforeach
						</ul>
					</div>

					<div class="filter_type border-bottom">
						<h6 class="m-0 pb-3 border-top-0">{{dynamicLang('Price')}}</h6>
						<div class="mb-3">
							<input class="filterType" type="text" id="range" name="rangeId" value="">
						</div>
					</div>

					<div class="filter_type border-bottom">
						<h6 class="m-0 pb-3 border-top-0">{{dynamicLang('Activity')}}</h6>
						<ul class="d-flex flex-wrap">
							@foreach($activities as $index => $activity)
							<li>
								<div class="form-check form-option p-0 me-2"> 
									<input type="checkbox" class="form-check-input filterType" name="activityId" id="act_{{$activity->id}}" value="{{$activity->id}}"
													@if(isset($requests['activity']))
														@foreach($requests['activity'] as $activityArray)
															@if($activityArray == $activity->id)
																checked
															@endif
														@endforeach
													@endif
										>
									<label class="form-option-label container_check" for="act_{{$activity->id}}">{{dynamicLang($activity->name)}}</label>
								</div>


								<!-- <label class="container_check">{{dynamicLang($activity->name)}}
									<input type="checkbox" 
												class="filterType" 
												name="activityId" 
												value="{{$activity->id}}"
												@if(isset($requests['activity']))
													@foreach($requests['activity'] as $activityArray)
														@if($activityArray == $activity->id)
															checked
														@endif
													@endforeach
												@endif
									>
									<span class="checkmark"></span>
								</label> -->
							</li>
							@endforeach
						</ul>
					</div>

					<div class="filter_type d-block d-lg-none">
						<h6 class="m-0 pb-3 border-top-0">{{dynamicLang('Amenity')}}</h6>
						<ul class="d-flex flex-wrap">
							@foreach($amenities as $index => $amenity)
							<li>
								
								<div class="form-check form-option p-0 me-2"> 
									<input type="checkbox" class="form-check-input filterType" name="amenityId" id="ame_{{$amenity->id}}" value="{{$amenity->id}}"
												@if(isset($requests['amenity']))
													@foreach($requests['amenity'] as $amenityArray)
														@if($amenityArray == $amenity->id)
															checked
														@endif
													@endforeach
												@endif
									>
									<label class="form-option-label container_check" for="ame_{{$amenity->id}}">{{dynamicLang($amenity->name)}}</label>
								</div>

								<!-- <label class="container_check">{{dynamicLang($amenity->name)}}
									<input type="checkbox" 
												class="filterType" 
												name="amenityId" 
												value="{{$amenity->id}}"
												@if(isset($requests['amenity']))
													@foreach($requests['amenity'] as $amenityArray)
														@if($amenityArray == $amenity->id)
															checked
														@endif
													@endforeach
												@endif
									>
									<span class="checkmark"></span>
								</label> -->
							</li>
							@endforeach
						</ul>
					</div>
					<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Apply Filter</button> -->
				</form>
			</div>
		</div>
	</div>
</div>

  
@endsection
@section('script') 
<script>
	function autocomplete(inp, arr) {
	  /*the autocomplete function takes two arguments,
	  the text field element and an array of possible autocompleted values:*/
	  var currentFocus;
	  /*execute a function when someone writes in the text field:*/
	  inp.addEventListener("input", function(e) {
	      var a, b, i, val = this.value;
	      /*close any already open lists of autocompleted values*/
	      closeAllLists();
	      if (!val) { return false;}
	      currentFocus = -1;
	      /*create a DIV element that will contain the items (values):*/
	      a = document.createElement("DIV");
	      a.setAttribute("id", this.id + "autocomplete-list");
	      a.setAttribute("class", "autocomplete-items");
	      /*append the DIV element as a child of the autocomplete container:*/
	      this.parentNode.appendChild(a);
	      /*for each item in the array...*/
	      for (i = 0; i < arr.length; i++) {
	        /*check if the item starts with the same letters as the text field value:*/
	        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
	          /*create a DIV element for each matching element:*/
	          b = document.createElement("DIV");
	          /*make the matching letters bold:*/
	          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
	          b.innerHTML += arr[i].substr(val.length);
	          /*insert a input field that will hold the current array item's value:*/
	          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
	          /*execute a function when someone clicks on the item value (DIV element):*/
	          b.addEventListener("click", function(e) {
	              /*insert the value for the autocomplete text field:*/
	              inp.value = this.getElementsByTagName("input")[0].value;
	              /*close the list of autocompleted values,
	              (or any other open lists of autocompleted values:*/
	              closeAllLists();
	          });
	          a.appendChild(b);
	        }
	      }
	  });
	  /*execute a function presses a key on the keyboard:*/
	  inp.addEventListener("keydown", function(e) {
	      var x = document.getElementById(this.id + "autocomplete-list");
	      if (x) x = x.getElementsByTagName("div");
	      if (e.keyCode == 40) {
	        /*If the arrow DOWN key is pressed,
	        increase the currentFocus variable:*/
	        currentFocus++;
	        /*and and make the current item more visible:*/
	        addActive(x);
	      } else if (e.keyCode == 38) { //up
	        /*If the arrow UP key is pressed,
	        decrease the currentFocus variable:*/
	        currentFocus--;
	        /*and and make the current item more visible:*/
	        addActive(x);
	      } else if (e.keyCode == 13) {
	        /*If the ENTER key is pressed, prevent the form from being submitted,*/
	        e.preventDefault();
	        if (currentFocus > -1) {
	          /*and simulate a click on the "active" item:*/
	          if (x) x[currentFocus].click();
	        }
	      }
	  });
	  function addActive(x) {
	    /*a function to classify an item as "active":*/
	    if (!x) return false;
	    /*start by removing the "active" class on all items:*/
	    removeActive(x);
	    if (currentFocus >= x.length) currentFocus = 0;
	    if (currentFocus < 0) currentFocus = (x.length - 1);
	    /*add class "autocomplete-active":*/
	    x[currentFocus].classList.add("autocomplete-active");
	  }
	  function removeActive(x) {
	    /*a function to remove the "active" class from all autocomplete items:*/
	    for (var i = 0; i < x.length; i++) {
	      x[i].classList.remove("autocomplete-active");
	    }
	  }
	  function closeAllLists(elmnt) {
	    /*close all autocomplete lists in the document,
	    except the one passed as an argument:*/
	    var x = document.getElementsByClassName("autocomplete-items");
	    for (var i = 0; i < x.length; i++) {
	      if (elmnt != x[i] && elmnt != inp) {
	        x[i].parentNode.removeChild(x[i]);
	      }
	    }
	  }
	  /*execute a function when someone clicks in the document:*/
	  document.addEventListener("click", function (e) {
	      closeAllLists(e.target);
	  });
	}

	/*An array containing all the country names in the world:*/
	var countries = <?php echo $suggestions; ?>;

	/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
	autocomplete(document.getElementById("myInput"), countries);
</script>
@if(isset($requests['range']))
<script>
	 $("#range").ionRangeSlider({
        hide_min_max: true,
        keyboard: true,
        min: 10,
        max: 2000,
        from: <?php $rangeJs = explode(';',$requests['range']); echo $rangeJs[0]??10; ?>,
        to: <?php $rangeJs = explode(';',$requests['range']); echo $rangeJs[1]??1000; ?>,
        type: 'double',
        step: 1,
        prefix: "Min. ",
        grid: false
    });
</script>
@else
<script>
	 $("#range").ionRangeSlider({
        hide_min_max: true,
        keyboard: true,
        min: 10,
        max: 2000,
        from: 10,
        to: 1000,
        type: 'double',
        step: 1,
        prefix: "Min. ",
        grid: false
    });
</script>
@endif



@if($searchType == 'city')
<!-- City | AJAX call -->
<script>
	$( document ).ready(function() {
		$('.searchType').click(function() {
			// var url = <?php echo $api_url; ?>;
			var url = 'https://getbeds.starklikes.com';

			var amenity = [];
			$.each($("input[name='amenityId']:checked"), function(){
		    amenity.push($(this).attr('id'));
		  });
		  var amenitySize = amenity.length;
		  amenityId = amenity.join(",");

			if(amenitySize > 0){
				$.ajax({
		        type: 'GET',
		        url: url+'/search/city/'+{{$id}}+'/'+amenityId,
		        success:function(data){
		        	$('.isotope-item').hide();
		        	$('.list-group').remove();

		        	if(data.packages.length == 0){
		        		$(".packages-grid").append(
				          '<div class="col list-group mt-4"><ul><li>No Tours Found</li></ul></div>'
				        );
		        	}else{
		        		$.each(data.packages, function(r){
				        	var avatar = url + '/' +data.packages[r].avatar;
				        	var slug = url + '/tours/' +data.packages[r].slug;
				        	var wishlistAdd = url + '/wishlist/add/' +data.packages[r].id;
				        	var wishlistRemove = url + '/wishlist/remove/' +data.packages[r].id;

				        	$(".packages-grid").append(
					          '<div class="col list-group">' +
					          	'<div class="box_grid">' +
					          		(data.packages[r].combo == 1 ? '<div class="ribbon"><span>Combo</span></div>': '') +
					          		'<figure>' +
					          			(data.packages[r].seal == 1 ? '<img class="trust-badges" src="{{asset("images/trust-badge.png")}}" width="40px" />': '') +

					          			(data.packages[r].wishlist == 'not_added' ? '<a href="'+wishlistAdd+'" class="wish_bt"></a>': '<a href="'+wishlistRemove+'" class="wish_bt liked"></a>') +

					          			'<a href="'+ slug +'">' +
														'<img src="'+ avatar +'" class="img-fluid" />' + 
													'</a>' +
					          		'</figure>' +

					          		'<div class="wrapper">' +
					          			'<badge class="category-names text-white bg-black py-1 px-2 rounded">'+ data.packages[r].category.name +'</badge>' +
					          			'<h3><a href="'+slug+'">'+ data.packages[r].name +'</a></h3>' +
					          			(data.packages[r].rating > 0 ? '<div class="d-flex align-items-center"><div class="rating"><i class="fas fa-star"></i><i class="me-2 fs-6">'+data.packages[r].rating+'</i></div><div>('+data.packages[r].reviews_count+' Reviews)</div></div>': '') +
					          		'</div>' +

					          		'<ul class="d-flex justify-content-between align-items-center"> ' +
													'<li>' +
														'<span><b>From: </b><small>'+data.packages[r].currency_symbol+'<del><b>'+data.packages[r].adult_price +'</b></del></small> '+ data.packages[r].new_price+'<small>/person</small></span>' +
													'</li>' +
												'</ul>' +			
					          	'</div>' +
					          '</div>'
					        );
						    });
		        	}
		        },
		       error: function(err) {
		        console.log(err);
		      }
		    });
			} else {
				$('.list-group').remove();
				$('.isotope-item').show();
			}
		});
	});
</script>
<!-- filter | Modal -->
<script>
	$( document ).ready(function() {
		$('.filterType').change(function() {
			// var url = <?php echo $api_url; ?>;
			var url = 'https://getbeds.starklikes.com';

			// category
			var category = [];
			$.each($("input[name='categoryId']:checked"), function(){
		    category.push($(this).attr('value'));
		  });
		  var categorySize = category.length;
		  categoryId = category.join(",");

		  // activityId
		  var activity = [];
			$.each($("input[name='activityId']:checked"), function(){
		    activity.push($(this).attr('value'));
		  });
		  var activitySize = activity.length;
		  activityId = activity.join(",");

		  // amenityId
		  var amenity = [];
			$.each($("input[name='amenityId']:checked"), function(){
		    amenity.push($(this).attr('value'));
		  });
		  var amenitySize = amenity.length;
		  amenityId = amenity.join(",");

		  // rangeId
		  var range = document.getElementById("range").value;

		  if(categorySize > 0 || activitySize > 0 || amenitySize > 0 || range){
				$.ajax({
		        type: 'POST',
		        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		        url: url+'/search/location/city/'+{{$id}},
		        data: {'category':categoryId,'range':range,'activity':activityId,'amenity':amenityId},
		        dataType: "json",
		        success:function(data){
		        	$('.isotope-item').hide();
		        	$('.list-group').remove();

		        	if(data.packages.length == 0){
		        		$(".packages-grid").append(
				          '<div class="col list-group mt-4"><ul><li>No Tours Found</li></ul></div>'
				        );
		        	}else{
				        $.each(data.packages, function(r){
				        	var avatar = url + '/' +data.packages[r].avatar;
				        	var slug = url + '/tours/' +data.packages[r].slug;
				        	var wishlistAdd = url + '/wishlist/add/' +data.packages[r].id;
				        	var wishlistRemove = url + '/wishlist/remove/' +data.packages[r].id;

				        	$(".packages-grid").append(
					          '<div class="col list-group">' +
					          	'<div class="box_grid">' +
					          		(data.packages[r].combo == 1 ? '<div class="ribbon"><span>Combo</span></div>': '') +
					          		'<figure>' +
					          			(data.packages[r].seal == 1 ? '<img class="trust-badges" src="{{asset("images/trust-badge.png")}}" width="40px" />': '') +

					          			(data.packages[r].wishlist == 'not_added' ? '<a href="'+wishlistAdd+'" class="wish_bt"></a>': '<a href="'+wishlistRemove+'" class="wish_bt liked"></a>') +

					          			'<a href="'+ slug +'">' +
														'<img src="'+ avatar +'" class="img-fluid" />' + 
													'</a>' +
					          		'</figure>' +

					          		'<div class="wrapper">' +
					          			'<badge class="category-names text-white bg-black py-1 px-2 rounded">'+ data.packages[r].category.name +'</badge>' +
					          			'<h3><a href="'+slug+'">'+ data.packages[r].name +'</a></h3>' +
					          			(data.packages[r].rating > 0 ? '<div class="d-flex align-items-center"><div class="rating"><i class="fas fa-star"></i><i class="me-2 fs-6">'+data.packages[r].rating+'</i></div><div>('+data.packages[r].reviews_count+' Reviews)</div></div>': '') +
					          		'</div>' +

					          		'<ul class="d-flex justify-content-between align-items-center"> ' +
													'<li>' +
														'<span><b>From: </b><small>'+data.packages[r].currency_symbol+'<del><b>'+data.packages[r].adult_price +'</b></del></small> '+ data.packages[r].new_price+'<small>/person</small></span>' +
													'</li>' +
												'</ul>' +			
					          	'</div>' +
					          '</div>'
					        );
						    });
		        	}
		        },
		       error: function(err) {
		        console.log(err);
		      }
		    });
			} else {
				$('.list-group').remove();
				$('.isotope-item').show();
			}
		});
	});
</script>
@else
<!-- Country | AJAX call -->
<script>
	$( document ).ready(function() {
		$('.searchType').click(function() {
			// var url = <?php echo $api_url; ?>;
			var url = 'https://getbeds.starklikes.com';

			var amenity = [];
			$.each($("input[name='amenityId']:checked"), function(){
		    amenity.push($(this).attr('id'));
		  });
		  var amenitySize = amenity.length;
		  amenityId = amenity.join(",");

			if(amenitySize > 0){
				$.ajax({
		        type: 'GET',
		        url: url+'/search/country/'+{{$id}}+'/'+amenityId,
		        success:function(data){
		        	$('.isotope-item').hide();
		        	$('.list-group').remove();

		        	if(data.packages.length == 0){
		        		$(".packages-grid").append(
				          '<div class="col list-group mt-4"><ul><li>No Tours Found</li></ul></div>'
				        );
		        	}else{
				        $.each(data.packages, function(r){
				        	var avatar = url + '/' +data.packages[r].avatar;
				        	var slug = url + '/tours/' +data.packages[r].slug;
				        	var wishlistAdd = url + '/wishlist/add/' +data.packages[r].id;
				        	var wishlistRemove = url + '/wishlist/remove/' +data.packages[r].id;

				        	$(".packages-grid").append(
					          '<div class="col list-group">' +
					          	'<div class="box_grid">' +
					          		(data.packages[r].combo == 1 ? '<div class="ribbon"><span>Combo</span></div>': '') +
					          		'<figure>' +
					          			(data.packages[r].seal == 1 ? '<img class="trust-badges" src="{{asset("images/trust-badge.png")}}" width="40px" />': '') +

					          			(data.packages[r].wishlist == 'not_added' ? '<a href="'+wishlistAdd+'" class="wish_bt"></a>': '<a href="'+wishlistRemove+'" class="wish_bt liked"></a>') +

					          			'<a href="'+ slug +'">' +
														'<img src="'+ avatar +'" class="img-fluid" />' + 
													'</a>' +
					          		'</figure>' +

					          		'<div class="wrapper">' +
					          			'<badge class="category-names text-white bg-black py-1 px-2 rounded">'+ data.packages[r].category.name +'</badge>' +
					          			'<h3><a href="'+slug+'">'+ data.packages[r].name +'</a></h3>' +
					          			(data.packages[r].rating > 0 ? '<div class="d-flex align-items-center"><div class="rating"><i class="fas fa-star"></i><i class="me-2 fs-6">'+data.packages[r].rating+'</i></div><div>('+data.packages[r].reviews_count+' Reviews)</div></div>': '') +
					          		'</div>' +

					          		'<ul class="d-flex justify-content-between align-items-center"> ' +
													'<li>' +
														'<span><b>From: </b><small>'+data.packages[r].currency_symbol+'<del><b>'+data.packages[r].adult_price +'</b></del></small> '+ data.packages[r].new_price+'<small>/person</small></span>' +
													'</li>' +
												'</ul>' +			
					          	'</div>' +
					          '</div>'
					        );
						    });
		        	}
		        },
		       error: function(err) {
		        console.log(err);
		      }
		    });
			} else {
				$('.list-group').remove();
				$('.isotope-item').show();
			}
		});
	});
</script>
<!-- filter | Modal -->
<script>
	$( document ).ready(function() {
		$('.filterType').change(function() {
			// var url = <?php echo $api_url; ?>;
			var url = 'https://getbeds.starklikes.com';

			// category
			var category = [];
			$.each($("input[name='categoryId']:checked"), function(){
		    category.push($(this).attr('value'));
		  });
		  var categorySize = category.length;
		  categoryId = category.join(",");

		  // activityId
		  var activity = [];
			$.each($("input[name='activityId']:checked"), function(){
		    activity.push($(this).attr('value'));
		  });
		  var activitySize = activity.length;
		  activityId = activity.join(",");

		  // amenityId
		  var amenity = [];
			$.each($("input[name='amenityId']:checked"), function(){
		    amenity.push($(this).attr('value'));
		  });
		  var amenitySize = amenity.length;
		  amenityId = amenity.join(",");

		  // rangeId
		  var range = document.getElementById("range").value;

		  if(categorySize > 0 || activitySize > 0 || amenitySize > 0 || range){
				$.ajax({
		        type: 'POST',
		        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		        url: url+'/search/location/country/'+{{$id}},
		        data: {'category':categoryId,'range':range,'activity':activityId,'amenity':amenityId},
		        dataType: "json",
		        success:function(data){
		        	$('.isotope-item').hide();
		        	$('.list-group').remove();

		        	if(data.packages.length == 0){
		        		$(".packages-grid").append(
				          '<div class="col list-group mt-4"><ul><li>No Tours Found</li></ul></div>'
				        );
		        	}else{
				        $.each(data.packages, function(r){
				        	var avatar = url + '/' +data.packages[r].avatar;
				        	var slug = url + '/tours/' +data.packages[r].slug;
				        	var wishlistAdd = url + '/wishlist/add/' +data.packages[r].id;
				        	var wishlistRemove = url + '/wishlist/remove/' +data.packages[r].id;

				        	$(".packages-grid").append(
					          '<div class="col list-group">' +
					          	'<div class="box_grid">' +
					          		(data.packages[r].combo == 1 ? '<div class="ribbon"><span>Combo</span></div>': '') +
					          		'<figure>' +
					          			(data.packages[r].seal == 1 ? '<img class="trust-badges" src="{{asset("images/trust-badge.png")}}" width="40px" />': '') +

					          			(data.packages[r].wishlist == 'not_added' ? '<a href="'+wishlistAdd+'" class="wish_bt"></a>': '<a href="'+wishlistRemove+'" class="wish_bt liked"></a>') +

					          			'<a href="'+ slug +'">' +
														'<img src="'+ avatar +'" class="img-fluid" />' + 
													'</a>' +
					          		'</figure>' +

					          		'<div class="wrapper">' +
					          			'<badge class="category-names text-white bg-black py-1 px-2 rounded">'+ data.packages[r].category.name +'</badge>' +
					          			'<h3><a href="'+slug+'">'+ data.packages[r].name +'</a></h3>' +
					          			(data.packages[r].rating > 0 ? '<div class="d-flex align-items-center"><div class="rating"><i class="fas fa-star"></i><i class="me-2 fs-6">'+data.packages[r].rating+'</i></div><div>('+data.packages[r].reviews_count+' Reviews)</div></div>': '') +
					          		'</div>' +

					          		'<ul class="d-flex justify-content-between align-items-center"> ' +
													'<li>' +
														'<span><b>From: </b><small>'+data.packages[r].currency_symbol+'<del><b>'+data.packages[r].adult_price +'</b></del></small> '+ data.packages[r].new_price+'<small>/person</small></span>' +
													'</li>' +
												'</ul>' +			
					          	'</div>' +
					          '</div>'
					        );
						    });
		        	}
		        },
		       error: function(err) {
		        console.log(err);
		      }
		    });
			} else {
				$('.list-group').remove();
				$('.isotope-item').show();
			}
		});
	});
</script>
@endif
@endsection
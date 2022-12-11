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
use App\Models\Country;

$tours = Package::whereStatus(1)->get();
$cities = City::all();
$activities = Activity::whereStatus(1)->get();
$amenities = Amenity::whereStatus(1)->get();
$categories = Category::whereStatus(1)->get();
$countries = Country::whereStatus(1)->pluck('name')->toArray();
$searchCity = City::pluck('name')->toArray();
$suggestions = json_encode(array_merge($countries, $searchCity));

@endphp

@section('content') 
	<main>   
		<section class="hero_in tours" style="background: url({{asset('images/pattern_1.svg')}});" >
			<div class="wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-8">
							<div class="autocomplete">
								<form action="{{route('search')}}" method="POST" class="row g-0 custom-search-input-2">
	                            	@csrf
									<div class="col-lg-10">
										<div class="form-group">
											<input id="myInput" class="form-control" type="text" name="search" placeholder="{{dynamicLang('Where are you going?')}}" required />
											<i class="icon_pin_alt"></i>
										</div>
									</div> 
									<div class="col-lg-2">
										<input type="submit" class="btn_search" value="{{dynamicLang('Search')}}">
									</div>
								</form>
							</div> 
						</div>
					</div>
					<h1 class="my-4">{{dynamicLang('Tours Page')}}</h1>
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
							<a data-bs-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">{{dynamicLang('Filters')}} </a>
							<div class="collapse show" id="collapseFilters">

								<div class="filter_type">
									<h6>{{dynamicLang('Destinations')}}</h6>
									<ul>
										@foreach($cities as $city)
										<li>
											<label class="container_check">{{dynamicLang($city->name)}} <large>, {{dynamicLang($city->country->name)}}</large>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										@endforeach
									</ul>
								</div>

								<div class="filter_type">
									<h6>{{dynamicLang('Price')}}</h6>
									<input type="text" id="range" name="range" value="">
								</div>

								<div class="filter_type">
									<h6>{{dynamicLang('Category')}}</h6>
									<ul>
										@foreach($categories as $category)
										<li>
											<label class="container_check">{{dynamicLang($category->name)}}
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										@endforeach
									</ul>
								</div>

								<div class="filter_type">
									<h6>{{dynamicLang('Activity')}}</h6>
									<ul>
										@foreach($activities as $activity)
										<li>
											<label class="container_check">{{dynamicLang($activity->name)}}
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										@endforeach
									</ul>
								</div>

								<div class="filter_type">
									<h6>{{dynamicLang('Amenity')}}</h6>
									<ul>
										@foreach($amenities as $amenity)
										<li>
											<label class="container_check">{{dynamicLang($amenity->name)}}
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										@endforeach
									</ul>
								</div>

								<div class="filter_type">
									<h6>{{dynamicLang('Rating')}}</h6>
									<ul>
										<li>
											<label class="container_check">{{dynamicLang('Superb')}} 9+ <small>(25)</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">{{dynamicLang('Very Good')}} 8+ <small>(26)</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">{{dynamicLang('Good')}} 7+ <small>(25)</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">{{dynamicLang('Pleasant')}} 6+ <small>(12)</small>
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
												<a href="{{route('wishlist.add', $tour->id)}}" class="wish_bt"></a>
												<a href="{{route('tour.show', $tour->slug)}}">
													<img src="{{asset($tour->avatar)}}" class="img-fluid" alt="" /> 
												</a> 
											</figure>
											<div class="wrapper">
												<h3><a href="{{route('tour.show', $tour->slug)}}">{{dynamicLang($tour->name)}}</a></h3> 
												@if($tour->rating > 0)
					                            <div class="d-flex align-items-center">
					                                <div class="rating">
					                                    @foreach(range(1, $tour->rating) as $index)
					                                    <i class="fas fa-star"></i>
					                                    @endforeach
					                                </div> 
					                                <a href="#">({{$tour->reviews->count()}})</a>
					                            </div> 
					                            @endif
											</div> 
											<ul class="d-flex justify-content-between align-items-center"> 
												<!-- <li><i class="icon_clock_alt"></i> 18:30 - 21:30</li> --> 
												<li>
													<span><b>{{dynamicLang('Price')}}: </b><small>
					                                    <!-- <del><b>₹314.31</b></del> -->
					                                </small> 
					                                {{Session::get('currency_symbol')??'₹'}} {{switchCurrency($tour->adult_price)}}</b><small>/{{dynamicLang('person')}}</small></span>
												</li> 
											</ul>
										</div>
									</div>
									@endforeach
								@endif
							</div> 
						</div> 
					</div>
				</div> 
			
				<p class="text-center"><a href="#0" id="loadMore" class="btn_1 rounded add_top_30">{{dynamicLang('Load more')}}</a></p>
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
@endsection
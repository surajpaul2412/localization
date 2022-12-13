@extends('layouts.frontend.app')

@section('title')
<title>GetBeds</title>
@endsection

@section('css')
<style></style>
@endsection

@php
use App\Models\Amenity;
use App\Models\Package;
use App\Models\City;
use App\Models\Category;
use App\Models\Country;

$amenities = Amenity::inRandomOrder()->whereStatus(1)->get();
$tours = Package::inRandomOrder()->whereStatus(1)->get();
$cities = City::inRandomOrder()->get();
$categories = Category::whereStatus(1)->get();
$countries = Country::whereStatus(1)->pluck('name')->toArray();
$searchCity = City::pluck('name')->toArray();
$suggestions = json_encode(array_merge($countries, $searchCity));

@endphp

@section('content')  
<main>

    <!-- Background YouTube Parallax -->
    <div class="hero_single hero_single_videos jarallax" data-jarallax-video="mp4:{{asset('video/banner-short.mp4')}}">
       <div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <p>{{dynamicLang('Explore Thailand & Southeast Asia with')}}</p>
                <h1>{{dynamicLang('Local Experts')}}</h1> 
                <div class="image-icon">
                    <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/home/tripadvisor/2018-tripadvisor.png" />
                    <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/home/tripadvisor/2019-tripadvisor.png" />
                </div>
                
            </div>
        </div>
        <!-- <div class="hero-search-form">
            <div class="container">
                <div class="row justify-content-center">
                    
                    <div class="col-lg-8">
                        <form action="{{route('search')}}" method="POST" class="row g-0 custom-search-input-2">
                            @csrf
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="search" placeholder="Where are you going?" required />
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
        </div> -->
    </div>
    <!-- /Background YouTube Parallax -->

    <div class="advance-seach-box">
        <div class="container">
            <div class="row justify-content-center">  
                <div class="col-md-8">
                    <div class="advance-seach-box-inner">
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
                                    <input type="submit" class="btn_search" value="Search">
                                </div> 
                            </form>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
    </div>

    <section class="section-sm get-inspired bg-white">
        <div class="container">
            <div class="main_title_3 d-flex justify-content-between align-items-center">
                <div> 
                    <span><em></em></span>
                    <h2>{{dynamicLang('Get Inspired')}}</h2> 
                </div>  
            </div>
            <div class="slick-get-inspired">
                @foreach($categories as $category)
                <div class="item"> 
                    <a href="{{route('search.category',$category->id)}}" class="box-item relative"> 
                        <figure> 
                            <img src="{{asset($category->avatar)}}" class="img-fluid" alt="" /> 
                        </figure>
                        <div class="box-icon text-center">
                            <img src="{{asset($category->icon)}}" class="img-fluid" /> 
                        </div>
                    </a>
                </div>
                @endforeach  
            </div> 
        </div>
    </section> 
    <!-- /Get Inspired --> 

    <section class="section-sm popular-destinations bg-white">
        <div class="container">
            <div class="main_title_3 d-flex justify-content-between align-items-center">
                <div> 
                    <span><em></em></span>
                    <h2>{{dynamicLang('Popular Activities')}}</h2>
                </div> 
                <!-- <a href="#0"><strong>View all (57) <i class="arrow_carrot-right"></i></strong></a>  -->
            </div> 
            
            <div class="slick-slider">
                @foreach($tours as $tour)
                <div class="item"> 
                    <div class="box_grid">
                        <figure>
                            <a href="{{route('wishlist.add',$tour->id)}}" class="wish_bt"></a>
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
                            <li>
                                <span><b>{{dynamicLang('Price')}}: </b>
                                {{Session::get('currency_symbol')??'₹'}} {{switchCurrency($tour->adult_price)}}<small>/{{dynamicLang('person')}}</small>
                                </span>
                            </li> 
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>  

        </div>
    </section> 
    <!-- /Tours Available Tomorrow -->  
    @include('layouts.frontend.partials.ads')
    
    <section class="section-sm travel-products bg-white">
        <div class="container">
            <div class="main_title_3 d-flex justify-content-between align-items-center">
                <div> 
                    <span><em></em></span>
                    <h2>{{dynamicLang('Travel Products')}}</h2> 
                </div>  
            </div>
            
            <div class="slick-travel-product">
                @foreach($amenities as $amenity)
                <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="{{$amenity->icon}}" alt="{{$amenity->name}}" />
                        <p>{{dynamicLang($amenity->name)}}</p>
                    </a> 
                </div>
                @endforeach
                <!-- /item -->    
            </div>  
        </div>
    </section> 
    <!-- /Travel Products -->   
    
    <section class="section-sm popular-destinations bg-white">
        <div class="container">
            <div class="main_title_3 d-flex justify-content-between align-items-center">
                <div> 
                    <span><em></em></span>
                    <h2>{{dynamicLang('Popular Destinations')}}</h2> 
                </div> 
                <!-- <a href="#0"><strong>View all (57) <i class="arrow_carrot-right"></i></strong></a>  -->
            </div>
            
            <div class="slick-popular-destination">
                @foreach($cities as $city)
                <div class="item"> 
                    <a href="{{route('search.city',$city->id)}}" class="grid_item relative">
                        <!-- <div class="ribbon">
                            <span>Popular</span>
                        </div> -->
                        <figure> 
                            <img src="{{asset($city->avatar)}}" class="img-fluid" alt="{{$city->name}}" />
                            <div class="info"> 
                                <h3>{{dynamicLang($city->name)}}, {{dynamicLang($city->country->name)}}</h3>
                            </div>
                        </figure>
                    </a> 
                </div>
                @endforeach
            </div>  
        </div>
    </section> 
    <!-- /Popular Destinations -->    
    
    @include('layouts.frontend.partials.testimonials')  
</main>
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
@endsection

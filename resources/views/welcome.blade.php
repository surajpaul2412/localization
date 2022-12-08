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

$amenities = Amenity::inRandomOrder()->whereStatus(1)->get();
$tours = Package::inRandomOrder()->whereStatus(1)->get();
$cities = City::inRandomOrder()->get();
$categories = Category::whereStatus(1)->get();
@endphp

@section('content')
<main>
    
    <!-- Background YouTube Parallax -->
    <div class="hero_single hero_single_videos jarallax" data-jarallax-video="mp4:{{asset('video/banner-short.mp4')}}">
       <div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <p>Explore Thailand & Southeast Asia with</p>
                <h1>Local Experts</h1> 
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
                                        <input id="myInput" class="form-control" type="text" name="search" placeholder="Where are you going?" required />
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
                    <h2>Get Inspired</h2> 
                </div>  
            </div>
            <div id="get-inspired" class="owl-carousel owl-theme">
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
                    <h2>Popular Activities</h2> 
                </div> 
                <!-- <a href="#0"><strong>View all (57) <i class="arrow_carrot-right"></i></strong></a>  -->
            </div> 
            
            <div id="popular-activities" class="owl-carousel owl-theme">
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
                            <h3><a href="{{route('tour.show', $tour->slug)}}">{{$tour->name}}</a></h3>
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
                                <span><b>Price: </b><small>
                                    <!-- <del><b>₹314.31</b></del> -->
                                </small> 
                                ₹{{$tour->adult_price}}</b><small>/person</small></span>
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
                    <h2>Travel Products</h2> 
                </div>  
            </div>
            
            <div id="travel-products" class="owl-carousel owl-theme">
                @foreach($amenities as $amenity)
                <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="{{$amenity->icon}}" alt="{{$amenity->name}}" />
                        <p>{{$amenity->name}}</p>
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
                    <h2>Popular Destinations</h2> 
                </div> 
                <!-- <a href="#0"><strong>View all (57) <i class="arrow_carrot-right"></i></strong></a>  -->
            </div>
            
            <div id="popular-destinations" class="owl-carousel owl-theme">
                @foreach($cities as $city)
                <div class="item"> 
                    <a href="{{route('search.city',$city->id)}}" class="grid_item relative">
                        <!-- <div class="ribbon">
                            <span>Popular</span>
                        </div> -->
                        <figure> 
                            <img src="{{asset($city->avatar)}}" class="img-fluid" alt="{{$city->name}}" />
                            <div class="info"> 
                                <h3>{{$city->name}}, {{$city->country->name}}</h3>
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
var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>
@endsection

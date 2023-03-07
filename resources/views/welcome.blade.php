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
use App\Models\Banner;

$amenities = Amenity::inRandomOrder()->whereStatus(1)->get();
$tours = Package::inRandomOrder()->whereStatus(1)->get();
$cities = City::take(10)->orderBy('seal','DESC')->get();
$categories = Category::whereStatus(1)->get();
$countries = Country::whereStatus(1)->pluck('name')->toArray();
$searchCity = City::pluck('name')->toArray();
$suggestions = json_encode(array_merge($countries, $searchCity));
$combos = Package::whereCombo(1)->get();
$banners = Banner::whereStatus(1)->get();

@endphp

@section('content')  
<main>

    <!-- Background YouTube Parallax -->
    <div class="hero_single hero_single_videos jarallax d-none" data-jarallax-video="mp4:{{asset('video/banner-short.mp4')}}">
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
    </div>
     
    <!-- Home Slider Section  -->
    <section class="home-slider">
        <div class="hero-slider"> 
            @if($banners->count())
            @foreach($banners as $banner)
            <div class="item p-0"> 
                <div class="slide-item position-relative"> 
                    <img src="{{asset($banner->image)}}" class="img-fluid desktop-view d-none d-lg-block" alt="{{$banner->heading}}" />  
                    <img src="{{asset($banner->mobile)}}" class="img-fluid mobile-view d-block d-lg-none" alt="{{$banner->heading}}" />  
                    <div class="slide-text">
                        <div class="container">
                            <h1 class="mb-0">{{dynamicLang($banner->heading)}}</h1>
                            <p>{{dynamicLang($banner->content)}}</p>
                        </div>    
                    </div> 
                </div>
            </div> 
            @endforeach
            @endif 
        </div> 
    </section>

    <!-- Search area -->
    <div class="advance-seach-box">
        <div class="container">
            <div class="row justify-content-start">  
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
                    <h2>{{dynamicLang('Get Combos')}}</h2> 
                </div>  
            </div>
            <!-- <div class="slick-get-inspired">
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
            </div>  -->
            <div class="slick-slider">
                @foreach($combos as $tour)
                <div class="item">
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
                            <a href="{{route('wishlist.add',$tour->id)}}" class="wish_bt"></a>
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
            </div> 
        </div>
    </section> 
    <!-- /Get Inspired -->
    
    <section class="section-sm why-choose-us">
        <div class="container">
            <div class="main_title_3 d-flex justify-content-between align-items-center">
                <div> 
                    <span><em></em></span>
                    <h2>Why choose GetBeds</h2> 
                </div>  
            </div>  
            
            <div class="row row-cols-2 row-cols-lg-4">
                <div class="col">
                    <div class="why-choose-box mb-3">
                        <figure> 
                            <img src="{{asset('images/why-choose/1.png')}}" width="64px" class="img-fluid" alt="" />  
                        </figure>    
                        <div class="info"> 
                            <h5>Discover the possibilities</h5>
                            <p>With nearly half a million attractions, hotels & more, you're sure to find joy.</p>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="why-choose-box mb-3">
                        <figure> 
                            <img src="{{asset('images/why-choose/2.png')}}" width="64px" class="img-fluid" alt="" />  
                        </figure>    
                        <div class="info"> 
                            <h5>Enjoy deals & delights</h5>
                            <p>Quality activities. Great prices. Plus, earn Klook credits to save more.</p>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="why-choose-box mb-3">
                        <figure> 
                            <img src="{{asset('images/why-choose/3.png')}}" width="64px" class="img-fluid" alt="" />  
                        </figure>    
                        <div class="info"> 
                            <h5>Exploring made easy</h5>
                            <p>Book last minute, skip lines & get free cancellation for easier exploring.</p>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="why-choose-box mb-3">
                        <figure> 
                            <img src="{{asset('images/why-choose/4.png')}}" width="64px" class="img-fluid" alt="" />  
                        </figure>    
                        <div class="info"> 
                            <h5>Travel you can trust</h5>
                            <p>Read reviews & get reliable customer support. We're with you at every step.</p>
                        </div>
                    </div>
                </div> 
            </div> 
            
        </div>
    </section> 
    <!-- /Why Choose Us --> 


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
                        @if($tour->combo == 1)
                        <div class="ribbon">
                            <span>Combo</span>
                        </div>
                        @endif
                        <figure>
                            @if($tour->seal == 1)
                            <img class="trust-badges" src="{{asset('images/trust-badge.png')}}" width="40px" />
                            @endif
                            <a href="{{route('wishlist.add',$tour->id)}}" class="wish_bt"></a>
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
                    <a href="{{route('search.amenity',$amenity->id)}}" class="box-item style-2"> 
                        <img src="{{asset($amenity->icon)}}" alt="{{$amenity->name}}" />
                        <p>{{dynamicLang(\Illuminate\Support\Str::limit($amenity->name ?? '',35,' ...'))}}</p>
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
                        @if($city->seal == 1)
                        <div class="ribbon">
                            <span>Popular</span>
                        </div>
                        @endif
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

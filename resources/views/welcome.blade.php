@extends('layouts.frontend.app')

@section('title')
<title>Home | GetBeds</title>
@endsection

@section('css')
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
        <div class="hero-search-form">
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
        </div>
    </div>
    <!-- /Background YouTube Parallax -->

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
                            <a href="{{route('tour.show', $tour->slug)}}" class="wish_bt"></a>
                            <a href="{{route('tour.show', $tour->slug)}}">
                                <img src="{{asset($tour->avatar)}}" class="img-fluid" alt="" /> 
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
                            <li>
                                <span><b>Price: </b><small>
                                    <!-- <del><b>$314.31</b></del> -->
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
@endsection

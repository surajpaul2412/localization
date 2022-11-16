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

$amenities = Amenity::inRandomOrder()->whereStatus(1)->get();
$tours = Package::inRandomOrder()->whereStatus(1)->get();
$cities = City::inRandomOrder()->get();
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
                                    <input class="form-control" type="text" name="search" placeholder="Where are you going?">
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
                <div class="item"> 
                    <a href="#0" class="box-item relative"> 
                        <figure> 
                            <img src="{{asset('images/get-inspired/1.jpg')}}" class="img-fluid" alt="" /> 
                        </figure> 
                    </a>
                </div>
                <!-- /item -->  

                <div class="item"> 
                    <a href="#0" class="box-item relative"> 
                        <figure> 
                            <img src="{{asset('images/get-inspired/2.jpg')}}" class="img-fluid" alt="" /> 
                        </figure>
                        <div class="box-icon text-center">
                            <img src="https://d2d3n9ufwugv3m.cloudfront.net/w400-h300-cfill-75/topics/hubL2-title.png" class="img-fluid" /> 
                        </div>
                    </a>
                </div>
                <!-- /item --> 

                <div class="item">
                    <a href="#0" class="box-item relative"> 
                        <figure> 
                            <img src="{{asset('images/get-inspired/3.jpg')}}" class="img-fluid" alt="" /> 
                        </figure>
                        <div class="box-icon text-center">
                            <img src="https://d2d3n9ufwugv3m.cloudfront.net/w400-h300-cfill-75/topics/Ey55T-Cover_Homepage-07.png" class="img-fluid" /> 
                        </div>
                    </a> 
                </div>
                <!-- /item --> 

                <div class="item"> 
                    <a href="#0" class="box-item relative"> 
                        <figure> 
                            <img src="{{asset('images/get-inspired/4.jpg')}}" class="img-fluid" alt="" /> 
                        </figure>
                        <div class="box-icon text-center">
                            <img src="https://d2d3n9ufwugv3m.cloudfront.net/w400-h300-cfill-75/topics/8F2DW-Cover_Homepage-08.png" class="img-fluid" /> 
                        </div>
                    </a>
                </div>
                <!-- /item --> 

                <div class="item">
                    <a href="#0" class="box-item relative"> 
                        <figure> 
                            <img src="{{asset('images/get-inspired/5.jpg')}}" class="img-fluid" alt="" /> 
                        </figure>
                        <div class="box-icon text-center">
                            <img src="https://d2d3n9ufwugv3m.cloudfront.net/w400-h300-cfill-75/topics/p2KH3-Cover_Homepage-11.png" class="img-fluid" /> 
                        </div>
                    </a> 
                </div>
                <!-- /item --> 

                <div class="item">
                    <a href="#0" class="box-item relative"> 
                        <figure> 
                            <img src="{{asset('images/get-inspired/6.jpg')}}" class="img-fluid" alt="" /> 
                        </figure>
                        <div class="box-icon text-center">
                            <img src="https://d2d3n9ufwugv3m.cloudfront.net/w400-h300-cfill-75/topics/kXHYF-Cover_Homepage-12.png" class="img-fluid" /> 
                        </div>
                    </a> 
                </div>
                <!-- /item -->  
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

                <div class="item"> 
                    <div class="box_grid">
                        <figure>
                            <a href="tour-details.php" class="wish_bt"></a>
                            <a href="#0">
                                <img src="{{asset('images/destination/1.jpg')}}" class="img-fluid" alt="" /> 
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
                <!-- /item -->

                <div class="item"> 
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
                <!-- /item --> 
                
                <div class="item"> 
                    <div class="box_grid">
                        <figure>
                            <a href="#0" class="wish_bt"></a>
                            <a href="tour-details.php">
                                <img src="{{asset('images/destination/3.jpg')}}" class="img-fluid" alt="" /> 
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
                <!-- /item --> 
                
                <div class="item"> 
                    <div class="box_grid">
                        <figure>
                            <a href="#0" class="wish_bt"></a>
                            <a href="tour-details.php">
                                <img src="{{asset('images/destination/4.jpg')}}" class="img-fluid" alt="" /> 
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
                <!-- /item --> 
                
                <div class="item"> 
                    <div class="box_grid">
                        <figure>
                            <a href="#0" class="wish_bt"></a>
                            <a href="tour-details.php">
                                <img src="{{asset('images/destination/5.jpg')}}" class="img-fluid" alt="" /> 
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
                <!-- /item -->          

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
                <!-- <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/icon/travel-product/hop-on-hop-off.svg" alt="" />
                        <p>Hop-on Hop-off Bus Tour</p>
                    </a> 
                </div> -->
                <!-- /item -->    
                <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/icon/travel-product/ticket.svg" alt="" />
                        <p>Attraction Ticket</p>
                    </a> 
                </div>
                <!-- /item -->    
                <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/icon/travel-product/fast-track.svg" alt="" />
                        <p>Airport Fast-Track</p>
                    </a> 
                </div>
                <!-- /item -->    
                <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/icon/travel-product/car-rental.svg" alt="" />
                        <p>Private Transfers</p>
                    </a> 
                </div>
                <!-- /item -->    
                <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/icon/travel-product/luggage.svg" alt="" />
                        <p>Luggage Delivery</p>
                    </a> 
                </div>
                <!-- /item -->    
                <!-- <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/icon/travel-product/spa.svg" alt="" />
                        <p>Spa Treatment / Massage</p>
                    </a> 
                </div> -->
                <!-- /item -->    
                <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/icon/travel-product/tuk-tuk.svg" alt="" />
                        <p>Private Tuk-Tuk Rides</p>
                    </a> 
                </div>
                <!-- /item -->    
                <div class="item"> 
                    <a href="#0" class="box-item style-2"> 
                        <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/icon/travel-product/chao-phraya.svg" alt="" />
                        <p>Chao Phraya Boat Pass</p>
                    </a> 
                </div>
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
                <div class="item"> 
                    <a href="#0" class="grid_item relative">
                        <div class="ribbon">
                            <span>Popular</span>
                        </div>
                        <figure> 
                            <img src="{{asset('images/destination/1.jpg')}}" class="img-fluid" alt="" />
                            <div class="info"> 
                                <h3>Phuket</h3>
                            </div>
                        </figure>
                    </a> 
                </div>
                <!-- /item -->  

                <div class="item"> 
                    <a href="#0" class="grid_item relative">
                        <figure> 
                            <img src="{{asset('images/destination/2.jpg')}}" class="img-fluid" alt="">
                            <div class="info"> 
                                <h3>Siem Reap </h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /item --> 

                <div class="item"> 
                    <a href="#0" class="grid_item relative">
                        <div class="ribbon top">
                            <span>Saigon</span>
                        </div>
                        <figure> 
                            <img src="{{asset('images/destination/3.jpg')}}" class="img-fluid" alt="">
                            <div class="info"> 
                                <h3>Bali</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /item --> 

                <div class="item">  
                    <a href="#0" class="grid_item relative">
                        <figure> 
                            <img src="{{asset('images/destination/4.jpg')}}" class="img-fluid" alt="">
                            <div class="info"> 
                                <h3>Manila</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /item --> 

                <div class="item"> 
                    <a href="#0" class="grid_item relative">
                        <figure> 
                            <img src="{{asset('images/destination/5.jpg')}}" class="img-fluid" alt="">
                            <div class="info"> 
                                <h3>Bangkok</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /item --> 

                <div class="item"> 
                    <a href="#0" class="grid_item relative">
                        <figure> 
                            <img src="{{asset('images/destination/6.jpg')}}" class="img-fluid" alt="">
                            <div class="info"> 
                                <h3>Bali</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /item -->  

                <div class="item"> 
                    <a href="#0" class="grid_item relative">
                        <figure> 
                            <img src="{{asset('images/destination/7.jpg')}}" class="img-fluid" alt="">
                            <div class="info"> 
                                <h3>Chiang Mai</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /item -->  
            </div>  
        </div>
    </section> 
    <!-- /Popular Destinations -->    
    
    @include('layouts.frontend.partials.testimonials')  
</main>
@endsection

@section('script')
@endsection

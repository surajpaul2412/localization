@extends('layouts.frontend.customerapp')

@section('title')
<title>My Bookings | {{Auth::user()->name}}</title>
@endsection

@section('content') 
<main>
    
    <!-- [ Top Breadcrubms ] start -->  
    <div class="hero_in cart_section" style="background: #0054a6 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"><h1 class="my-4 animated"> <span></span>	{{dynamicLang('Booking Details')}}</h1></div>
                </div>
                <!-- End bs-wizard -->
            </div>
        </div>
    </div>

    <!-- [ My Orders ] start --> 
    <section class="section dashboard-detail">
        <div class="container-fluid">
            <div class="row align-items-start justify-content-center">

                <div class="col-lg-3 text-center d-none d-lg-block">
                    @include('layouts.frontend.partials.customerSidebar')
                </div> 
                        
                <div class="col-lg-9">

                    <div class="card border">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center justify-content-start">
                                    <img src="{{asset('images/tour.png')}}" class="img-fluid rounded-circle shadow" width="40px">
                                    <div class="media-body ms-2">
                                        <h6 class="mb-0 ft-medium">#1250004123</h6>
                                        <p class="m-0 fs-sm ft-normal">{{dynamicLang('Total Amount')}} - <b>₹</b>260.00</p>
                                    </div>
                                </div> 
                                <a href="{{route('customer.order')}}" class="btn btn-success btn-sm">Back to Order List</a>
                            </div> 
                        </div>
                        <div class="card-body"> 
                            <div class="row row-cols-3">  
                                <div class="col">  
                                    <div class="card border">
                                        <div class="card-header p-0">
                                            <figure class="m-0">  
                                                <img src="{{asset('images/destination/5.jpg')}}" class="img-fluid" alt=""> 
                                            </figure>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-1"><b>Street Food Tour in Bangkok</b></p> 
                                            <ul class="booking_list m-0"> 
                                                <li><strong>Selected Date:</strong> 25 Dec 2022</li> 
                                                <li><strong>Adult:</strong> 2, <strong>Child:</strong> 2, <strong>Infant:</strong> 2</li>  
                                            </ul>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">  
                                            <div class="items">
                                                <p class="m-0"><span><b>₹314.31</b></span></p>
                                            </div> 
                                            <div class="more-links text-end">   
                                                <a href="#"><small>Review Now</small></a>  
                                            </div>
                                        </div>
                                    </div> 
                                </div>  
                                <div class="col">  
                                    <div class="card border">
                                        <div class="card-header p-0">
                                            <figure class="m-0">  
                                                <img src="{{asset('images/destination/5.jpg')}}" class="img-fluid" alt=""> 
                                            </figure>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-1"><b>Street Food Tour in Bangkok</b></p> 
                                            <ul class="booking_list m-0"> 
                                                <li><strong>Selected Date:</strong> 25 Dec 2022</li> 
                                                <li><strong>Adult:</strong> 2, <strong>Child:</strong> 2, <strong>Infant:</strong> 2</li>  
                                            </ul>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between"> 
                                            <div class="items">
                                                <p class="m-0"><span><b>₹314.31</b></span></p>
                                            </div> 
                                            <div class="more-links text-end">   
                                                <div class="d-flex align-items-center">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fa fa-star-half"></i>
                                                        <i class="far fa-star"></i>
                                                    </div> 
                                                    <span>(56)</span>   
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col">  
                                    <div class="card border">
                                        <div class="card-header p-0">
                                            <figure class="m-0">  
                                                <img src="{{asset('images/destination/5.jpg')}}" class="img-fluid" alt=""> 
                                            </figure>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-1"><b>Street Food Tour in Bangkok</b></p> 
                                            <ul class="booking_list m-0"> 
                                                <li><strong>Selected Date:</strong> 25 Dec 2022</li> 
                                                <li><strong>Adult:</strong> 2, <strong>Child:</strong> 2, <strong>Infant:</strong> 2</li>  
                                            </ul>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">  
                                            <div class="items">
                                                <p class="m-0"><span><b>₹314.31</b></span></p>
                                            </div> 
                                            <div class="more-links text-end">   
                                                <a href="#"><small>Review Now</small></a>  
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div> 
                    
                </div>
                
            </div>
        </div>
    </section>   
</main>
@endsection